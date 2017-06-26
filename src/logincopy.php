<?php
header("Content-Type:text/html;charset=utf-8");
require_once './DBconnector.php';
session_start();

$db = new DBC;

$user_number = $_POST["user_number"];
$user_password = $_POST["user_password"];

$query  = "select * from member where user_number='$user_number'";
$db->DBQ($query);

$num = $db->result->num_rows;
$data = $db->result->fetch_array();

if($data[user_number]!= $user_number){
    echo "
    <script>
    window.alert('없는 아이딥니더');
    history.back(1);
    </script>
    ";
    exit;
}

if($data[password]!= $user_password){
    echo "
    <script>
    window.alert('비밀번호를 잘못썼십더');
    history.back(1);
    </script>
    ";
    exit;
}
if($num==1){
	$_SESSION['user_name'] = $data[user_name];
	$_SESSION['user_number'] = $data[user_number];
	echo "<script>location.replace('/');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>로그인</title>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<form action="<?=$_SERVER['PHP_SELF']?>" method=post>
	  	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
			<div class="login-form">
				<div class="sign-in-htm">
					<div class="group">
						<label for="user" class="label">회원번호</label>
						<input id="user" type="text" class="input" name="user_number" value="201220123">
					</div>
					<div class="group">
						<label for="pass" class="label">비밀번호</label>
						<input id="pass" type="password" class="input" data-type="password" name="user_password" value="1234">
					</div>
					<div class="group">
					    <!--
						<input id="check" type="checkbox" class="check" checked>
						<label for="check"><span class="icon"></span> Keep me Signed in</label>
						-->
					</div>
					<div class="group">
						<input type="submit" class="button" value="Sign In">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<a href="#forgot">Forgot Password?</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
  
  
</body>
</html>
