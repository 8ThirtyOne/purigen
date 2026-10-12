<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

extract($data, EXTR_OVERWRITE);

$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/header.php');

?>
    <script type="text/javascript">
        function search() {
            document.searchFrm.submit();
        }

        function del(id) {
            var f = document.ListFrm;

            if (confirm("Are you sure you want to delete this record?")) {
                $('#' + id).attr("checked", true);
                f.action = "/admin/core-labs/index.php?slug=delete";
                f.submit();
            }
        }

        function modify(id) {
            location.href = "/admin/core-labs/index.php?slug=modifyForm&id=" + id + "&page=<?=$page . $Parameter?>";
        }

        function order(type) {
            var f = document.searchFrm;

            if (type == 0) {
                f.order.value = "0";
            }

            if (type == 1) {
                if (f.order.value == "1") {
                    f.order.value = "2";
                } else {
                    f.order.value = "1";
                }
            }

            if (type == 3) {
                if (f.order.value == "3") {
                    f.order.value = "4";
                } else {
                    f.order.value = "3";
                }
            }

            if (type == 5) {
                if (f.order.value == "5") {
                    f.order.value = "6";
                } else {
                    f.order.value = "5";
                }
            }

            document.searchFrm.submit();
        }

        function checkall() {
            var checkotherall = document.ListFrm.checkotherall;
            var ids = document.ListFrm["ids[]"];

            if (ids != "undefined" && ids != undefined) {
                if (ids.length != "undefined" && ids.length != undefined) {
                    for (var i = 0; i < ids.length; i++) {
                        if (checkotherall.checked)
                            ids[i].checked = true;
                        else
                            ids[i].checked = false;
                    }
                } else {
                    if (checkotherall.checked)
                        ids.checked = true;
                    else
                        ids.checked = false;
                }
            }
        }

        function ischecked() {
            var ids = document.ListFrm["ids[]"];
            var cnt = 0;

            if (ids != "undefined" && ids != undefined) {
                if (ids.length != "undefined" && ids.length != undefined) {
                    for (var i = 0; i < ids.length; i++) {
                        if (ids[i].checked) {
                            cnt++;
                        }
                    }
                } else {
                    if (ids.checked) {
                        cnt++;
                    }
                }
            }

            if (cnt == 0) {
                return false;
            } else {
                return true;
            }
        }

        function excute() {
            var f = document.ListFrm;

            if (ischecked()) {
                if ($('#excute').val() == 1) {
                    if (confirm("Are you sure you want to delete this record?")) {
                        f.action = "/admin/core-labs/index.php?slug=delete";
                        f.submit();
                    }
                } else if ($('#excute').val() == 2) {
                    f.action = "/admin/core-labs/index.php?slug=publish";
                    f.submit();
                } else if ($('#excute').val() == 3) {
                    f.action = "/admin/core-labs/index.php?slug=unpublish";
                    f.submit();
                }
            } else {
                alert("Please select at least one item.");
            }
        }

        function duplicate(id) {
            var f = document.ListFrm;

            if (confirm("Are you sure you want to duplicate this record?")) {
                location.href = "/admin/core-labs/index.php?slug=duplicate&id=" + id + "&page=<?=$page . $Parameter?>";
            }
        }
    </script>


    <div id="container">

        <div id="contents">

            <h2><?= $PageTitle ?></h2>

            <form name="searchFrm" method="get" action="/admin/core-labs/index.php">
                <input type="hidden" name="order" value="<?= $order ?>"/>
                <div class="form_search">
                    <input type="text" name="searchKey" value="<?= $searchKey ?>"> <a href="javascript:search();"
                                                                                      class="bt bt-green">search</a>
                    <a href="/admin/core-labs/index.php?slug=createForm" class="bt bt-green add_new">ADD NEW</a>
                </div>
                <!-- //form_search -->
            </form>

            <h3>operations</h3>

            <div class="data_filter">
                <select id="excute">
                    <option value="0">- Choose an operation -</option>
                    <option value="1">Delete item</option>
                    <option value="2">Publish content</option>
                    <option value="3">Unpublish content</option>
                </select>
                <a href="javascript:excute();" class="bt bt-navy">execute</a>
            </div>
            <!-- //data_filter -->
            <form name="ListFrm" method="post">
                <input type="hidden" name="page" value="<?= $page ?>"/>
                <input type="hidden" name="searchKey" value="<?= $searchKey ?>"/>
                <input type="hidden" name="order" value="<?= $order ?>"/>

                <table class="board_list">
                    <colgroup>
                        <col style="width:2%">
                        <col style="width:10%">
                        <col style="width:23%">
                        <col style="width:20%">
                        <col style="width:10%">
                        <col style="width:15%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="checkotherall" onclick="checkall();"
                                   style="vertical-align: middle"/></th>
                        <th>date</th>
                        <th>organization</th>
                        <th>department</a>
                        </th>
                        <th>
                            <a href="javascript:order(5);">status <?= $order == '3' ? '▲' : ($order == '4' ? '▼' : '') ?></a>
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($List !== null && count($List) > 0) {
                        foreach ($List as $row) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="ids[]" id="ids_<?= $row['id'] ?>"
                                           value="<?= $row['id'] ?>"></td>
                                <td><?= $row['year'] . '/' . str_pad($row ['month'], 2, '0', STR_PAD_LEFT) . '/' . str_pad($row ['day'], 2, '0', STR_PAD_LEFT) ?></td>
                                <td><?= $row['organization'] ?></td>
                                <td>
                                    <?= $row['department'] ?>
                                </td>
                                <td><?= $row['status'] == 1 ? 'Publish' : 'Unpublish' ?></td>
                                <td><a href="javascript:modify('<?= $row['id'] ?>');">Edit</a> | <a
                                            href="javascript:duplicate('<?= $row['id'] ?>');">Duplicate</a> | <a
                                            href="javascript:del('ids_<?= $row['id'] ?>')">Delete</a></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5" align="center">no data found.</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <!-- //board_list -->
            </form>

            <?= $webhelper->GetAdminPageHtml($pageList, $page, $PageUrl, $Parameter, $PageSize) ?>
            <!-- //pagination -->

        </div>
        <!-- //contents -->

    </div>
    <!-- //container -->
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/admin/include/footer.php');