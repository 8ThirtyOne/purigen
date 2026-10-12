<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = '/admin/blog/list.php';
$PageCode = '020201';
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$pkid = $webhelper->RequestFilter('id', 0, false);
$page = $webhelper->RequestFilter('page', 0, false);
$searchKey = $webhelper->RequestFilter('searchKey', -1, false);
$order = $webhelper->RequestFilter('order', 0, false);

//check parameter
if ($webhelper->isNull($pkid)) $webhelper->AlertMessage('Error. Please try again.');
if ($webhelper->isNull($page)) $page = 1;
if ($webhelper->isNull($searchKey)) $searchKey = '';
if ($webhelper->isNull($order)) $order = 0;

$Parameter = "?page=$page&searchKey=$searchKey&order=$order";

$dbhelper->dbOpen();
$sql = "select * from blog where id = $pkid ";
$ViewData = $dbhelper->RunSQLReturnOneRow($sql);
$dbhelper->dbClose();

if ($webhelper->isNull($ViewData))
    $webhelper->AlertMessageAndGo('Error. Please try again.', '/admin/blog/list.php' . $Parameter);
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/header.php') ?>
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let body = new Jodit('#body', {
                zIndex: 10000,
                width: 700,
                height: 800,
            });
        });

        function checkFrm() {
            var f = document.regFrm;
            var isOk = true;

            $('#type, #year, #month, #day, #title').css("border", "");

            if (f.year.value == "") {
                $("#year").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.month.value == "0") {
                $("#month").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.day.value == "0") {
                $("#day").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.title.value == "") {
                $("#title").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (isOk) {
                f.submit();
            }
        }

        function del() {
            var f = document.regFrm;

            if (confirm("Are you sure you want to delete this record?")) {
                f.action = "/admin/blog/delete.php";
                f.submit();
            }
        }

        $(function () {
            $("#article_frm").validate(
                {
                    rules:
                        {
                            title:
                                {
                                    required: true,
                                    maxlength: 85
                                },
                        }
                    ,
                    messages:
                        {
                            title: {
                                required: "Field Title is required",
                                maxlength: "Please enter no more than 85 characters if you want two lines on front page"
                            }
                        }
                });
        });
    </script>

    <div id="container">

        <div id="contents">

            <h2>Blog</h2>

            <form method="post" id="article_frm" name="regFrm" action="/admin/blog/modify.php"
                  enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $ViewData['id'] ?>"/>
                <input type="hidden" name="ids[]" value="<?= $ViewData['id'] ?>"/>
                <input type="hidden" name="page" value="<?= $page ?>"/>
                <input type="hidden" name="searchKey" value="<?= $searchKey ?>"/>
                <input type="hidden" name="order" value="<?= $order ?>"/>
                <input type="hidden" name="oldthumbnail1" value="<?= $ViewData['thumbnail1'] ?>"/>
                <input type="hidden" name="oldthumbnail2" value="<?= $ViewData['thumbnail2'] ?>"/>
                <input type="hidden" name="oldFile" value="<?= $ViewData['filename'] ?>"/>
                <input type="hidden" name="oldOrgFile" value="<?= $ViewData['org_file_name'] ?>"/>
                <table class="board_write">
                    <colgroup>
                        <col style="width:25%">
                        <col style="width:75%">
                    </colgroup>
                    <tr>
                        <th>year</th>
                        <td><input type="text" name="year" id="year" value="<?= $ViewData['year'] ?>" maxlength="4"
                                   style="width:60px"></td>
                    </tr>
                    <tr>
                        <th>month</th>
                        <td>
                            <?= $webhelper->monthDropdown('month', $ViewData['month']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>day</th>
                        <td>
                            <?= $webhelper->dayDropdown('day', $ViewData['day']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>type</th>
                        <td>
                            <select name="type" id="type" style="width:350px">
                                <?php foreach (Constants::BLOG_TYPES as $key => $type) { ?>
                                    <option value="<?= $key ?>" <?php echo (Constants::BLOG_TYPES[$ViewData['type']] === $type) ? 'selected' : '' ?>><?= $type ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>source</th>
                        <td><input type="text" name="source" id="source" value="<?= $ViewData['source'] ?>"
                                   maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>slug url</th>
                        <td><input type="text" name="slug" id="slug" value="<?= $ViewData['slug'] ?>" maxlength="200"
                                   style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>main title</th>
                        <td><input type="text" name="title" id="title" value="<?= $ViewData['title'] ?>" maxlength="200"
                                   style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>subtitle</th>
                        <td><textarea name="sub_title" id="sub_title"
                                      style="width:516px;height:250px"><?= $ViewData['sub_title'] ?></textarea></td>
                    </tr>
                    <tr>
                        <th>add content</th>
                        <td><textarea name="body" id="body"
                                      style="width:600px"><?= $ViewData['body'] ?></textarea></td>
                    </tr>
                    <tr>
                        <th>author</th>
                        <td><input type="text" name="author" id="author" value="<?= $ViewData['author'] ?>"
                                   maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>keywords</th>
                        <td><input type="text" name="tags" id="tags" value="<?= $ViewData['tags'] ?>" maxlength="200"
                                   style="width:350px" placeholder="separate by comma"></td>
                    </tr>
                    <tr>
                        <th>thumbnail file</th>
                        <td>
                            <input type="file" name="thumbnail1">
                            <?php
                            if ($ViewData["thumbnail1"] != "") {
                                echo "<div style=\"margin-top:10px\">";
                                echo "<img src=\"/files/literature/" . $ViewData["thumbnail1"] . "\" width=\"100%\">";
                                echo "&nbsp;&nbsp;<input type=\"checkbox\" name=\"deleteThumbnail1\" value=\"1\"/> Delete File\n";
                                echo "</div>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>hero</th>
                        <td>
                            <input type="file" name="thumbnail2">
                            <?php
                            if ($ViewData["thumbnail2"] != "") {
                                echo "<div style=\"margin-top:10px\">";
                                echo "<img src=\"/files/literature/" . $ViewData["thumbnail2"] . "\" width=\"100%\">";
                                echo "&nbsp;&nbsp;<input type=\"checkbox\" name=\"deleteThumbnail2\" value=\"1\"/> Delete File\n";
                                echo "</div>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>file</th>
                        <td>
                            <input type="file" name="up_file">
                            <?php
                            if ($ViewData["filename"] != "") {
                                echo "<div style=\"margin-top:10px\">";
                                echo $ViewData["orgfilename"];
                                echo "&nbsp;&nbsp;<input type=\"checkbox\" name=\"deleteFile\" value=\"1\"/> Delete File\n";
                                echo "</div>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <!-- //board_write -->
            </form>

            <div class="form_submit l_clear">
                <div class="side side-left">
                    <a href="javascript:checkFrm();" class="bt bt-green">save</a>
                    <a href="javascript:history.back();" class="bt bt-green">cancel</a>
                </div>
                <div class="side side-right">
                    <a href="javascript:del();" class="bt bt-navy">delete</a>
                </div>
            </div>
            <!-- //form_submit -->

        </div>
        <!-- //contents -->

    </div>
    <!-- //container -->


<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/footer.php') ?>