<?php
#http://blog.kurien.co.kr/372

class DBC
{
	public $db;
	public $result;
	
	public function __construct(){
		$hostname = 'localhost';
		$user = 'skaghzz';
		$password = '';
		$database = 'PNU_Library';
	    $this->db = new mysqli($hostname, $user, $password, $database, 3306); //host, id, pw, database 순서입니다.
		$this->db->query('SET NAMES UTF8');
		if(mysqli_connect_errno())
		{
			header("Content-Type: text/html; charset=UTF-8");
			echo "데이터 베이스 연동에 실패했습니다.";
			exit;
		}
	}
	
	public function __destruct()
	{
		$this->result->free;
		$this->db->close();
	}

	public function DBQ($query)
	{
		$this->result = $this->db->query($query);
	}
}
?>