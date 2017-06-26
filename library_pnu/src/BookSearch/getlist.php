<?php
    $category = $_GET['category'];
    $keyword = $_GET['keyword'];
    require_once '../DBconnector.php';
    $db = new DBC;
    if($category == 'all'){
        $query = "select * from book_info WHERE title LIKE '%$keyword%' OR author LIKE '%$keyword%' OR publisher LIKE '%$keyword%'";
    }
    else{
        $query = "select * from book_info WHERE $category LIKE '%$keyword%'";
    }
    $db->DBQ($query);
    
    $num = $db->result->num_rows;
    $data = $db->result->fetch_array();
   
    $resultArray = array();

	for($i=0;$i<$num;$i++){
        if($data[rental] == 0){
            $flag = '대출가능';
        }
        else{
            $flag = '대출중';
        }
        $arrayMiddle = array (
            "isbn" => $data[ISBN],
            "regnum" => $data[regnum],
            "title" => $data[title],
            "author" => $data[author],
            "publisher" => $data[publisher],
            "publi_year" => $data[publi_year],
            "structure" => $data[structure],
            "location" => $data[location],
            "rental" => $flag
        );
        $data = $db->result->fetch_array();
        array_push( $resultArray, $arrayMiddle );
    }
    echo json_encode($resultArray);
?>