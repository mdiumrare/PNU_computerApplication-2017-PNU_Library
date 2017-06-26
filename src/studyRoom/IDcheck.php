<?php
require_once '../DBconnector.php';
$userNumber = $_POST[user_number];
$userName = $_POST[user_name];
$db = new DBC;
$query = "SELECT count(*) as idNum
        FROM member
        WHERE user_number = '$userNumber'
        AND user_name = '$userName'";
$db->DBQ($query);
$data = $db->result->fetch_array();
$isID = $data[idNum];

echo $isID;

?>