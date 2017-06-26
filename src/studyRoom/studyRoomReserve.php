<?php
require_once './studyRoomReservationDAO.php';
session_start();
$user_number = $_SESSION['user_number'];
$user_name = $_SESSION['user_name'];
$study_room_number = $_GET['studyRoomNumber'];
$study_room_name = $_GET['studyRoomName'];

if(!isset($_SESSION['user_number']) || !isset($_SESSION['user_name'])) {
    echo "<script>alert('로그인 후 이용가능합니다.');</script>";
	#echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
	exit;

}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript">
            function selectReservationTime(dateTime){
                    $("#reserveStartTime").val(dateTime);
                    var str = dateTime;
                    var res = str.split(" ");
                    if(res[1] == "17:00"){
                        $("#reserveHour").attr("max","1");
                    }else{
                        $("#reserveHour").attr("max","2");
                    }
            }
            function checkID_1(){
                var userNumber = $('#user_number_1');
                var userName = $('#user_name_1');
                var IDchecker = $("#IDchecker_1");
                var user_1_checkbox = $('#user_1_checkbox');
                if((userNumber.val() == $('#user_number_2').val()) ||
                (userNumber.val() == $('#user_number_3').val()) ||
                (userNumber.val() == $('#user_number_4').val()) ||
                (userNumber.val() == $('#user_number_5').val())){
                    alert("중복된 회원번호입니다");
                    exit();
                }
                
                checker(userNumber,userName,IDchecker,user_1_checkbox);
                
            }
            function checkID_2(){
                var userNumber = $('#user_number_2');
                var userName = $('#user_name_2');
                var IDchecker = $("#IDchecker_2");
                var user_2_checkbox = $('#user_2_checkbox');
                if((userNumber.val() == $('#user_number_1').val()) ||
                (userNumber.val() == $('#user_number_3').val()) ||
                (userNumber.val() == $('#user_number_4').val()) ||
                (userNumber.val() == $('#user_number_5').val())){
                    alert("중복된 회원번호입니다");
                    exit();
                }
                checker(userNumber,userName,IDchecker,user_2_checkbox);
            }
            function checkID_3(){
                var userNumber = $('#user_number_3');
                var userName = $('#user_name_3');
                var IDchecker = $("#IDchecker_3");
                var user_3_checkbox = $('#user_3_checkbox');
                if((userNumber.val() == $('#user_number_2').val()) ||
                (userNumber.val() == $('#user_number_1').val()) ||
                (userNumber.val() == $('#user_number_4').val()) ||
                (userNumber.val() == $('#user_number_5').val())){
                    alert("중복된 회원번호입니다");
                    exit();
                }
                checker(userNumber,userName,IDchecker,user_3_checkbox);
            }
            function checkID_4(){
                var userNumber = $('#user_number_4');
                var userName = $('#user_name_4');
                var IDchecker = $("#IDchecker_4");
                var user_4_checkbox = $('#user_4_checkbox');
                if((userNumber.val() == $('#user_number_2').val()) ||
                (userNumber.val() == $('#user_number_3').val()) ||
                (userNumber.val() == $('#user_number_1').val()) ||
                (userNumber.val() == $('#user_number_5').val())){
                    alert("중복된 회원번호입니다");
                    exit();
                }
                checker(userNumber,userName,IDchecker,user_4_checkbox);
            }
            function checkID_5(){
                var userNumber = $('#user_number_5');
                var userName = $('#user_name_5');
                var IDchecker = $("#IDchecker_5");
                var user_5_checkbox = $('#user_5_checkbox');
                if((userNumber.val() == $('#user_number_2').val()) ||
                (userNumber.val() == $('#user_number_3').val()) ||
                (userNumber.val() == $('#user_number_4').val()) ||
                (userNumber.val() == $('#user_number_1').val())){
                    alert("중복된 회원번호입니다");
                    exit();
                }
                checker(userNumber,userName,IDchecker,user_5_checkbox);
            }
            function checker(userNumber,userName,IDchecker,user_checkbox){
                if(userNumber.val() == ""){
                    alert("회원번호를 입력하세요");
                }else if(userName.val() == ""){
                    alert("이름을 입력하세요");
                }else{
                    $.ajax({
                        url:'IDcheck.php',
                        type:'POST',
                        data: {'user_number':userNumber.val(),
                                'user_name':userName.val()},
                        dataType:'html',
                        success:function(data){
                            if(data == '1'){
                                IDchecker.text("사용가능");
                                userNumber.prop("readonly",true);
                                userName.prop("readonly",true);
                                user_checkbox.prop("checked",true);
                                user_checkbox.prop("disabled",true);
                                if(($("#user_1_checkbox").is(":checked") == true) && 
                                    ($("#user_2_checkbox").is(":checked") == true) &&
                                    ($("#user_3_checkbox").is(":checked") == true) &&
                                    ($("#user_4_checkbox").is(":checked") == true) &&
                                    ($("#user_5_checkbox").is(":checked") == true)){
                                        $("#submitReserve").attr("type","submit");
                                    }
                            }else{
                                IDchecker.text("사용불가");
                            }
                        }
                    });
                }
            }
            
        </script>
        <title>그룹 스터디 룸 예약하기</title>
    </head>
    <body>
        <h2><?= $study_room_name?></h2>
        <p>예약 가능 시간 09:00 ~ 18:00</p>
        <hr>
        <div>
            <p>예약 현황</p>
            <table border="1">
                <tr>
                    <td></td>
                    <td><?=date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y"))); ?></td>
                    <td><?=date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y"))); ?></td>
                    <td><?=date("Y-m-d",mktime(0,0,0,date("m"),date("d")+2,date("Y"))); ?></td>
                    <td><?=date("Y-m-d",mktime(0,0,0,date("m"),date("d")+3,date("Y"))); ?></td>
                </tr>
                <?php
                $DAO = new studyRoomReservationDAO;
                for($startHour = 9; $startHour < 18; $startHour++){
                    echo "<tr>";
                    $endHour = $startHour + 1;
                    echo "<td>$startHour:00 ~ $endHour:00</td>";
                    for($startDay = 0; $startDay < 4; $startDay++){
                        $dateTime = date("Y-m-d H:00",mktime($startHour,0,0,date("m"),date("d")+$startDay,date("Y")));
                        $nowDateTime = date("Y-m-d H:i",mktime(date("H")+9,date("i"),0,date("m"),date("d"),date("Y")));
                        $isReserve = $DAO->getStudyRoomReservationInformation($dateTime,$study_room_number);
                        if($nowDateTime > $dateTime){
                            echo "<td align='center' bgcolor='#ff8080'>X</td>";
                        }else{
                            if($isReserve == '1'){
                                echo "<td align='center' bgcolor='#ff8080'>";
                                echo "X";
                                echo "</td>";
                            }else{
                                echo "<td align='center' bgcolor='#99b3ff'>";
                                echo "<span onclick=\"selectReservationTime('$dateTime')\"><a href='#'>O</a></span>";
                                echo "</td>";
                            }
                        }
                        
                        
                        
                    }
                    echo "</tr>";
                }
                ?>
            </table>
            <hr>
        </div>
        <form action="./reserveStudyRoom.php" method=post>
            <div>
                <p>이용 시간 선택</p>
                <p> 일시 <input id="reserveStartTime" type="text" name="reserveStartTime" placeholder="시간을 선택하세요" readonly />
                <input id="reserveHour" type="number" min="1" max="2" value=1 name="reserveHour" required/>시간</p>
            </div>
            <hr>
            참석자 등록 하기
            <div>
                <input type="text" id="user_number_1" name="user_number_1" value=<?=$user_number?> placeholder="회원번호를 입력하세요" readonly required/>
                <input type="text" id="user_name_1" name="user_name_1" value=<?=$user_name?> placeholder="이름을 입력하세요" readonly required/>
                <input type="button" value="회원 확인" onClick="checkID_1()"/>
                <span id="IDchecker_1"></span>
                <input type="checkbox" id="user_1_checkbox" name="user_1_check" value="user_1_check" style="display:none"/>
            </div>
            <div>
                <input type="text" id="user_number_2" name="user_number_2" placeholder="회원번호를 입력하세요" value="111111111"/>
                <input type="text" id="user_name_2" name="user_name_2" placeholder="이름을 입력하세요" value="나나나"/>
                <input type="button" value="회원 확인" onClick="checkID_2()"/>
                <span id="IDchecker_2"></span>
                <input type="checkbox" id="user_2_checkbox" name="user_2_check" value="user_2_check" style="display:none"/>
            </div>
            <div>
                <input type="text" id="user_number_3" name="user_number_3" placeholder="회원번호를 입력하세요" value="121212121"/>
                <input type="text" id="user_name_3" name="user_name_3" placeholder="이름을 입력하세요" value="일이일"/>
                <input type="button" value="회원 확인" onClick="checkID_3()"/>
                <span id="IDchecker_3"></span>
                <input type="checkbox" id="user_3_checkbox" name="user_3_check" value="user_3_check" style="display:none"/>
            </div>
            <div>
                <input type="text" id="user_number_4" name="user_number_4" placeholder="회원번호를 입력하세요" value="123412345"/>
                <input type="text" id="user_name_4" name="user_name_4" placeholder="이름을 입력하세요" value="차차차"/>
                <input type="button" value="회원 확인" onClick="checkID_4()"/>
                <span id="IDchecker_4"></span>
                <input type="checkbox" id="user_4_checkbox" name="user_4_check" value="user_4_check" style="display:none"/>
            </div>
            <div>
                <input type="text" id="user_number_5" name="user_number_5" placeholder="회원번호를 입력하세요" value="201220126"/>
                <input type="text" id="user_name_5" name="user_name_5" placeholder="이름을 입력하세요" value="석기열"/>
                <input type="button" value="회원 확인" onClick="checkID_5()"/>
                <span id="IDchecker_5"></span>
                <input type="checkbox" id="user_5_checkbox" name="user_5_check" value="user_5_check" style="display:none"/>
            </div>
            <hr>
            <input type="hidden" name="study_room_name" value="<?=$study_room_name?>"/>
            <input type="hidden" name="study_room_number" value="<?=$study_room_number?>"/>
            <input type="hidden" id="submitReserve" value="스터디룸 예약하기" />
        </form>
    </body>
</html>