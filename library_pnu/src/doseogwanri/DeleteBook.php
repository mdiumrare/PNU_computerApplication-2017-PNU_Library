<?php
require_once '../DBconnector.php';

$db = new DBC;

$delete = $_GET['del'];

$query = "delete from book_info where regnum='$delete'";
$db->DBQ($query);

header("Content-Type: text/html; charset='utf-8'");
echo "<script>alert('도서정보 삭제 완료');location.replace('./doseogwanri.php');</script>";
exit;
?>

