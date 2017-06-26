<?php
require_once '../DBconnector.php';

$study_room_number = $_POST["study_room_number"];
$reserveStartTime = $_POST["reserveStartTime"];
$study_room_name = $_POST["study_room_name"];
$reserveStartHour = $_POST["reserveStartTime"];
$reserveHour = $_POST["reserveHour"];
$date = new DateTime($reserveStartTime);
if($reserveHour == "1"){
    $date->modify('+1 hour');
}else if($reserveHour == "2"){
    $date->modify('+2 hour');
}

$reserveEndHour = $date->format('Y-m-d H:i');

$user_number_1 = $_POST["user_number_1"];
$user_number_2 = $_POST["user_number_2"];
$user_number_3 = $_POST["user_number_3"];
$user_number_4 = $_POST["user_number_4"];
$user_number_5 = $_POST["user_number_5"];
$user_name_1 = $_POST["user_name_1"];
$user_name_2 = $_POST["user_name_2"];
$user_name_3 = $_POST["user_name_3"];
$user_name_4 = $_POST["user_name_4"];
$user_name_5 = $_POST["user_name_5"];

$db = new DBC;
$sql = "INSERT INTO Study_Room_Reservation 
(studyroom_ID,start_time,end_time,user_number_1,user_number_2,user_number_3,user_number_4,user_number_5)
VALUES 
('$study_room_number','$reserveStartTime','$reserveEndHour','$user_number_1','$user_number_2','$user_number_3','$user_number_4','$user_number_5')";
$db->DBQ($sql);

?>

<html>
    <head>
        <title>예약 결과</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div>
        <?php
        if(($db->result) == TRUE){
            echo "<p>예약 성공</p>";
            echo "<p>위치 : $study_room_name</p>";
            echo "<p>이름 : $user_name_1, $user_name_2, $user_name_3, $user_name_4, $user_name_5</p>";
            echo "<p>예약시간 : $reserveStartHour ~ $reserveEndHour</p>";
            echo "<a href='./studyRoomReservationCheck.php'>확인</a>";
        }else{
            echo "<script>예약에 실패하였습니다. 다시 예약해주세요.</script>";
            echo "<script>location.replace('/');</script>";
        }
        ?>
        </div>
    </body>
</html>