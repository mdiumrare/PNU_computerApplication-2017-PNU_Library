<?php
    $regnum = $_GET['regnum'];
    $extensionReturnDate = $_GET['extensionReturnDate'];
    require_once '../DBconnector.php';
    $db = new DBC;

    $query = "select * from borrowed_book_info WHERE regnum='$regnum'";
    $db->DBQ($query);
    
    $data = $db->result->fetch_array();
    $result = array();
    $extensionCount = $data[extensionCount]+1;
    array_push($result,$extensionCount);
    array_push($result,$extensionReturnDate);
    
    $query = "update borrowed_book_info SET extensionCount='$extensionCount', returnDate='$extensionReturnDate' WHERE regnum='$regnum'";
    $db->DBQ($query);
    
    echo json_encode($result);
?>