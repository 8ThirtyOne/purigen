<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$webhelper = new WebHelper();
$dbhelper = new dbHelper();

$PageUrl = '/admin/news/event-registration/list.php';
$PageCode = '010201';
$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

//Parameter
$page = $webhelper->RequestFilter('page', 0, false);
$searchKey = $webhelper->RequestFilter('searchKey', -1, false);
$order = $webhelper->RequestFilter('order', 0, false);

//check parameter
if ($webhelper->isNull($page)) {
    $page = 1;
}
if ($webhelper->isNull($searchKey)) {
    $searchKey = '';
}
if ($webhelper->isNull($order)) {
    $order = 0;
}

$Parameter = "&searchKey=$searchKey&order=$order";

$PageSize = 50;

$dbhelper->dbOpen();
$sql = "select registration_events.*, date_format(registration_events.regdate,'%b %d, %Y') as regdate, events.maintitle
        from registration_events join events on registration_events.event_id = events.pkid";
if ($searchKey !== '') {
    $sql .= " where (firstname like '%$searchKey%' or lastname like '%$searchKey%' or email like '%$searchKey%' ) ";
}

if ($order === 0) {
    $sql .= ' order by pkid desc ';
}

if ($order === 1) {
    $sql .= ' order by firstname desc, lastname desc ';
}
if ($order === 2) {
    $sql .= ' order by firstname, lastname ';
}

if ($order === 3) {
    $sql .= ' order by email desc ';
}
if ($order === 4) {
    $sql .= ' order by email asc ';
}

if ($order === 5) {
    $sql .= ' order by organization desc ';
}
if ($order === 6) {
    $sql .= ' order by organization asc ';
}

if ($order === 7) {
    $sql .= ' order by regdate desc ';
}
if ($order === 8) {
    $sql .= ' order by regdate asc ';
}

$List = $dbhelper->RunSQLReturnRows($sql);
$dbhelper->dbClose();

header('Content-type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename = event-registrations.xls');
echo '<meta http-equiv="Content-Type" content="application/vnd.ms-excel; charset=UTF-8">';
?>
<table>
    <tr>
        <td>Event</td>
        <td>Name</td>
        <td>Email</td>
        <td>Organization</td>
        <td>Phone</td>
        <td>Since</td>
    </tr>
    <?php
    if ($List !== null && count($List) > 0) {
        foreach ($List as $row) {
            ?>
            <tr>
                <td><?= $row['maintitle'] ?></td>
                <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['organization'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['regdate'] ?></td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="5">No data found.</td>
        </tr>
        <?php
    }
    ?>
</table>