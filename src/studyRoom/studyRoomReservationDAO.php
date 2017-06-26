<?php
require_once '../DBconnector.php';

class studyRoomReservationDAO{
    public function getReservation($userNumber,$whichTime){
        $db = new DBC;
        if($whichTime == "past"){
            $sql = "SELECT * 
                    FROM Study_Room_Reservation 
                    INNER JOIN Study_Room_List
                    ON Study_Room_List.studyroom_ID = Study_Room_Reservation.studyroom_ID
                    WHERE (user_number_1 = '$userNumber' OR
                    user_number_2 = '$userNumber' OR
                    user_number_3 = '$userNumber' OR
                    user_number_4 = '$userNumber' OR
                    user_number_5 = '$userNumber') AND
                    start_time < NOW()";
        }else{
            $sql = "SELECT * 
                    FROM Study_Room_Reservation 
                    INNER JOIN Study_Room_List
                    ON Study_Room_List.studyroom_ID = Study_Room_Reservation.studyroom_ID
                    WHERE (user_number_1 = '$userNumber' OR
                    user_number_2 = '$userNumber' OR
                    user_number_3 = '$userNumber' OR
                    user_number_4 = '$userNumber' OR
                    user_number_5 = '$userNumber') AND
                    start_time > NOW()";    
        }
        
        $db->DBQ($sql);
        $num = $db->result->num_rows;
        for($i = 0; $i < $num; $i++){
            $data = $db->result->fetch_array();
            $reservationList[$i] = $data;
        }
        return $reservationList;
    }
    
    public function getUserName($user_Number){
        $db = new DBC;
        $sql = "SELECT * 
                FROM member
                WHERE user_number = '$user_Number'";
        $db->DBQ($sql);
        $data = $db->result->fetch_array();
        return $data[user_name];
    }
    
    public function getStudyRoomInformation(){
        $db = new DBC;
        $sql = "SELECT * 
                FROM Study_Room_List";
        $db->DBQ($sql);
        return $db->result;
    }
    
    public function getStudyRoomReservationInformation($datetime,$study_room_number){
        $db = new DBC;
        $sql = "SELECT COUNT(*) AS isReserve
                FROM Study_Room_Reservation
                WHERE start_time <= '$datetime'
                AND end_time > '$datetime'
                AND studyroom_ID = '$study_room_number'";
        $db->DBQ($sql);
        $data = $db->result->fetch_array();
        $isReserve = $data[isReserve];
        return $isReserve;
    }
}

?>