<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = '/admin/blog/list.php';
$PageCode = '020301';
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/header.php'); ?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            let body = new Jodit('#body', {
                zIndex: 10000,
                height: 800,
            });
        });

        function checkFrm() {
            var f = document.regFrm;
            var isOk = true;

            $('#type, #year, #month, #day, #title').css("border", "");

            if (f.type.value == "0") {
                $("#type").css("border", "1px solid #ff0000");
                isOk = false;
            }

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

            <form method="post" id="article_frm" name="regFrm" action="/admin/blog/create.php"
                  enctype="multipart/form-data">

                <table class="board_write">
                    <colgroup>
                        <col style="width:25%">
                        <col style="width:75%">
                    </colgroup>
                    <tr>
                        <th>year</th>
                        <td><input type="text" name="year" id="year" value="<?= date('Y') ?>" maxlength="4"
                                   style="width:60px"></td>
                    </tr>
                    <tr>
                        <th>month</th>
                        <td>
                            <?= $webhelper->monthDropdown('month') ?>
                        </td>
                    </tr>
                    <tr>
                        <th>day</th>
                        <td>
                            <?= $webhelper->dayDropdown('day') ?>
                        </td>
                    </tr>
                    <tr>
                        <th>type</th>
                        <td>
                            <select name="type" id="type" style="width:350px">
                                <?php foreach (Constants::BLOG_TYPES as $key => $type) { ?>
                                    <option value="<?= $key ?>" <?php echo (Constants::BLOG_TYPES[$ViewData["industry_type"]] == $type) ? 'selected' : '' ?>><?= $type ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>source</th>
                        <td><input type="text" name="source" id="source" maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>slug url</th>
                        <td><input type="text" name="slug" id="slug" maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>main title</th>
                        <td><input type="text" name="title" id="title" maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>subtitle</th>
                        <td><textarea name="sub_title" id="sub_title" style="width:516px;height:250px"></textarea></td>
                    </tr>
                    <tr>
                        <th>add content</th>
                        <td><textarea name="body" id="body" style="width:516px;height:250px"></textarea></td>
                    </tr>
                    <tr>
                        <th>author</th>
                        <td><input type="text" name="author" id="author" maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>keywords</th>
                        <td><input type="text" name="tags" id="tags" maxlength="200" style="width:350px" placeholder="separate by comma"></td>
                    </tr>
                    <tr>
                        <th>thumbnail file</th>
                        <td>
                            <input type="file" name="thumbnail1">
                        </td>
                    </tr>
                    <tr>
                        <th>hero</th>
                        <td>
                            <input type="file" name="thumbnail2">
                        </td>
                    </tr>
                    <tr>
                        <th>file</th>
                        <td>
                            <input type="file" name="up_file">
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
            </div>
            <!-- //form_submit -->

        </div>
        <!-- //contents -->

    </div>
    <!-- //container -->


<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/footer.php') ?>