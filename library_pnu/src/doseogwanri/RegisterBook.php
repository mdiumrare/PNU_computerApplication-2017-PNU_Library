<?php $regnum = $_GET['value'] + 1;?>
<!DOCTYPE html>
<html>
	<head>
		<title>도서등록</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
    <body>
    	<form action='./RegistResult.php?value=<?=$regnum?>' method='post'>
        	<table class="table table-striped" id="tableList">
	        	<tr>
	        		<th colspan='2'>도서등록</th>
	        	</tr>
	        	<tr>
	        		<td>ISBN</td>
	        		<td><input type='text' size='16' name='ISBN' required/></td>
	        	</tr>
	        	<tr>
	        		<td>책제목</td>
	        		<td><input type='text' size='16' name='title' required/></td>
	        	</tr>
	        	<tr>
	        		<td>저자</td>
	        		<td><input type='text' size='16' name='author' required/></td>
	        	</tr>
	        	<tr>
	        		<td>출판사</td>
	        		<td><input type='text' size='16' name='publisher' required/></td>
	        	</tr>
	        	<tr>
	        		<td>출판년도</td>
	        		<td><input type='text' size='16' name='publi_year' required/></td>
	        	</tr>
	        	<tr>
	        		<td>도서위치</td>
	        		<td><input type='text' size='16' name='location' required/></td>
	        	</tr>
	        	<tr>
	        		<td>자료유형</td>
	        		<td>
	        			<select size='1' name='structure'/>
	        				<option value='단행본'>단행본</option>
	        				<option value='정기간행물'>정기간행물</option>
	        		</td>
	        	</tr>
            	<tr>
		         	<td colspan='2'><input type='submit'value='등록'/></td>
	    	    </tr>
	        </table>
	    </form>
    </body>
</html>