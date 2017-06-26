<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>스터디룸 예약 조회</title>
        <style>
        @import url(//fonts.googleapis.com/earlyaccess/jejugothic.css);
        body { font-family: 'Jeju Gothic'; }
        .card {
            box-shadow: 0 4px 8px 0 rgba(74,22,31,0.2);
            transition: 0.3s;
            width: 100%;
            border-radius: 5px;
        }
        
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(74,22,31,0.2);
        }
        
        img {
            border-radius: 5px 5px 0 0;
        }
        
        .container {
            padding: 2px 16px;
        }
        </style>
    </head>
    <?php
require_once './studyRoomReservationDAO.php';
session_start();
$user_number = $_SESSION['user_number'];
$whichTime = $_GET["reserveTime"];

if(!isset($_SESSION['user_number']) || !isset($_SESSION['user_name'])) {
    echo "<script>alert('로그인 후 이용가능합니다.');</script>";
	#echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
	exit;

}

function printReservationList($reservationList){
    for($i = 0; $i < sizeof($reservationList); $i++){
        $DAO = new studyRoomReservationDAO;
        $index = $i + 1;    
        $reservation = $reservationList[$i];
        $user_name_1 = $DAO->getUserName($reservation[user_number_1]);
        $user_name_2 = $DAO->getUserName($reservation[user_number_2]);
        $user_name_3 = $DAO->getUserName($reservation[user_number_3]);
        $user_name_4 = $DAO->getUserName($reservation[user_number_4]);
        $user_name_5 = $DAO->getUserName($reservation[user_number_5]);
        echo "<div class='card'>";
        echo "<div class='container'>";
        echo "<h5>예약번호 : $reservation[reserve_number]</h5>";
        echo "<p>위치 : $reservation[studyroom_Name]</p>";
        echo "<p>시작 시간 : $reservation[start_time]</p>";
        echo "<p>종료 시간 : $reservation[end_time]</p>";
        echo "<p>예약자 1 : $user_name_1($reservation[user_number_1])</p>";
        echo "<p>예약자 2 : $user_name_2($reservation[user_number_2])</p>";
        echo "<p>예약자 3 : $user_name_3($reservation[user_number_3])</p>";
        echo "<p>예약자 4 : $user_name_4($reservation[user_number_4])</p>";
        echo "<p>예약자 5 : $user_name_5($reservation[user_number_5])</p>";
        echo "</div></div>";
    }
}

?>
    <body>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
            <div>
                <select name="reserveTime">
                    <option value="future">예약 중</option>
                    <option value="past">예약만료</option>
                </select>
                <input type="submit" value="시간변경" />
            </div>
        </form>
        <?php
        $DAO = new studyRoomReservationDAO;
        $reservationList = $DAO->getReservation($user_number,$whichTime);
        printReservationList($reservationList);
        ?>
        <!--
        <div class="card">
            <div class="container">
                <h5>제목</h5>
                <p>ㄴ용</p>
                <p>ㄴㅍㅇ</p>
            </div>
        </div>
        -->
    </body>
</html>