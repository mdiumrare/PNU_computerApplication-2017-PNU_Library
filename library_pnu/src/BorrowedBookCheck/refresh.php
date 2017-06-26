<?php
    $regnum = $_GET['regnum'];
    $extensionDate = $_GET['extensionDate'];
    require_once '../DBconnector.php';
    $db = new DBC;
    
    $query = "update borrowed_book_info SET extensionCount='$extensionCount', extensionDate='$extensionDate' WHERE regnum='$regnum'";
    $db->DBQ($query);
    
?>