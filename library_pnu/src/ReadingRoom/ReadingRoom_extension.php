<?php
require_once './ReadingRoomDAO.php';
session_start();
$starttime;
$endtime;
$extendtime=0;
$readingroomID;
$seatnumber;
            $user_number = $_SESSION['user_number'];
            // echo "<script> alert($user_number);</script>";
            // $user_number = '201220123';
            if(!isset($_SESSION['user_number']) || !isset($_SESSION['user_name'])) {
                echo "<script>alert('you need login');</script>";
            // 	echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
        	    exit;
            }

function myReadingRoomstate($userID){
  global $readingroomID;
  global $starttime;
  global $endtime;
  global $extendtime;
  global $seatnumber;
  $DAO = new ReadingRoomDAO;
  $result = $DAO->myReadingRoom($userID);
  $num = $result->num_rows;
    for($i = 0; $i < $num; $i++){
        $data = $result->fetch_array();
       // echo $data[UserID];
       // echo $data[readingroomID];
				$readingroomID=$data[readingroomID];
       // echo $data[seatnumber];
				$seatnumber=$data[seatnumber];
       // echo $data[starttime];
				$starttime=$data[starttime];
       // echo $data[endtime];
				$endtime=$data[endtime];
       //  echo $data[extendtime];
				$extendtime=$data[extendtime];
        #$DAO->getUserName($reservation[user_number_1])
    }
}

function extensionreadingroom($userID,$endtime){
  $DAO = new ReadingRoomDAO;
  $result = $DAO->extendreadingroom($userID,$endtime);
}
?>

<html>
	<head>
		<title>열람실좌석연장</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    
		<!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    <script  type="text/javascript">
    	function extensiontime(userID,extendtime,endtime){
    	    var now = new Date();
    	    var currenttime =now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
    	    var nowtimesplit=currenttime.split(':');
    	    var extendtimesplit=extendtime.split(':');
    	    var endtimesplit=endtime.split(':');
    	    var newextendtime;
    	    nowtimesplit[0]*= 1;
    	    nowtimesplit[1]*= 1;
    	    nowtimesplit[2]*= 1;
    	    extendtimesplit[0]*= 1;
    	    extendtimesplit[1]*= 1;
    	    extendtimesplit[2]*= 1;
    		endtimesplit[0]*=1;
    		endtimesplit[1]*=1;
    		endtimesplit[2]*=1;
			var endtime=endtimesplit[0]+4;
			var newendtime=endtime-2;
			endtime+="";
			if(nowtimesplit[0]*3600+nowtimesplit[1]*60+nowtimesplit[2]>endtimesplit[0]*3600+endtimesplit[1]*60+endtimesplit[2]){
				alert('좌석이용가능시간이 종료되었습니다.');
			}
    	    else if(nowtimesplit[0]*3600+nowtimesplit[1]*60+nowtimesplit[2] > extendtimesplit[0]*3600+extendtimesplit[1]*60+extendtimesplit[2]){
    	  
    	    	endtime=endtime+':'+endtimesplit[1]+':'+endtimesplit[2];
    	    	newextendtime=newendtime+':'+endtimesplit[1]+':'+endtimesplit[2];
    	    	$.ajax({
                url:"./extension.php?userID=" + userID + "&endtime=" + endtime + "&newextendtime="+newextendtime,
                success:function(data){
                    alert('연장이완료되었습니다.');
                    location.replace('./ReadingRoom_extension.php');
                }
            })
    	    	
    	    }
    	    else {
    	    	alert('연장가능시간이 지난뒤 연장해주세요');
    	    }
    	}
    	
    </script>
	</head>
    <body>
    				 <?php
	                  	  myReadingRoomstate($_SESSION['user_number']);
	                  ?>
    				<div class="col-md-12">
 							<div class="content-panel">
	                  	  	  <h4><i class="fa fa-angle-right"></i>열람실좌석확인</h4>
	                  	  	  <hr>
		                      <table class="table">
		                          <tbody>
		                          <tr>
		                              <td>학번</td>
		                              <td><?php echo($_SESSION['user_number'])?></td>
		                          </tr>
		                          <tr>
		                              <td>성명</td>
		                              <td><?php echo($_SESSION['user_name'])?></td>
		                          </tr>
		                           <tr>
		                              <td>열람실</td>
		                              <td><?php echo($readingroomID)?></td>
		                          </tr>
		                           <tr>
		                              <td>좌석번호</td>
		                              <td><?php echo($seatnumber)?></td>
		                          </tr>
		                          <tr>
		                              <td>시작시간</td>
		                              <td><?php echo($starttime)?></td>
		                          </tr>
		                          <tr>
		                              <td>종료시간</td>
		                              <td><?php echo($endtime)?></td>
		                          </tr>
		                          <tr>
		                              <td>연장가능시간</td>
		                              <td><?php echo($extendtime)?></td>
		                              
		                          </tr>
		                          </tbody>
		                      </table>
		                      
	                  	  </div><! --/content-panel -->
	                  	  </br>
	                  	  </br>
	                  	
	                  	  <center>
		                      <button type="button" class="btn btn-warning" onclick=extensiontime(<?php echo($_SESSION['user_number'])?>,<?php echo json_encode($extendtime);?>,<?php echo json_encode($endtime);?>)>연장하기</button>
		                  </center>
	                  	  </div>
    </body>
</html>