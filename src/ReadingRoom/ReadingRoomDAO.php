<?php
require_once '../DBconnector.php';

class ReadingRoomDAO{

    public function CheckReadingRoom($readingroomID){
        $db = new DBC;
        $sql = "SELECT * 
                FROM Reading_Room_List where Reading_Room_name='$readingroomID'";
        $db->DBQ($sql);
        return $db->result;
    }
    
    public function myReadingroom($userID){
        $db = new DBC;
        $sql = "SELECT * 
                FROM borrowed_readingroom_info where UserID='$userID'";
        $db->DBQ($sql);
        return $db->result;
    }
    
    public function extendreadingroom($userID,$endtime){
        $db = new DBC;
        $sql = "UPDATE borrowed_readingroom_info
               SET endtime='$endtime'  where UserID='$userID'";
        $db->DBQ($sql);
        return $db->result;
    }
    
}

?>