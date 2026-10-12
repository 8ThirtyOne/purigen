<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = "/admin/news/events/list.php";
$PageCode = "030201";
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

$nowYear = date("Y");
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/header.php'); ?>

<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.js"></script>
<script type="text/javascript">
        $(document).ready(function () {
            let add_info = new Jodit('#add_info', {
                zIndex: 10000,
                height: 350,
            });
            let registration_header = new Jodit('#registration_header', {
                zIndex: 10000,
                height: 200,
            });
        });
        function checkFrm()
        {
            var f = document.regFrm;
            var isOk = true;
            
            $("#type").css("border", "");
            $("#startyear").css("border", "");
            $("#startmonth").css("border", "");
            $("#startday").css("border", "");
            $("#endyear").css("border", "");
            $("#endmonth").css("border", "");
            $("#endday").css("border", "");
            $("#maintitle").css("border", "");
            $("#subtitle").css("border", "");
            $("#location1").css("border", "");
            $("#ctabutton1").css("border", "");
            $("#ctabutton2").css("border", "");
            
            if(f.type.value == "0")
            {
                $("#type").css("border", "1px solid #ff0000");
                isOk = false;
            }
            
            if(f.startyear.value == "")
            {
                $("#startyear").css("border", "1px solid #ff0000");
                isOk = false;
            }
            
            if(f.startmonth.value == "0")
            {
                $("#startmonth").css("border", "1px solid #ff0000");
                isOk = false;
            }
            
            if(f.startday.value == "0")
            {
                $("#startday").css("border", "1px solid #ff0000");
                isOk = false;
            }
            
            if(f.endyear.value == "")
            {
                $("#endyear").css("border", "1px solid #ff0000");
                isOk = false;
            }
            
            if(f.endmonth.value == "0")
            {
                $("#endmonth").css("border", "1px solid #ff0000");
                isOk = false;
            }
            
            if(f.endday.value == "0")
            {
                $("#endday").css("border", "1px solid #ff0000");
                isOk = false;
            }
            
            if(f.maintitle.value == "")
            {
                $("#maintitle").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if(f.subtitle.value == "")
            {
                $("#subtitle").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if(f.location1.value == "")
            {
                $("#location1").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.ctabutton1.value == "") {
                $("#ctabutton1").css("border", "1px solid #ff0000");
                isOk = false;
            }
            if (f.ctabutton2.value == "") {
                $("#ctabutton2").css("border", "1px solid #ff0000");
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

            <h2>upcoming events</h2>
            
            <form method="post" name="regFrm" action="/admin/news/events/register.php" enctype="multipart/form-data">
                <table class="board_write">
                    <colgroup>
                        <col style="width:25%">
                        <col style="width:75%">
                    </colgroup>
                    <tr>
                        <th>type</th>
                        <td>
                            <select name="type" id="type">
                                <option value="0">- select one -</option>
                                <option value="1">Conference</option>
                                <option value="2">Webinar</option>
                                <option value="3">Meeting</option>
                                <option value="4">Online</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>start day</th>
                        <td>
                            <select name="startmonth" id="startmonth">
                                <option value="0">- Month -</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select name="startday" id="startday">
                                <option value="0">- Day -</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <input type="text" name="startyear" id="startyear" value="<?=$nowYear?>" maxlength="4" style="width:60px">
                        </td>
                    </tr>
                    <tr>
                        <th>end day</th>
                        <td>
                            <select name="endmonth" id="endmonth">
                                <option value="0">- Month -</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select name="endday" id="endday">
                                <option value="0">- Day -</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <input type="text" name="endyear" id="endyear" value="<?=$nowYear?>" maxlength="4" style="width:60px">
                        </td>
                    </tr>
                    <tr>
                        <th>title</th>
                        <td><input type="text" name="maintitle" id="maintitle"
                                   maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>slug url</th>
                        <td><input type="text" name="slug" id="slug"
                                   maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>subtitle</th>
                        <td><input name="subtitle" id="subtitle" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>more info url</th>
                        <td><input type="text" name="more_info_url" id="more_info_url" maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>description</th>
                        <td><textarea name="description" id="description"
                                      style="width:516px"></textarea></td>
                    </tr>
                    <tr>
                        <th>location 1</th>
                        <td><input type="text" name="location1" id="location1"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>location 2</th>
                        <td><input type="text" name="location2" id="location2"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>CTA button 1</th>
                        <td><input type="text" name="ctabutton1" id="ctabutton1"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>CTA button 2</th>
                        <td><input type="text" name="ctabutton2" id="ctabutton2"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>booth #</th>
                        <td><input type="text" name="boothnum" id="boothnum"
                                   maxlength="50" style="width:115px"></td>
                    </tr>
                    <tr>
                        <th>add info</th>
                        <td><textarea name="add_info" id="add_info"
                                      style="width:516px"></textarea></td>
                    </tr>
                    <tr>
                        <th>Registration link</th>
                        <td><input style="width: 15px; height: 15px;" value="1" type="checkbox" name="is_opened_registration" checked >
                        </td>
                    </tr>
                    <tr>
                        <th>Registration header</th>
                        <td><textarea name="registration_header" id="registration_header"
                                      style="width:516px"></textarea></td>
                    </tr>
                    <?php /*
                    <tr>
                        <th>register url</th>
                        <td><input type="text" name="url" id="url" maxlength="100"
                                   style="width:350px"></td>
                    </tr>
 */ ?>
                    <tr>
                        <th>view map url</th>
                        <td><input type="text" name="map_url" id="map_url"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>thumbnail file</th>
                        <td>
                            <input type="file" name="thumbnail1">
                        </td>
                    </tr>
                    <tr>
                        <th>HERO</th>
                        <td>
                            <input type="file" name="thumbnail2">
                        </td>
                    </tr>
                    <tr>
                        <th>upload file</th>
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

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/footer.php'); ?>
