<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = "/admin/resources/literature-registration/list.php";
$PageCode = "020201";
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$pkid = $webhelper->RequestFilter("pkid", 0, false);
$page = $webhelper->RequestFilter("page", 0, false);
$searchKey = $webhelper->RequestFilter("searchKey", -1, false);
$order = $webhelper->RequestFilter("order", 0, false);

try {

    $literatureOptions = \models\Literature::find('all', ['select' => 'pkid,title']);
    foreach ($literatureOptions as &$result) {
        $result = $result->to_array();
    }
} catch (Exception $e) {
    var_dump($e);
    exit;
}

//check parameter
if ($webhelper->isNull($pkid)) $webhelper->AlertMessage("Error. Please try again.");
if ($webhelper->isNull($page)) $page = 1;
if ($webhelper->isNull($searchKey)) $searchKey = "";
if ($webhelper->isNull($order)) $order = 0;

$Parameter = "?page=$page&searchKey=$searchKey&order=$order";

$dbhelper->dbOpen();
$sql = "select * from registration_from_literature where pkid = $pkid ";
$ViewData = $dbhelper->RunSQLReturnOneRow($sql);
$dbhelper->dbClose();

if ($webhelper->isNull($ViewData))
    $webhelper->AlertMessageAndGo("Error. Please try again.", "/admin/resources/literature-registration/list.php" . $Parameter);
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/header.php') ?>
    <script type="text/javascript">
        function checkFrm() {
            var f = document.regFrm;
            var isOk = true;

            $("#firstname").css("border", "");
            $("#lastname").css("border", "");
            $("#email").css("border", "");
            $("#phone").css("border", "");
            $("#organization").css("border", "");
            $("#job_title").css("border", "");
            $("#country").css("border", "");
            $("#state").css("border", "");
            $("#main_application").css("border", "");
            $("#note").css("border", "");

            if (f.firstname.value == "") {
                $("#firstname").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.lastname.value == "") {
                $("#lastname").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.email.value == "") {
                $("#email").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.organization.value == "") {
                $("#organization").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.country.value == "") {
                $("#country").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.state.value == "") {
                $("#state").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (isOk) {
                f.submit();
            }
        }

        function del() {
            var f = document.regFrm;

            if (confirm("Are you sure you want to delete this record?")) {
                f.action = "/admin/resources/literature-registration/delete.php";
                f.submit();
            }
        }
    </script>

    <div id="container">

        <div id="contents">

            <h2>Registered Details</h2>

            <form method="post" name="regFrm" action="/admin/resources/literature-registration/modify.php">
                <input type="hidden" name="pkid" value="<?= $ViewData["pkid"] ?>"/>
                <input type="hidden" name="pkids[]" value="<?= $ViewData["pkid"] ?>"/>
                <input type="hidden" name="page" value="<?= $page ?>"/>
                <input type="hidden" name="searchKey" value="<?= $searchKey ?>"/>
                <input type="hidden" name="order" value="<?= $order ?>"/>

                <table class="board_write" style="width:100%">
                    <colgroup>
                        <col style="width:20%">
                        <col style="width:80%">
                    </colgroup>
                    <tr>
                        <th>first name</th>
                        <td><input type="text" name="firstname" id="firstname" value="<?= $ViewData["firstname"] ?>"
                                   maxlength="20" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>last name</th>
                        <td><input type="text" name="lastname" id="lastname" value="<?= $ViewData["lastname"] ?>"
                                   maxlength="20" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>work email</th>
                        <td><input type="text" name="email" id="email" value="<?= $ViewData["email"] ?>" maxlength="50"
                                   style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>Event</th>
                        <td>
                            <select type="text" name="literature_id" id="literature_id" value="4" maxlength="100"
                                    style="width:350px">
                                <?php foreach ($literatureOptions as $literatureOption) { ?>
                                    <option <?php echo ($ViewData['literature_id'] == $literatureOption['pkid']) ? 'selected' : '' ?>
                                            value="<?= $literatureOption['pkid'] ?>"><?= $literatureOption['title'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>phone</th>
                        <td><input type="text" name="phone" id="phone" value="<?= $ViewData["phone"] ?>" maxlength="50"
                                   style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>organization /<br>institution</th>
                        <td><input type="text" name="organization" id="organization"
                                   value="<?= $ViewData["organization"] ?>" maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>job title</th>
                        <td><input type="text" name="job_title" id="job_title" value="<?= $ViewData["job_title"] ?>"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>country</th>
                        <td><input type="text" name="country" id="country" value="<?= $ViewData["country"] ?>"
                                   maxlength="50" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>state</th>
                        <td><input type="text" name="state" id="state" value="<?= $ViewData["state"] ?>" maxlength="50"
                                   style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>main research area</th>
                        <td><input type="text" name="main_application" id="main_application"
                                   value="<?= $ViewData["main_application"] ?>" maxlength="100" style="width:350px">
                        </td>
                    </tr>
                    <tr>
                        <th>other</th>
                        <td>
                            <input type="checkbox" name="isreceive"
                                   value="1" <?= $webhelper->MakeSelectedValue("1", $ViewData["isreceive"], "checked") ?>>
                            Yes, I'd like to receive the latest news about solutions, applications and events.
                        </td>
                    </tr>
                    <tr>
                        <th>Request<br>/ Question</th>
                        <td>
                            <textarea name="note" id="note"
                                      style="width:516px;height:250px"><?= $ViewData["note"] ?></textarea>
                        </td>
                    </tr>
                </table>
                <!-- //board_write -->
            </form>

            <div class="form_submit l_clear">
                <div class="side side-left">
                    <a href="javascript:checkFrm();" class="bt bt-green">Save</a>
                    <a href="javascript:history.back();" class="bt bt-green">Cancel</a>
                </div>
                <div class="side side-right">
                    <a href="javascript:del();" class="bt bt-navy">Delete</a>
                </div>
            </div>
            <!-- //form_submit -->

        </div>
        <!-- //contents -->

    </div>
    <!-- //container -->


<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/footer.php') ?>