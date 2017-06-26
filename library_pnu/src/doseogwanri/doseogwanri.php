<!DOCTYPE html>
<html>
	<head>
		<title>도서관리</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
    <body>
<?php
require_once '../DBconnector.php';

$db = new DBC;

$query = "select * from book_info";
$db->DBQ($query);

$num = $db->result->num_rows;
$data = $db->result->fetch_array();

$maxnum = 0;
?>
	<table  class="table table-striped" id="tableList">
		<tr>
			<th>등록번호</th>
			<th>ISBN</th>
			<th>도서명</th></th>
			<th>저자</th>
			<th>출판사</th>
			<th>출판년도</th>
			<th>도서위치</th>
			<th>자료유형</th>
			<th>등록날짜</th>
			<th>삭제</th>
		</tr>
		<?php
		for($i=0;$i<sizeof($data);$i++)
		{
			echo "<tr>
			<td>$data[regnum]</td>
			<td>$data[ISBN]</td>
			<td>$data[title]</td>
			<td>$data[author]</td>
			<td>$data[publisher]</td>
			<td>$data[publi_year]</td>
			<td>$data[location]</td>
			<td>$data[structure]</td>
			<td>$data[regdate]</td>
			<form action='./DeleteBook.php' method='GET'>
				<input type='hidden' name=del value = $data[regnum]>
				<td><input type='submit' value='X'></td>
			</form>
			</tr>";
			if($maxnum < $data[regnum]) $maxnum = $data[regnum];
			$data = $db->result->fetch_array();
		}
		?>
	</table>
	<div align="center">
		<input type="button" value="도서등록" onclick="location.href='./RegisterBook.php?value=<?=$maxnum?>'">	
	</div>
    </body>
</html>