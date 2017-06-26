<?php
require_once '../DBconnector.php';

$db = new DBC;

$regnum = $_GET['value'];
$ISBN = $_POST['ISBN'];
$title = $_POST['title'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$publi_year = $_POST['publi_year'];
$location = $_POST['location'];
$structure = $_POST['structure'];
$regdate = date('Y-m-d');
$rental = 0;

$query = "insert into book_info values('".$regnum."','".$ISBN."','".$title."','".$author."','".$publisher."','".$publi_year."','".$location."','".$structure."','".$regdate."', '".$rental."')";
$db->DBQ($query);

if(!$db->result)
{
	header("Content-Type: text/html; charset='utf-8'");
	echo "<script>alert('도서등록에 실패하였습니다.');history.back();</script>";
	exit;
	
} else
{
    header("Content-Type: text/html; charset='utf-8'");
	echo "<script>alert('도서등록에 성공했습니다.');location.replace('./doseogwanri.php');</script>";
	exit;
}
?>

