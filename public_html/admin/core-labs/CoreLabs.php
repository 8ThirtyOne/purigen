<?php

use controllers\BaseController;
use models\CoreLab;

class CoreLabs extends BaseController
{
    /**
     * @var string
     */
    private $table = 'core_labs';

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $dataView = [];

    /**
     * @var string
     */
    private $mainAction;

    public function __construct()
    {
        $this->path = getcwd();
        $this->mainAction = '/admin/core-labs/index.php';

        $this->dataView['webhelper'] = new WebHelper();
        $this->dataView['dbhelper']  = new dbHelper();
        $this->dataView['PageUrl']   = '/admin/core-labs/index.php?slug=';
        $this->dataView['PageCode']  = '020401';
        $this->dataView['PageTitle'] = 'Core Labs';

    }

    public function actionIndex()
    {
        return $this->actionList();
    }

    public function actionList()
    {
        $this->getReguestFilter();
        extract($this->dataView, EXTR_OVERWRITE);

        parse_str(parse_url($_REQUEST['slug'], PHP_URL_QUERY), $requestUrl);

        $page = $requestUrl['page'] ?? $page;

        $dbhelper->dbOpen();
        $sql = 'select * from ' . $this->table;
        if ($searchKey != "") {
            $sql .= " where title like '%$searchKey%' ";
        }

        if ($order == 0)
            $sql .= ' order by id desc ';

        if ($order == 1)
            $sql .= ' order by type desc ';
        if ($order == 2)
            $sql .= ' order by type asc ';

        if ($order == 3)
            $sql .= ' order by title desc ';
        if ($order == 4)
            $sql .= ' order by title asc ';

        if ($order == 5)
            $sql .= ' order by status desc ';
        if ($order == 6)
            $sql .= ' order by status asc ';

        $List = $dbhelper->RunSQLReturnRowsSub($sql, $page, $PageSize, $TotalCount);
        $pageList = $webhelper->getPaging($TotalCount, $page, $PageSize);

        $dbhelper->dbClose();

        $this->setDataView([
            'PageSize' => $PageSize,
            'List' => $List,
            'page' => $page,
            'pageList' => $pageList,
            'TotalCount' => $TotalCount
        ], 'list');

        echo $this->render_php($this->path . '/view/list.php', $this->dataView);
        exit();
    }

    public function actionModifyForm()
    {
        $this->getReguestFilter(1);
        extract($this->dataView, EXTR_OVERWRITE);

        $Parameter = "?page=$page&searchKey=$searchKey&order=$order";
        $ViewData  = $this->findById($id);

        if ($webhelper->isNull($ViewData)) {
            $webhelper->AlertMessageAndGo('Error. Please try again.', $this->mainAction . $Parameter);
        }

        $this->setDataView([
            'Parameter' => $Parameter,
            'ViewData'  => $ViewData
        ], 'modifyForm');

        echo $this->render_php($this->path . '/view/modifyForm.php', $this->dataView);
        exit();
    }

    public function actionModify()
    {
        $this->getReguestFilter(1);
        extract($this->dataView, EXTR_OVERWRITE);

        //Parameter
        $oldfile       = $webhelper->RequestFilter('oldLogoFile', 100, false);

        $year = $webhelper->RequestFilter('year', 4, false);
        $url = $webhelper->RequestFilter('url', 200, true);
        $month = $webhelper->RequestFilter('month', 2, false);
        $day = $webhelper->RequestFilter('day', 2, false);
        $title = $webhelper->RequestFilter('title', 400, false);
        $contactName = $webhelper->RequestFilter('contact_name', 400, false);
        $deleteLogoFile = $webhelper->RequestFilter('deleteLogoFile', 1, false);

        //check parameter
        if ($webhelper->isNull($year)) $webhelper->AlertMessage('There is an error in your Year entry. Please try again..');
        if ($webhelper->isNull($month)) $webhelper->AlertMessage('There is an error in your Month entry. Please try again.');
        if ($webhelper->isNull($day)) $webhelper->AlertMessage('There is an error in your Day entry. Please try again.');
        if ($webhelper->isNull($title)) $webhelper->AlertMessage('Error. Please try again.');

        if ($webhelper->isNull($id)) $webhelper->AlertMessage('Error. Please try again.');
        if ($webhelper->isNull($deleteLogoFile)) $deleteLogoFile = 0;

        $coreLabs = models\CoreLab::find('first', ['conditions' => ["title = '$title' and id != $id"]]);
        if ($coreLabs) {
            $webhelper->AlertMessageAndHistoryBack('core-labs title already exist in database');
        }

        $Parameter = "?page=$page&searchKey=$searchKey&order=$order";

        //file upload
        $logoFile = $webhelper->UploadFile('logo_file', '/core_labs/', true);
        if ($logoFile != null) { //upload new file so that delete old file;
            if ($oldfile != "")
                $webhelper->DeleteFile("/core_labs/", $oldfile);
            $newLogoFile = $logoFile["filename"];
        } else {
            if ($deleteLogoFile == "1") {
                //deleteFile
                $webhelper->DeleteFile("/core_labs/", $oldfile);
                $newLogoFile = '';
            } else {
                $newLogoFile = $oldfile;
            }
        }

        $dbhelper->dbOpen();
        $sql = "update $this->table 
        set year = '$year',
            month = '$month',
            day = '$day',
            organization = '${_POST['organization']}',
            department = '${_POST['department']}',
            title = '$title',
            phone = '${_POST['phone']}',
            email = '${_POST['email']}',
            url = '${_POST['url']}',
            contact_name = '$contactName',
            logo_file = '$newLogoFile'
        where id = ${_POST['id']}";
        $dbhelper->RunSQL($sql);
        $dbhelper->dbClose();

        $webhelper->AlertMessageAndGo('', $this->mainAction . $Parameter);
        exit();
    }


    public function actionDuplicate()
    {
        $this->getReguestFilter(1);
        extract($this->dataView, EXTR_OVERWRITE);

        $coreLabs = $this->findById($id);
        unset($coreLabs['id'],$coreLabs['logo_file'],$coreLabs['created_at']);

        $duplicate = new CoreLab($coreLabs);
        $timestamp = date('Y-m-d H:i:s');
        $duplicate->created_at = time();
        $duplicate->title = '';
        $duplicate->status = 0;
        try{
            $duplicate->save();
        } catch (Exception $e) {
            var_dump($e);
        }

        $webhelper->AlertMessageAndGo('', $this->mainAction . '?page='.$page.$Parameter);
        exit();
    }

    public function actionDelete()
    {
        $this->getReguestFilter();
        extract($this->dataView, EXTR_OVERWRITE);

        $ids = $webhelper->RequestFilterMulti('ids', 0, false);
        if(count($ids)<=0) {
            $webhelper->AlertMessage('Error. Please try again.');
        }

        try {
            $List = CoreLab::find(
                'all', ['conditions' => ['id in(?)', $ids]]
            );

        } catch (Exception $e) {
            $this->dataView['webhelper']->AlertMessageAndGo($e->getMessage(), $this->mainAction . $this->dataView['Parameter']);
        }

        if($List != null && count($List) > 0)
        {
            foreach ($List as $row)
            {
                if($row->logo_file != '')
                    $webhelper->DeleteFile('/core_labs/', $row->logo_file);
                try {
                    $row->delete();
                } catch (Exception $e) {
                    var_dump($e);
                }
            }
        }

        $webhelper->AlertMessageAndGo('', $this->mainAction . '?page='.$page.$Parameter);
        exit();
    }


    public function actionUnpublish() {
        $this->actionPublish(0);
    }

    /**
     * @param int $status
     */
    public function actionPublish(int $status = 1)
    {
        $this->getReguestFilter();
        extract($this->dataView, EXTR_OVERWRITE);

        $ids = $webhelper->RequestFilterMulti('ids', 0, false);
        if(count($ids)<=0) {
            $webhelper->AlertMessage('Error. Please try again.');
        }

        try {
            $List = CoreLab::find(
                'all', ['conditions' => ['id in(?)', $ids]]
            );

        } catch (Exception $e) {
            $this->dataView['webhelper']->AlertMessageAndGo($e->getMessage(), $this->mainAction . $this->dataView['Parameter']);
        }

        if($List != null && count($List) > 0)
        {
            foreach ($List as $row)
            {
                if (!$row->title) {
                    continue;
                }
                $row->status = $status;
                try {
                    $row->save();
                } catch (Exception $e) {
                    var_dump($e);
                }
            }
        }

        $webhelper->AlertMessageAndGo('', $this->mainAction . '?page='.$page.$Parameter);
        exit();
    }

    public function actionCreateForm()
    {
        $this->getReguestFilter();
        extract($this->dataView, EXTR_OVERWRITE);

        echo $this->render_php($this->path . '/view/createForm.php', $this->dataView);
        exit();
    }

    public function actionCreate()
    {
        $this->getReguestFilter();
        extract($this->dataView, EXTR_OVERWRITE);

        if (!$_POST['slug']) {
            $slug = $webhelper->slugify($_POST['title']);
        } else {
            $slug = $_POST['slug'];
        }

        $coreLabs = CoreLab::find('first', ['conditions' => ["title = '$slug'"]]);
        if ($coreLabs) {
            $webhelper->AlertMessageAndHistoryBack('Core labs title already exist in database');
        }

        //file upload
        $logoFile = $webhelper->UploadFile('logo_file', '/core_labs/', true);
        $_POST += ['logo_file' => $logoFile['filename']];


        try {
            $coreLabs = CoreLab::create($_POST);
        } catch (\Throwable $e) {
            (new \WebHelper())->AlertMessageAndHistoryBack('Something is wrong!');
        }

        $webhelper->AlertMessageAndGo('', $this->mainAction . '?page='.$Parameter);
        exit();
    }


    /**
     * @param array $data
     * @param string $slug
     */
    private function setDataView(array $data = [], string $slug = '')
    {
        if (count($data) > 0) {
            $this->dataView = array_merge($this->dataView, $data);
        }

        if ($slug !== '') {
            $this->dataView['slug'] = $slug;
            $this->dataView['PageUrl'] .= $slug;
        }
    }

    /**
     * @param int $withId
     */
    private function getReguestFilter(int $withId = 0)
    {
        $webhelper = $this->dataView['webhelper'];

        if ($withId == 1) {
            $id = $webhelper->RequestFilter('id', 0, false);
            if ($webhelper->isNull($id)) {
                $webhelper->AlertMessage('Error. Please try again.');
            }
            $this->dataView['id'] = $id;
        }
//Parameter
        $page = $webhelper->RequestFilter('page', 0, false);
        $searchKey = $webhelper->RequestFilter('searchKey', -1, false);
        $order = $webhelper->RequestFilter('order', 0, false);

//check parameter
        if ($webhelper->isNull($page)) $page = 1;
        if ($webhelper->isNull($searchKey)) $searchKey = "";
        if ($webhelper->isNull($order)) $order = 0;

        $Parameter = "&searchKey=$searchKey&order=$order";

        $this->setDataView([
            'page' => $page,
            'searchKey' => $searchKey,
            'order' => $order,
            'Parameter' => $Parameter,
            'PageSize' => 50,
            'TotalCount' => 0
        ]);
    }

    /**
     * @param $id
     * @param $webhelper
     * @param string $Parameter
     * @return array|string
     */
    protected function findById($id)
    {
        try {
            $ViewData = CoreLab::find(
                'first', ['conditions' => ['id=?', (int)$id]]
            )->to_array();

        } catch (Exception $e) {
            $this->dataView['webhelper']->AlertMessageAndGo($e->getMessage(), $this->mainAction . $this->dataView['Parameter']);
        }
        return $ViewData;
    }
}