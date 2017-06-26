<?php
    $originarr = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
?>
<?php
require_once './ReadingRoomDAO.php';

function ReadingRoomstate($readingroomID){
  global $originarr;
  $DAO = new ReadingRoomDAO;
  $result = $DAO->CheckReadingRoom($readingroomID);
  $num = $result->num_rows;
    for($i = 0; $i < $num; $i++){
        $data = $result->fetch_array();
        //echo $data[Reading_Room_state];
        $originarr[$i]= $data[Reading_Room_state];
        #$DAO->getUserName($reservation[user_number_1])
    }
}



?>
<!DOCTYPE html>
<html>
	<head>
		<title>열람실좌석조회</title>
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
      
    <script  type="text/javascript">
   function showtable(ReadingroomID,arr){
    //alert(arr); 
	var table1 = document.getElementById("table1");
	var arrx=new Array(15);
	var arry=new Array(15);
 	if(ReadingroomID.indexOf('2층1열람실')>-1){
    arrx[0]=0; arry[0]=0;
    arrx[1]=0; arry[1]=1;
    arrx[2]=0; arry[2]=2;
    arrx[3]=1; arry[3]=3;
    arrx[4]=1; arry[4]=4;
    arrx[5]=2; arry[5]=0;
    arrx[6]=2; arry[6]=1;
    arrx[7]=2; arry[7]=4;
    arrx[8]=3; arry[8]=1;
    arrx[9]=3; arry[9]=2;
    arrx[10]=3; arry[10]=3;
    arrx[11]=3; arry[11]=4;
    arrx[12]=4; arry[12]=0;
    arrx[13]=4; arry[13]=1;
    arrx[14]=4; arry[14]=2;
 	}
 	else if(ReadingroomID.indexOf('3층21열람실')>-1){
 	    
	arrx[0]=0; arry[0]=1;
    arrx[1]=0; arry[1]=2;
    arrx[2]=0; arry[2]=4;
    arrx[3]=1; arry[3]=0;
    arrx[4]=1; arry[4]=3;
    arrx[5]=1; arry[5]=4;
    arrx[6]=2; arry[6]=1;
    arrx[7]=2; arry[7]=2;
    arrx[8]=3; arry[8]=0;
    arrx[9]=3; arry[9]=1;
    arrx[10]=3; arry[10]=2;
    arrx[11]=3; arry[11]=3;
    arrx[12]=4; arry[12]=1;
    arrx[13]=4; arry[13]=2;
    arrx[14]=4; arry[14]=3;
	
 	}
 	else if(ReadingroomID.indexOf('3층22열람실')>-1){
	arrx[0]=0; arry[0]=1;
    arrx[1]=0; arry[1]=2;
    arrx[2]=0; arry[2]=3;
    arrx[3]=0; arry[3]=4;
    arrx[4]=1; arry[4]=0;
    arrx[5]=1; arry[5]=1;
    arrx[6]=1; arry[6]=2;
    arrx[7]=2; arry[7]=1;
    arrx[8]=2; arry[8]=2;
    arrx[9]=3; arry[9]=0;
    arrx[10]=3; arry[10]=1;
    arrx[11]=3; arry[11]=2;
    arrx[12]=3; arry[12]=3;
    arrx[13]=4; arry[13]=3;
    arrx[14]=4; arry[14]=4;
 	}
 	else if(ReadingroomID.indexOf('4층31열람실')>-1){
	arrx[0]=0; arry[0]=2;
    arrx[1]=1; arry[1]=0;
    arrx[2]=1; arry[2]=1;
    arrx[3]=1; arry[3]=3;
    arrx[4]=1; arry[4]=4;
    arrx[5]=2; arry[5]=0;
    arrx[6]=2; arry[6]=1;
    arrx[7]=2; arry[7]=2;
    arrx[8]=3; arry[8]=0;
    arrx[9]=3; arry[9]=1;
    arrx[10]=3; arry[10]=2;
    arrx[11]=3; arry[11]=3;
    arrx[12]=4; arry[12]=2;
    arrx[13]=4; arry[13]=3;
    arrx[14]=4; arry[14]=4;
 	}
 	else if(ReadingroomID.indexOf('4층32열람실')>-1){
	arrx[0]=0; arry[0]=0;
    arrx[1]=1; arry[1]=0;
    arrx[2]=1; arry[2]=1;
    arrx[3]=1; arry[3]=2;
    arrx[4]=1; arry[4]=3;
    arrx[5]=2; arry[5]=0;
    arrx[6]=2; arry[6]=1;
    arrx[7]=2; arry[7]=2;
    arrx[8]=2; arry[8]=3;
    arrx[9]=3; arry[9]=3;
    arrx[10]=3; arry[10]=4;
    arrx[11]=4; arry[11]=1;
    arrx[12]=4; arry[12]=2;
    arrx[13]=4; arry[13]=3;
    arrx[14]=4; arry[14]=4;
 	}
 	else if(ReadingroomID.indexOf('4층대학원열람실')>-1){
 
	arrx[0]=0; arry[0]=0;
    arrx[1]=0; arry[1]=1;
    arrx[2]=0; arry[2]=2;
    arrx[3]=0; arry[3]=3;
    arrx[4]=1; arry[4]=4;
    arrx[5]=2; arry[5]=0;
    arrx[6]=2; arry[6]=1;
    arrx[7]=2; arry[7]=4;
    arrx[8]=3; arry[8]=1;
    arrx[9]=3; arry[9]=2;
    arrx[10]=3; arry[10]=3;
    arrx[11]=3; arry[11]=4;
    arrx[12]=4; arry[12]=0;
    arrx[13]=4; arry[13]=1;
    arrx[14]=4; arry[14]=2;
 	}
 	else if(ReadingroomID.indexOf('4층2노트북열람실')>-1){

    arrx[0]=0; arry[0]=2;
    arrx[1]=0; arry[1]=3;
    arrx[2]=1; arry[2]=1;
    arrx[3]=1; arry[3]=2;
    arrx[4]=1; arry[4]=3;
    arrx[5]=2; arry[5]=0;
    arrx[6]=2; arry[6]=2;
    arrx[7]=2; arry[7]=3;
    arrx[8]=2; arry[8]=4;
    arrx[9]=3; arry[9]=0;
    arrx[10]=3; arry[10]=1;
    arrx[11]=3; arry[11]=2;
    arrx[12]=4; arry[12]=2;
    arrx[13]=4; arry[13]=3;
    arrx[14]=4; arry[14]=4;
 	}
 	
 	for(var i in arrx){
 	    if(i<10){
 	    table1.rows[arrx[i]].cells[arry[i]].innerHTML =0+i;
 	    }
 	    else{
 	        table1.rows[arrx[i]].cells[arry[i]].innerHTML =i;
 	    }
 	    table1.rows[arrx[i]].cells[arry[i]].style.backgroundColor='#906D3B';
    	 	if(arr[i]==0){
     	table1.rows[arrx[i]].cells[arry[i]].style.backgroundColor='#7FFF00';
 	    }
 	}
 	
}

    </script>
      
	</head>
    <body>
        
    <?php
 	//	echo $_GET['readingroomID'];
 		$AA = $_GET['readingroomID'];
 		ReadingRoomstate($AA);
     ?>
        
        
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i>열람실 좌석 조회</h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		      				<div class="showback">
      					<h4><i class="fa fa-angle-right"></i>열람실 선택</h4>
					
						
						  <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="width:150px">
						      <?php echo($_GET['readingroomID']); ?>
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu" id="selectbutton">
						      <li><a href="ReadingRoom_state.php?readingroomID=2층1열람실">2층 1열람실</a></li>
						      <li><a href="ReadingRoom_state.php?readingroomID=3층21열람실">3층 2-1 열람실</a></li>
						      <li><a href="ReadingRoom_state.php?readingroomID=3층22열람실">3층 2-2 열람실</a></li>
						      <li><a href="ReadingRoom_state.php?readingroomID=4층31열람실">4층 3-1 열람실</a></li>
						      <li><a href="ReadingRoom_state.php?readingroomID=4층32열람실">4층 3-2 열람실</a></li>
						      <li><a href="ReadingRoom_state.php?readingroomID=4층대학원열람실">4층 대학원 열람실</a></li>
						      <li><a href="ReadingRoom_state.php?readingroomID=4층2노트북열람실">4층 2노트북 열람실</a></li>
						    </ul>
						  </div>
                         
						 <button type="button" class="btn btn-warning" onclick = showtable("<?php echo($_GET['readingroomID']);?>",<?php echo json_encode($originarr);?>);>검색</button>
						 </br>
						 </br>
						 <table>
                             <tr>
                                 <td bgcolor='#7FFF00'  width="30"></td>
                                 <td>사용가능</td>
                             </tr>
                              <tr>
                                 <td bgcolor='#906D3B' width="30"></td>
                                 <td>사용중</td>
                             </tr>
                         </table>
      				</div><!-- /showback -->
          		</div>
          	</div>
    </br>
    </br>
    <Table id = "table1"  border="10" bordercolor="white" style = "width:200px;height:200px;">
   	<tr>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	    <td style="text-align:center;"></td>
    	<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	</tr>
   	<tr>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	    <td style="text-align:center;"></td>
    	<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	</tr>
	   	<tr>
	    <td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	    <td style="text-align:center;"></td>
    	<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	</tr>
	   	<tr>
	    <td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	    <td style="text-align:center;"></td>
    	<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	</tr>
	   	<tr>
    	<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	    <td style="text-align:center;"></td>
    	<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	</tr>
	   	<tr>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	    <td style="text-align:center;"></td>
    	<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
		<td style="text-align:center;"></td>
	</tr>
    </Table>
		</section>
    </body>
</html>
