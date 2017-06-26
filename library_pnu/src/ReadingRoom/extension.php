<?php
    $userID = $_GET['userID'];
    $endtime = $_GET['endtime'];
    $newextendtime= $_GET['newextendtime'];
    require_once '../DBconnector.php';
     $db = new DBC;

    $query = "update borrowed_readingroom_info SET endtime='$endtime',extendtime='$newextendtime' WHERE UserID='$userID'";
    $db->DBQ($query);
    
     return $db->result;
?>