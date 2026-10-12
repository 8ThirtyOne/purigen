<?php

namespace controllers;

use dbHelper;
use models\TechnicalArticles as Model;
use WebHelper;

class TechnicalArticleController extends BaseController
{
    /**
     * @var string
     */
    protected $table = 'technical_articles';

    /**
     * @var \dbHelper
     */
    protected $dbHelper;

    /**
     * @var \WebHelper
     */
    protected $webHelper;

    /**
     * @var array
     */
    private $dataView = [];

    public function __construct()
    {
        $this->webHelper = $this->dataView['webhelper'] = new WebHelper();
        $this->dbHelper = $this->dataView['dbhelper'] = new dbHelper();

        $this->dataView['PageCode'] = '020501';
        $this->dataView['PageTitle'] = 'Core Labs';
    }

    public function actionIndex()
    {
        //Parameter
        $page = $this->webHelper->RequestFilter('page', 0, false);

        if ($this->webHelper->isNull($page)) $page = 1;
        $PageSize = 4;

        $this->dbHelper->dbOpen();
        $sql = "select * from $this->table where status = 1  order by year desc, month desc, day desc";

        $List = $this->dbHelper->RunSQLReturnRowsSub($sql, $page, $PageSize, $TotalCount);
        $pageList = $this->webHelper->getPaging($TotalCount, $page, $PageSize);
        $this->dbHelper->dbClose();

        $this->setDataView([
            'PageSize' => $PageSize,
            'List' => $List,
            'pageList' => $pageList,
            'TotalCount' => $TotalCount
        ]);

        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/technical-articles/list.php', $this->dataView);

        exit();
    }

    public function actionView()
    {
        $title = $GLOBALS['vars']['slug'];

        try {
            if (!$title) {
                throw new Exception('Post does not exist');
            }
            $model = (object)Model::find('first', ['conditions' => ["slug = '$title'"]]);
            if (empty((array)$model)) {
                throw new Exception('Post does not exist');
            }
        } catch (Exception $e) {
            $this->webHelper->AlertMessageAndHistoryBack($e->getMessage());
        }

        $this->dbHelper->dbOpen();
        $sql = "select slug from $this->table where concat(year,month,day) < " . $model->year . $model->month . $model->day . " and status = 1 order by year desc, month desc, day desc limit 1";
        $forward = $this->dbHelper->RunSQLReturnOneRow($sql);

        $sql = "select slug from $this->table where concat(year,month,day) > " . $model->year . $model->month . $model->day . " and status = 1 order by year, month, day limit 1";
        $back = $this->dbHelper->RunSQLReturnOneRow($sql);
        $this->dbHelper->dbClose();

        $this->setDataView([
            'back' => $back,
            'forward' => $forward,
            'model' => $model,
        ]);

        echo $this->render_php($_SERVER['DOCUMENT_ROOT'] . '/view/technical-articles/view.php', $this->dataView);
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
}