<?php

extract($data, EXTR_OVERWRITE);

$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

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
            f.action = "/admin/core-labs/index.php?slug=delete";
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

        <h2><?= $PageTitle ?></h2>

        <form method="post" id="article_frm" name="regFrm" action="/admin/core-labs/index.php?slug=modify"
              enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $ViewData['id'] ?>"/>
            <input type="hidden" name="ids[]" value="<?= $ViewData['id'] ?>"/>
            <input type="hidden" name="page" value="<?= $page ?>"/>
            <input type="hidden" name="searchKey" value="<?= $searchKey ?>"/>
            <input type="hidden" name="order" value="<?= $order ?>"/>
            <input type="hidden" name="oldLogoFile" value="<?= $ViewData['logo_file'] ?>"/>
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
                    <th>organization</th>
                    <td><input type="text" name="organization" id="organization" value="<?= $ViewData['organization'] ?>"
                               maxlength="200" style="width:350px"></td>
                </tr>
                <tr>
                    <th>department</th>
                    <td><input type="text" name="department" id="department" value="<?= $ViewData['department'] ?>"
                               maxlength="200" style="width:350px"></td>
                </tr>
                <tr>
                    <th>contact name</th>
                    <td><input type="text" name="contact_name" id="contact_name" value="<?= $ViewData['contact_name'] ?>"
                               maxlength="200" style="width:350px"></td>
                </tr>
                <tr>
                    <th>title</th>
                    <td><input type="text" name="title" id="title" value="<?= $ViewData['title'] ?>" maxlength="200"
                               style="width:350px"></td>
                </tr>
                <tr>
                    <th>phone</th>
                    <td><input type="text" name="phone" id="phone" value="<?= $ViewData['phone'] ?>" maxlength="200" style="width:350px"></td>
                </tr>
                <tr>
                    <th>email</th>
                    <td><input type="text" name="email" id="email" value="<?= $ViewData['email'] ?>" maxlength="200" style="width:350px"></td>
                </tr>
                <tr>
                    <th>link to lab (url)</th>
                    <td><input type="text" name="url" id="url" value="<?= $ViewData['url'] ?>" maxlength="200"
                               style="width:350px"></td>
                </tr>

                <tr>
                    <th>logo file</th>
                    <td>
                        <input type="file" name="logo_file">
                        <?php
                        if ($ViewData["logo_file"] != "") {
                            echo "<div style=\"margin-top:10px\">";
                            echo "<img src=\"/files/core_labs/" . $ViewData["logo_file"] . "\" width=\"100%\">";
                            echo "&nbsp;&nbsp;<input type=\"checkbox\" name=\"deleteLogoFile\" value=\"1\"/> Delete File\n";
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
