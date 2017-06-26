<!DOCTYPE html>
<html>
	<head>
		<title>대출도서조회</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
		
		<!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <?php
            session_start();
            $user_number = $_SESSION['user_number'];
            $user_name = $_SESSION['user_name'];
            // echo "<script> alert($user_number);</script>";
            // $user_number = '201220123';
            if(!isset($_SESSION['user_number']) || !isset($_SESSION['user_name'])) {
                echo "<script>alert('로그인 후 이용가능합니다.');</script>";
            // 	echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
        	    exit;
            }

            require_once '../DBconnector.php';
            $db = new DBC;
            $query = "select * from borrowed_book_info WHERE userID='$user_number' ORDER BY `borrowed_book_info`.`borrowedDate` ASC ";
            $db->DBQ($query);
            
            $num = $db->result->num_rows;
            $data = $db->result->fetch_array();
        ?>
	</head>
	<script>

	</script>
    <body <?php echo "onload=init($num)" ?> style="margin-top:50px;">
        <div class="container">
            <h3 style="margin:0 0 30px 0; text-align:center" ><?php echo $user_name; ?>님의 대출도서현황</h3>
        	<table class="table table-striped" id="tableList">
    		<tr>
    			<th>제목</th>
    			<th>등록번호</th>
    			<th>대출일</th>
    			<th>반납일</th>
    			<th style='text-align:center;'>연장횟수/연체일</th>
    		</tr>
    		<?php
    		if ($num==0) {
    		    echo "<tr><td colspan='5' style='text-align:center;'>대출중인 도서가 없습니다.</td></tr>";
    		}
    		for($i=0;$i<$num;$i++)
    		{
    			echo "<tr>
    			<td>$data[title]</td>
    			<td><div id='regnum$i'>$data[regnum]</div></td>
    			<td>$data[borrowedDate]</td>
    			<td><div id='returnDate$i'>$data[returnDate]</div></td>
    			<td style='text-align:center;'> <span id='extensionCount$i'>$data[extensionCount] </span> / <span id='extensionDate$i'> $data[extensionDate] </span>
    			<button type='button' class='btn btn-warning btn-xs' style='margin:0 0 0 10px;'onclick='extension($i)'>연장하기</button>
    			</td>
    			</tr>";
                $data = $db->result->fetch_array();
    		}
    		?>
        	</table>
        	<p><h4>※ 주의사항</h4></p>
        	<div style="margin: 0 0 0 10px">
            	<p>▶ 연장 횟수는 최대 3번입니다.</p>
                <p>▶ 대출(연장)한 당일은 추가연장이 불가능</p>
                <p>▶ 연장 기간은 연장한 시점으로부터 계산</p>
                <p>▶ 반납일이 지난경우 연장이 불가능</p>
            </div>
    	</div>
    </body>
    <script>
        function getFormatDate(date){
        	var year = date.getFullYear();              //yyyy
        	var month = (1 + date.getMonth());          //M
        	month = month >= 10 ? month : '0' + month;  // month 두자리로 저장
        	var day = date.getDate();                   //d
        	day = day >= 10 ? day : '0' + day;          //day 두자리로 저장
        	return  year + '-' + month + '-' + day;
        }
    
        // init(<?php echo "$num" ?>);
        function init(num){
            for(var i=0; i<num; i++){
                var regnum = document.getElementById("regnum"+i).innerHTML; 
                var returnDate = document.getElementById("returnDate"+i).innerHTML; 
                // console.log(regnum);
                // console.log(returnDate);
                returnDate = new Date(returnDate);
                
                var getNowDate = new Date(); // 오늘 날짜
                var getNowDateText = getFormatDate(getNowDate);
                getNowDate = new Date(getNowDateText);
                
                var extension = (getNowDate-returnDate)/1000/60/60/24; // 이용가능일자
                // console.log(extension);
                if(extension>0){// 연체일이 있으면
                var temp1 = i;
                var temp2 = extension;
                    $.ajax({
                        url:"./refresh.php?regnum=" + regnum + "&extensionDate=" + extension,
                        async: false,
                        success:function(data){
                            $('#extensionDate'+temp1).html(temp2);
                        }
                    })
                }
            }
        }
    </script>
</html>


<script>
    function extension(num){
        var regnum = document.getElementById("regnum"+num).innerHTML; 
        var returnDate = document.getElementById("returnDate"+num).innerHTML; 
        var extensionCount = document.getElementById("extensionCount"+num).innerHTML; 
        returnDate = new Date(returnDate);

        var extensionReturnDate = new Date(); // 오늘로부터 +15
        extensionReturnDate.setDate(extensionReturnDate.getDate() + 15);
        var extensionReturnDateText = getFormatDate(extensionReturnDate);
        extensionReturnDate = new Date(extensionReturnDateText);
                
        var getNowDate = new Date(); // 오늘 날짜
        var getNowDateText = getFormatDate(getNowDate);
        getNowDate = new Date(getNowDateText);
        
        var reExtension = (extensionReturnDate-returnDate)/1000/60/60/24; // 연장가능한 추가일자.
        var extension = (returnDate-getNowDate)/1000/60/60/24; // 이용가능일자
        
        console.log(reExtension);
        console.log(extension);
        
        if(extension>=0 && reExtension!=0 && extensionCount<3){
            $.ajax({
                url:"./extension.php?regnum=" + regnum + "&extensionReturnDate=" + extensionReturnDateText,
                dataType:'json',
                success:function(data){
                    alert('연장되었습니다.');
                    $('#extensionCount'+num).html(data[0]);
                    $('#returnDate'+num).html(data[1]);
                }
            })
        }
        else if(reExtension==0){
            alert('대출(연장)한 당일은 추가연장이 불가능합니다.');
        }
        else if(extensionCount>=3){
            alert('연장 횟수는 최대 3번입니다.');
        }
        else{
            alert('해당 도서의 반납일이 지났습니다.');
        }
    }
    
</script>