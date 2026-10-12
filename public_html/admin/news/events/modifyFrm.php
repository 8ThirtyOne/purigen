<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();

$PageUrl = "/admin/news/events/list.php";
$PageCode = "030201";
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$pkid = $webhelper->RequestFilter("pkid", 0, false);
$page = $webhelper->RequestFilter("page", 0, false);
$searchKey = $webhelper->RequestFilter("searchKey", -1, false);
$order = $webhelper->RequestFilter("order", 0, false);

//check parameter
if ($webhelper->isNull($page)) $page = 1;
if ($webhelper->isNull($searchKey)) $searchKey = "";
if ($webhelper->isNull($order)) $order = 0;

$Parameter = "?page=$page&searchKey=$searchKey&order=$order";

try {
    if (!$pkid) {
        throw new Exception('pkid must be set');
    }
    $event = (object)models\Events::find($pkid)->to_array();
} catch (Exception $e) {
    $webhelper->AlertMessageAndGo($e->getMessage(), "/admin/news/events/list.php" . $Parameter);
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/header.php');
?>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
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
                height: 400,
            });
        });

        function checkFrm() {
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

            if (f.type.value == "0") {
                $("#type").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.startyear.value == "") {
                $("#startyear").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.startmonth.value == "0") {
                $("#startmonth").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.startday.value == "0") {
                $("#startday").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.endyear.value == "") {
                $("#endyear").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.endmonth.value == "0") {
                $("#endmonth").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.endday.value == "0") {
                $("#endday").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.maintitle.value == "") {
                $("#maintitle").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.subtitle.value == "") {
                $("#subtitle").css("border", "1px solid #ff0000");
                isOk = false;
            }

            if (f.location1.value == "") {
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


            if (isOk) {
                f.submit();
            }
        }

        function del() {
            let f = document.regFrm;
            if (confirm("Are you sure you want to delete this record?")) {
                f.action = "/admin/news/events/delete.php";
                f.submit();
            }
        }
    </script>

    <div id="container">

        <div id="contents">

            <h2>upcoming events</h2>

            <form method="post" name="regFrm" action="/admin/news/events/modify.php" enctype="multipart/form-data">
                <input type="hidden" name="pkid" value="<?= $event->pkid ?>"/>
                <input type="hidden" name="pkids[]" value="<?= $event->pkid ?>"/>
                <input type="hidden" name="page" value="<?= $page ?>"/>
                <input type="hidden" name="searchKey" value="<?= $searchKey ?>"/>
                <input type="hidden" name="order" value="<?= $order ?>"/>
                <input type="hidden" name="oldthumbnail1" value="<?= $event->thumbnail1 ?>"/>
                <input type="hidden" name="oldthumbnail2" value="<?= $event->thumbnail2 ?>"/>
                <input type="hidden" name="oldFile" value="<?= $event->filename ?>"/>
                <input type="hidden" name="oldOrgFile" value="<?= $event->orgfilename ?>"/>

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
                                <option value="1" <?= $webhelper->MakeSelectedValue('1', $event->type) ?>>
                                    Conference
                                </option>
                                <option value="2" <?= $webhelper->MakeSelectedValue('2', $event->type) ?>>
                                    Webinar
                                </option>
                                <option value="3" <?= $webhelper->MakeSelectedValue('3', $event->type) ?>>
                                    Meeting
                                </option>
                                <option value="4" <?= $webhelper->MakeSelectedValue('4', $event->type) ?>>
                                    Online
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>start day</th>
                        <td>
                            <select name="startmonth" id="startmonth">
                                <option value="0" <?= $webhelper->MakeSelectedValue("0", $event->startmonth) ?>>-
                                    Month -
                                </option>
                                <option value="01" <?= $webhelper->MakeSelectedValue("01", $event->startmonth) ?>>
                                    January
                                </option>
                                <option value="02" <?= $webhelper->MakeSelectedValue("02", $event->startmonth) ?>>
                                    February
                                </option>
                                <option value="03" <?= $webhelper->MakeSelectedValue("03", $event->startmonth) ?>>
                                    March
                                </option>
                                <option value="04" <?= $webhelper->MakeSelectedValue("04", $event->startmonth) ?>>
                                    April
                                </option>
                                <option value="05" <?= $webhelper->MakeSelectedValue("05", $event->startmonth) ?>>
                                    May
                                </option>
                                <option value="06" <?= $webhelper->MakeSelectedValue("06", $event->startmonth) ?>>
                                    June
                                </option>
                                <option value="07" <?= $webhelper->MakeSelectedValue("07", $event->startmonth) ?>>
                                    July
                                </option>
                                <option value="08" <?= $webhelper->MakeSelectedValue("08", $event->startmonth) ?>>
                                    August
                                </option>
                                <option value="09" <?= $webhelper->MakeSelectedValue("09", $event->startmonth) ?>>
                                    September
                                </option>
                                <option value="10" <?= $webhelper->MakeSelectedValue("10", $event->startmonth) ?>>
                                    October
                                </option>
                                <option value="11" <?= $webhelper->MakeSelectedValue("11", $event->startmonth) ?>>
                                    November
                                </option>
                                <option value="12" <?= $webhelper->MakeSelectedValue("12", $event->startmonth) ?>>
                                    December
                                </option>
                            </select>
                            <select name="startday" id="startday">
                                <option value="0" <?= $webhelper->MakeSelectedValue("0", $event->startday) ?>>- Day
                                    -
                                </option>
                                <option value="01" <?= $webhelper->MakeSelectedValue("01", $event->startday) ?>>
                                    01
                                </option>
                                <option value="02" <?= $webhelper->MakeSelectedValue("02", $event->startday) ?>>
                                    02
                                </option>
                                <option value="03" <?= $webhelper->MakeSelectedValue("03", $event->startday) ?>>
                                    03
                                </option>
                                <option value="04" <?= $webhelper->MakeSelectedValue("04", $event->startday) ?>>
                                    04
                                </option>
                                <option value="05" <?= $webhelper->MakeSelectedValue("05", $event->startday) ?>>
                                    05
                                </option>
                                <option value="06" <?= $webhelper->MakeSelectedValue("06", $event->startday) ?>>
                                    06
                                </option>
                                <option value="07" <?= $webhelper->MakeSelectedValue("07", $event->startday) ?>>
                                    07
                                </option>
                                <option value="08" <?= $webhelper->MakeSelectedValue("08", $event->startday) ?>>
                                    08
                                </option>
                                <option value="09" <?= $webhelper->MakeSelectedValue("09", $event->startday) ?>>
                                    09
                                </option>
                                <option value="10" <?= $webhelper->MakeSelectedValue("10", $event->startday) ?>>
                                    10
                                </option>
                                <option value="11" <?= $webhelper->MakeSelectedValue("11", $event->startday) ?>>
                                    11
                                </option>
                                <option value="12" <?= $webhelper->MakeSelectedValue("12", $event->startday) ?>>
                                    12
                                </option>
                                <option value="13" <?= $webhelper->MakeSelectedValue("13", $event->startday) ?>>
                                    13
                                </option>
                                <option value="14" <?= $webhelper->MakeSelectedValue("14", $event->startday) ?>>
                                    14
                                </option>
                                <option value="15" <?= $webhelper->MakeSelectedValue("15", $event->startday) ?>>
                                    15
                                </option>
                                <option value="16" <?= $webhelper->MakeSelectedValue("16", $event->startday) ?>>
                                    16
                                </option>
                                <option value="17" <?= $webhelper->MakeSelectedValue("17", $event->startday) ?>>
                                    17
                                </option>
                                <option value="18" <?= $webhelper->MakeSelectedValue("18", $event->startday) ?>>
                                    18
                                </option>
                                <option value="19" <?= $webhelper->MakeSelectedValue("19", $event->startday) ?>>
                                    19
                                </option>
                                <option value="20" <?= $webhelper->MakeSelectedValue("20", $event->startday) ?>>
                                    20
                                </option>
                                <option value="21" <?= $webhelper->MakeSelectedValue("21", $event->startday) ?>>
                                    21
                                </option>
                                <option value="22" <?= $webhelper->MakeSelectedValue("22", $event->startday) ?>>
                                    22
                                </option>
                                <option value="23" <?= $webhelper->MakeSelectedValue("23", $event->startday) ?>>
                                    23
                                </option>
                                <option value="24" <?= $webhelper->MakeSelectedValue("24", $event->startday) ?>>
                                    24
                                </option>
                                <option value="25" <?= $webhelper->MakeSelectedValue("25", $event->startday) ?>>
                                    25
                                </option>
                                <option value="26" <?= $webhelper->MakeSelectedValue("26", $event->startday) ?>>
                                    26
                                </option>
                                <option value="27" <?= $webhelper->MakeSelectedValue("27", $event->startday) ?>>
                                    27
                                </option>
                                <option value="28" <?= $webhelper->MakeSelectedValue("28", $event->startday) ?>>
                                    28
                                </option>
                                <option value="29" <?= $webhelper->MakeSelectedValue("29", $event->startday) ?>>
                                    29
                                </option>
                                <option value="30" <?= $webhelper->MakeSelectedValue("30", $event->startday) ?>>
                                    30
                                </option>
                                <option value="31" <?= $webhelper->MakeSelectedValue("31", $event->startday) ?>>
                                    31
                                </option>
                            </select>
                            <input type="text" name="startyear" id="startyear" value="<?= $event->startyear ?>"
                                   maxlength="4" style="width:60px">
                        </td>
                    </tr>
                    <tr>
                        <th>end day</th>
                        <td>
                            <select name="endmonth" id="endmonth">
                                <option value="0" <?= $webhelper->MakeSelectedValue("0", $event->endmonth) ?>>-
                                    Month -
                                </option>
                                <option value="01" <?= $webhelper->MakeSelectedValue("01", $event->endmonth) ?>>
                                    January
                                </option>
                                <option value="02" <?= $webhelper->MakeSelectedValue("02", $event->endmonth) ?>>
                                    February
                                </option>
                                <option value="03" <?= $webhelper->MakeSelectedValue("03", $event->endmonth) ?>>
                                    March
                                </option>
                                <option value="04" <?= $webhelper->MakeSelectedValue("04", $event->endmonth) ?>>
                                    April
                                </option>
                                <option value="05" <?= $webhelper->MakeSelectedValue("05", $event->endmonth) ?>>
                                    May
                                </option>
                                <option value="06" <?= $webhelper->MakeSelectedValue("06", $event->endmonth) ?>>
                                    June
                                </option>
                                <option value="07" <?= $webhelper->MakeSelectedValue("07", $event->endmonth) ?>>
                                    July
                                </option>
                                <option value="08" <?= $webhelper->MakeSelectedValue("08", $event->endmonth) ?>>
                                    August
                                </option>
                                <option value="09" <?= $webhelper->MakeSelectedValue("09", $event->endmonth) ?>>
                                    September
                                </option>
                                <option value="10" <?= $webhelper->MakeSelectedValue("10", $event->endmonth) ?>>
                                    October
                                </option>
                                <option value="11" <?= $webhelper->MakeSelectedValue("11", $event->endmonth) ?>>
                                    November
                                </option>
                                <option value="12" <?= $webhelper->MakeSelectedValue("12", $event->endmonth) ?>>
                                    December
                                </option>
                            </select>
                            <select name="endday" id="endday">
                                <option value="0" <?= $webhelper->MakeSelectedValue("0", $event->endday) ?>>- Day
                                    -
                                </option>
                                <option value="01" <?= $webhelper->MakeSelectedValue("01", $event->endday) ?>>01
                                </option>
                                <option value="02" <?= $webhelper->MakeSelectedValue("02", $event->endday) ?>>02
                                </option>
                                <option value="03" <?= $webhelper->MakeSelectedValue("03", $event->endday) ?>>03
                                </option>
                                <option value="04" <?= $webhelper->MakeSelectedValue("04", $event->endday) ?>>04
                                </option>
                                <option value="05" <?= $webhelper->MakeSelectedValue("05", $event->endday) ?>>05
                                </option>
                                <option value="06" <?= $webhelper->MakeSelectedValue("06", $event->endday) ?>>06
                                </option>
                                <option value="07" <?= $webhelper->MakeSelectedValue("07", $event->endday) ?>>07
                                </option>
                                <option value="08" <?= $webhelper->MakeSelectedValue("08", $event->endday) ?>>08
                                </option>
                                <option value="09" <?= $webhelper->MakeSelectedValue("09", $event->endday) ?>>09
                                </option>
                                <option value="10" <?= $webhelper->MakeSelectedValue("10", $event->endday) ?>>10
                                </option>
                                <option value="11" <?= $webhelper->MakeSelectedValue("11", $event->endday) ?>>11
                                </option>
                                <option value="12" <?= $webhelper->MakeSelectedValue("12", $event->endday) ?>>12
                                </option>
                                <option value="13" <?= $webhelper->MakeSelectedValue("13", $event->endday) ?>>13
                                </option>
                                <option value="14" <?= $webhelper->MakeSelectedValue("14", $event->endday) ?>>14
                                </option>
                                <option value="15" <?= $webhelper->MakeSelectedValue("15", $event->endday) ?>>15
                                </option>
                                <option value="16" <?= $webhelper->MakeSelectedValue("16", $event->endday) ?>>16
                                </option>
                                <option value="17" <?= $webhelper->MakeSelectedValue("17", $event->endday) ?>>17
                                </option>
                                <option value="18" <?= $webhelper->MakeSelectedValue("18", $event->endday) ?>>18
                                </option>
                                <option value="19" <?= $webhelper->MakeSelectedValue("19", $event->endday) ?>>19
                                </option>
                                <option value="20" <?= $webhelper->MakeSelectedValue("20", $event->endday) ?>>20
                                </option>
                                <option value="21" <?= $webhelper->MakeSelectedValue("21", $event->endday) ?>>21
                                </option>
                                <option value="22" <?= $webhelper->MakeSelectedValue("22", $event->endday) ?>>22
                                </option>
                                <option value="23" <?= $webhelper->MakeSelectedValue("23", $event->endday) ?>>23
                                </option>
                                <option value="24" <?= $webhelper->MakeSelectedValue("24", $event->endday) ?>>24
                                </option>
                                <option value="25" <?= $webhelper->MakeSelectedValue("25", $event->endday) ?>>25
                                </option>
                                <option value="26" <?= $webhelper->MakeSelectedValue("26", $event->endday) ?>>26
                                </option>
                                <option value="27" <?= $webhelper->MakeSelectedValue("27", $event->endday) ?>>27
                                </option>
                                <option value="28" <?= $webhelper->MakeSelectedValue("28", $event->endday) ?>>28
                                </option>
                                <option value="29" <?= $webhelper->MakeSelectedValue("29", $event->endday) ?>>29
                                </option>
                                <option value="30" <?= $webhelper->MakeSelectedValue("30", $event->endday) ?>>30
                                </option>
                                <option value="31" <?= $webhelper->MakeSelectedValue("31", $event->endday) ?>>31
                                </option>
                            </select>
                            <input type="text" name="endyear" id="endyear" value="<?= $event->endyear ?>"
                                   maxlength="4" style="width:60px">
                        </td>
                    </tr>
                    <tr>
                        <th>title</th>
                        <td><input type="text" name="maintitle" value="<?= $event->maintitle ?>" id="maintitle"
                                   maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>slug url</th>
                        <td><input type="text" name="slug" value="<?= $event->slug ?>" id="slug"
                                   maxlength="200" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>subtitle</th>
                        <td><input name="subtitle" id="subtitle" value="<?= $event->subtitle ?>"
                                   style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>description</th>
                        <td><textarea name="description" id="description"
                                      style="width:516px"><?= $event->description ?></textarea></td>
                    </tr>
                    <tr>
                        <th>location 1</th>
                        <td><input type="text" name="location1" value="<?= $event->location1 ?>" id="location1"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>location 2</th>
                        <td><input type="text" name="location2" value="<?= $event->location2 ?>" id="location2"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>hero button</th>
                        <td><input type="text" name="ctabutton1" value="<?= $event->ctabutton1 ?>" id="ctabutton1"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
					<tr>
                        <th>hero button url</th>
                        <td><input type="text" name="more_info_url" value="<?= $event->more_info_url ?>"
                                   id="more_info_url" maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>body button</th>
                        <td><input type="text" name="ctabutton2" value="<?= $event->ctabutton2 ?>" id="ctabutton2"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
					<tr>
                        <th>body button url</th>
                        <td><input type="text" name="map_url" value="<?= $event->map_url ?>" id="map_url"
                                   maxlength="100" style="width:350px"></td>
                    </tr>
                    <tr>
                        <th>booth #</th>
                        <td><input type="text" name="boothnum" value="<?= $event->booth ?>" id="boothnum"
                                   maxlength="50" style="width:115px"></td>
                    </tr>
                    <tr>
                        <th>add info</th>
                        <td><textarea name="add_info" id="add_info"
                                      style="width:516px"><?= $event->add_info ?></textarea></td>
                    </tr>
                    <tr>
                        <th>Registration link</th>
                        <td><input style="width: 15px; height: 15px;" value="1" type="checkbox" name="is_opened_registration" <?php if($event->is_opened_registration){ echo 'checked' ;} ?>>
                        </td>
                    </tr>
                    <tr>
                        <th>Registration header</th>
                        <td><textarea name="registration_header" id="registration_header"
                                      style="width:516px"><?= $event->registration_header ?></textarea></td>
                    </tr>
                    <?php /*
                        <tr>
                            <th>register url</th>
                            <td><input type="text" name="url" value="<?= $event->url ?>" id="url" maxlength="100"
                                       style="width:350px"></td>
                        </tr>
                    */ ?>
                    
                    <tr>
                        <th>thumbnail file</th>
                        <td>
                            <input type="file" name="thumbnail1">
                            <?php
                            if ($event->thumbnail1) {
                                echo "<div style=\"margin-top:10px\">";
                                echo "<img src=\"/files/events/" . $event->thumbnail1 . "\">";
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
                            if ($event->thumbnail2) {
                                echo "<div style=\"margin-top:10px\">";
                                echo "<img src=\"/files/events/" . $event->thumbnail2 . "\"style=\"max-width: 100%;\">";
                                echo "&nbsp;&nbsp;<input type=\"checkbox\" name=\"deleteThumbnail2\" value=\"1\"/> Delete File\n";
                                echo "</div>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>upload file</th>
                        <td>
                            <input type="file" name="up_file">
                            <?php
                            if ($event->filename) {
                                echo "<div style=\"margin-top:10px\">";
                                echo $event->filename;
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

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/footer.php'); ?>