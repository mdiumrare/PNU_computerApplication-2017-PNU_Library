<!DOCTYPE html>
<html>
	<head>
		<title>도서검색</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
		
		<!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="bookSearch.css">
            <?php
                require_once '../DBconnector.php';
                $db = new DBC;
                $query = "select * from book_info";
                $db->DBQ($query);
                
                $num = $db->result->num_rows;
                $data = $db->result->fetch_array();
            ?>
	</head>
    <body style="margin-top:30px;">
        <div class="container">
                <!--<button type="button" class="btn btn-info" style="float: right; margin: 10px;" onclick="location.href='../main.php'">홈으로</button>-->
                <select id="category" style="margin:10px;">
                  <option value="all" selected>전체</option>
                    <option value="title">서명</option>
                    <option value="author">저자</option>
                    <option value="publisher">출판사</option>
               </select>
                <div class="input-group" style="margin:10px 10% 10px 10%;">
                    <input type="text" class="form-control" id="keyword" placeholder="Search" onKeyDown="f(0);">
                    <div class="input-group-btn">
                      <button class="btn btn-default" id="execute" value="execute" onclick="f(1)">
                        <i class="glyphicon glyphicon-search"></i>
                      </button>
                    </div>
                </div>
                
        	<table class="table table-striped" id="tableList">
    		<tr>
    		    <th>ISBN</th>
    			<th>등록번호</th>
    			<th>제목</th>
    			<th>저자</th>
    			<th>출판사</th>
    		    <th>출판연도</th>
    		    <th>자료유형</th>
    			<th>도서위치</th>
    			<th>대출여부</th>
    		</tr>
    		<?php
    		for($i=0;$i<$num;$i++)
    		{
    		    if($data[rental] == 0){
    		        $flag = '대출가능';
    		    }
    		    else{
                    $flag = '대출중';
    		    }
    			echo "<tr>
    			<td>$data[ISBN]</td>
    			<td>$data[regnum]</td>
    			<td>$data[title]</td>
    			<td>$data[author]</td>
    			<td>$data[publisher]</td>
    			<td>$data[publi_year]</td>
    			<td>$data[structure]</td>
    			<td>$data[location]</td>
    			<td>$flag</td>
    			</tr>";
                $data = $db->result->fetch_array();
    		}
    		?>
        	</table>
    	</div>
    </body>
</html>

<script>
    function f(flag){
        if(flag == 0 && event.keyCode != 13){
        }
        else{
            var category = document.getElementById("category").value; 
            var keyword = document.getElementById("keyword").value; 
            console.log(category);
            console.log(keyword);
            $.ajax({
                url:"./getlist.php?keyword=" + keyword + "&category=" + category,
                dataType:'json',
                success:function(data){
                    var str = '';
                    str = "<table class='table table-striped' id='tableList'><tr><th>ISBN</th><th>등록번호</th><th>제목</th><th>저자</th><th>출판사</th><th>출판연도</th><th>자료유형</th><th>도서위치</th><th>대출여부</th></tr>"
                    
            		if (data.length == 0) {
            		    str += "<tr><td colspan='10' style='text-align:center;'>키워드를 포함하는 도서가 없습니다.</td></tr>";
            		}
            		
                    for (var i = 0; i < data.length; i++) {
                        str += "<tr> <td>"+ data[i]['isbn'] +"</td> <td>"+ data[i]['regnum'] +"</td> <td>"+ data[i]['title'] +"</td> <td>"+ data[i]['author'] +"</td> <td>"+ data[i]['publisher'] +"</td> <td>"+ data[i]['publi_year'] +"</td> <td>"+ data[i]['structure'] +"</td> <td>"+ data[i]['location'] +"</td> <td>"+ data[i]['rental'] +"</td></tr>";
                    }
                    str += "</table>";
                    $('#tableList').html(str);
            
                }
            })
        }
    }
</script>
        