<?php
require_once './studyRoomReservationDAO.php';
session_start();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>그룹 스터디 룸 예약하기</title>
    </head>
    <body>
        <?php
        $user_number = $_SESSION['user_number'];
        $user_name = $_SESSION['user_name'];
        ?>
        <div>스터디 룸 목록</div>
        <?php
            $DAO = new studyRoomReservationDAO;
            $result = $DAO->getStudyRoomInformation();
            $num = $result->num_rows;
            for($i = 0; $i < $num; $i++){
                $data = $result->fetch_array();
                
        ?>
            <div>
                <?=$data[studyroom_Name]?>
                <button type="button" onclick="location='./studyRoomReserve.php?studyRoomNumber=<?=$data[studyroom_ID]?>&studyRoomName=<?=$data[studyroom_Name]?>'">예약하기</button>
            </div>
        <?php
            }
        ?>
    </body>
</html>