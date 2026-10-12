<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = "/admin/resources/video-registration/list.php";
$PageCode = "010201";
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);
try {

    $videoOptions = \models\video::find('all',['select'=>'pkid,title']);
    foreach ($videoOptions as &$result) {
        $result = $result->to_array();
    }
}catch (Exception $e){
    var_dump($e);exit;
}

?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/header.php')?>
    <script type="text/javascript">
        function checkFrm()
        {
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
            $("#main_product").css("border", "");
            $("#purchase_timeline").css("border", "");
            $("#note").css("border", "");

            if(f.firstname.value == "")
            {
                $("#firstname").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if(f.lastname.value == "")
            {
                $("#lastname").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if(f.email.value == "")
            {
                $("#email").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if(f.organization.value == "")
            {
                $("#organization").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if(f.country.value == "")
            {
                $("#country").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if(f.state.value == "")
            {
                $("#state").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if(isOk)
            {
                f.submit();
            }
        }
    </script>

    <div id="container">

        <div id="contents">

            <h2>Event registration</h2>

            <form method="post" name="regFrm" action="/admin/resources/video-registration/register.php">
                <table class="board_write" style="width:100%">
                    <colgroup>
                        <col style="width:20%">
                        <col style="width:80%">
                    </colgroup>
                    <tr>
                        <th>first name</th>
                        <td><input type="text" name="firstname" id="firstname" maxlength="20" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>last name</th>
                        <td><input type="text" name="lastname" id="lastname" maxlength="20" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>work email</th>
                        <td><input type="text" name="email" id="email" maxlength="50" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>Event</th>
                        <td>
                            <select type="text" name="video_id" id="video_id" value="4" maxlength="100" style="width:350px">
                                <?php foreach ($videoOptions as $videoOption){ ?>
                                    <option value="<?= $videoOption['pkid']?>"><?= $videoOption['title'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>phone</th>
                        <td><input type="text" name="phone" id="phone" maxlength="50" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>organization /<br>institution</th>
                        <td><input type="text" name="organization" id="organization" maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>job title</th>
                        <td><input type="text" name="job_title" id="job_title" maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>country</th>
                        <td><input type="text" name="country" id="country" maxlength="50" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>state</th>
                        <td><input type="text" name="state" id="state" maxlength="50" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>main application</th>
                        <td><input type="text" name="main_application" id="main_application" maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>other</th>
                        <td>
                            <input type="checkbox" name="isreceive" value="1"> Yes, I'd like to receive the latest news about solutions, applications and events.
                        </td>
                    </tr>
                    <tr>
                        <th>REQUEST INFO <br/>OR QUESTION</th>
                        <td>
                            <textarea name="note" id="note" style="width:516px;height:250px"></textarea>
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


<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/footer.php')?>