<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = "/admin/news/event-registration/list.php";
$PageCode = "030201";
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$page = $webhelper->RequestFilter("page", 0, false);
$searchKey = $webhelper->RequestFilter("searchKey", -1, false);
$order = $webhelper->RequestFilter("order", 0, false);

//check parameter
if($webhelper->isNull($page)) $page = 1;
if($webhelper->isNull($searchKey)) $searchKey = "";
if($webhelper->isNull($order)) $order = 0;

$Parameter = "&searchKey=$searchKey&order=$order";

$PageSize = 50;

$dbhelper->dbOpen();
$sql = "select registration_events.*, date_format(registration_events.regdate,'%b %d, %Y') as regdate, events.maintitle
        from registration_events join events on registration_events.event_id = events.pkid";
if($searchKey != "")
{
    $sql .= " where (firstname like '%$searchKey%' or lastname like '%$searchKey%' or email like '%$searchKey%' ) ";
}

if($order == 0)
    $sql .= " order by registration_events.pkid desc ";

if( $order == 1)
    $sql .= " order by firstname desc, lastname desc ";
if( $order == 2)
    $sql .= " order by firstname, lastname ";

if( $order == 3)
    $sql .= " order by email desc ";
if( $order == 4)
    $sql .= " order by email asc ";

if( $order == 5)
    $sql .= " order by organization desc ";
if( $order == 6)
    $sql .= " order by organization asc ";

if( $order == 7)
    $sql .= " order by registration_events.regdate desc ";
if( $order == 8)
    $sql .= " order by registration_events.regdate asc ";

if( $order == 9)
    $sql .= " order by events.maintitle desc ";
if( $order == 10)
    $sql .= " order by events.maintitle asc ";

$List = $dbhelper->RunSQLReturnRowsSub($sql, $page, $PageSize, $TotalCount);
$pageList = $webhelper->getPaging($TotalCount, $page, $PageSize);

$dbhelper->dbClose();
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/header.php')?>
    <script type="text/javascript">
        function search()
        {
            document.searchFrm.submit();
        }

        function del(pkid)
        {
            var f = document.ListFrm;

            if(confirm("Are you sure you want to delete this record?"))
            {
                $('#'+pkid).attr("checked", true);
                f.action = "/admin/news/event-registration/delete.php";
                f.submit();
            }
        }

        function modify(pkid)
        {
            location.href = "/admin/news/event-registration/modifyFrm.php?pkid="+pkid+"&page=<?=$page.$Parameter?>";
        }

        function order(type)
        {
            var f = document.searchFrm;

            if(type == 0)
            {
                f.order.value = "0";
            }

            if(type == 1)
            {
                if(f.order.value == "1")
                {
                    f.order.value = "2";
                }else
                {
                    f.order.value = "1";
                }
            }

            if(type == 3)
            {
                if(f.order.value == "3")
                {
                    f.order.value = "4";
                }else
                {
                    f.order.value = "3";
                }
            }

            if(type == 5)
            {
                if(f.order.value == "5")
                {
                    f.order.value = "6";
                }else
                {
                    f.order.value = "5";
                }
            }

            if(type == 7)
            {
                if(f.order.value == "7")
                {
                    f.order.value = "8";
                }else
                {
                    f.order.value = "7";
                }
            }
            if(type == 9)
            {
                if(f.order.value == "9")
                {
                    f.order.value = "10";
                }else
                {
                    f.order.value = "9";
                }
            }

            document.searchFrm.submit();
        }

        function checkall()
        {
            var checkotherall = document.ListFrm.checkotherall;
            var pkids = document.ListFrm["pkids[]"];

            if (pkids != "undefined" && pkids != undefined)
            {
                if (pkids.length != "undefined" && pkids.length != undefined)
                {
                    for (i = 0; i < pkids.length; i++)
                    {
                        if(checkotherall.checked)
                            pkids[i].checked = true;
                        else
                            pkids[i].checked = false;
                    }
                } else
                {
                    if(checkotherall.checked)
                        pkids.checked = true;
                    else
                        pkids.checked = false;
                }
            }
        }

        function ischecked()
        {
            var pkids = document.ListFrm["pkids[]"];
            var cnt = 0;

            if (pkids != "undefined" && pkids != undefined)
            {
                if (pkids.length != "undefined" && pkids.length != undefined)
                {
                    for (i = 0; i < pkids.length; i++)
                    {
                        if (pkids[i].checked)
                        {
                            cnt++;
                        }
                    }
                } else
                {
                    if (pkids.checked)
                    {
                        cnt++;
                    }
                }
            }

            if (cnt == 0)
            {
                return false;
            }else
            {
                return true;
            }
        }

        function execute()
        {
            var f = document.ListFrm;

            if(ischecked())
            {
                if($('#execute').val() == 1)
                {
                    if(confirm("Are you sure you want to delete this record?"))
                    {
                        f.action = "/admin/news/event-registration/delete.php";
                        f.submit();
                    }
                }else if($('#execute').val() == 2)
                {
                    f.action = "/admin/news/event-registration/publish.php";
                    f.submit();
                }else if($('#execute').val() == 3)
                {
                    f.action = "/admin/news/event-registration/unpublish.php";
                    f.submit();
                }
            }else
            {
                if($('#execute').val() == 4)
                {
                    f.action = "/admin/news/event-registration/excel.php";
                    f.submit();
                }else
                {
                    alert("Please select at least one item.");
                }
            }
        }
    </script>

    <div id="container">

        <div id="contents">

            <h2>Event registration</h2>

            <form name="searchFrm" method="get" action="/admin/news/event-registration/list.php">
                <input type="hidden" name="order" value="<?=$order?>"/>
                <div class="form_search">
                    <input type="text" name="searchKey" value="<?=$searchKey?>"> <a href="javascript:search();" class="bt bt-green">Search</a>
                    <a href="/admin/news/event-registration/registerFrm.php" class="bt bt-green add_new">ADD NEW</a>
                </div>
                <!-- //form_search -->
            </form>

            <h3>operations</h3>

            <div class="data_filter">
                <select id="execute">
                    <option value="0">- Choose an operation -</option>
                    <option value="1">Delete</option>
                    <option value="4">Export Data</option>
                </select>
                <a href="javascript:execute();" class="bt bt-navy">Execute</a>
            </div>
            <!-- //data_filter -->
            <form name="ListFrm" method="post">
                <input type="hidden" name="page"  value="<?=$page?>"/>
                <input type="hidden" name="searchKey"  value="<?=$searchKey?>"/>
                <input type="hidden" name="order"  value="<?=$order?>"/>

                <table class="board_list">
                    <colgroup>
                        <col style="width:2%">
                        <col style="width:15%">
                        <col style="width:13%">
                        <col style="width:25%">
                        <col style="width:25%">
                        <col style="width:10%">
                        <col style="width:10%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="checkotherall" onclick="checkall();" style="vertical-align: middle"/></th>
                        <th><a href="javascript:order(1);">Name <?=$order == "1" ? "▲" : ($order == "2" ? "▼" : "")?></a></th>
                        <th><a href="javascript:order(9);">Event <?=$order == "9" ? "▲" : ($order == "10" ? "▼" : "")?></a></th>
                        <th><a href="javascript:order(3);">Email <?=$order == "3" ? "▲" : ($order == "4" ? "▼" : "")?></a></th>
                        <th><a href="javascript:order(5);">Organization <?=$order == "5" ? "▲" : ($order == "6" ? "▼" : "")?></a></th>
                        <th><a href="javascript:order(7);">Since <?=$order == "7" ? "▲" : ($order == "8" ? "▼" : "")?></a></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($List != null && count($List) > 0)
                    {
                        $num; $i=0;
                        foreach ($List as $row)
                        {
                            $num = $TotalCount - ($i++) - ($PageSize * ($page - 1));
                            ?>
                            <tr>
                                <td><input type="checkbox" name="pkids[]" id="pkids_<?=$row["pkid"]?>" value="<?=$row["pkid"]?>"></td>
                                <td><a href="javascript:modify('<?=$row["pkid"]?>');"><?=$row["firstname"]?> <?=$row["lastname"]?></a></td>
                                <td><?=$row["maintitle"]?></td>
                                <td><?=$row["email"]?></td>
                                <td><?=$row["organization"]?></td>
                                <td><?=$row["regdate"]?></td>
                                <td><a href="javascript:modify('<?=$row["pkid"]?>');">Edit</a>  |  <a href="javascript:del('pkids_<?=$row["pkid"]?>')">Delete</a></td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="6" align="center">No data found.</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <!-- //board_list -->
            </form>
            <?=$webhelper->GetAdminPageHtml($pageList, $page, $PageUrl, $Parameter, $PageSize)?>
            <!-- //pagination -->

        </div>
        <!-- //contents -->

    </div>
    <!-- //container -->


<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/footer.php')?>