<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include "db_connection.php";
	//if (isset($_POST["ledno"])){
function getmsg($ledNo){		
	$conn = OpenCon();
	$sql = "select ledno, msg from ledcfg where ledno = '".$ledNo."'";
	//echo 'SQL='.$sql;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$_ledno = $row["ledno"];
			$_msg = $row["msg"];
			if (strlen($_msg) <= 0){
				$_msg = "ไม่มีข้อความ";
			}
		}
	}
	CloseCon($conn);
	return $_msg;
	}
?>
<?php
echo getmsg("farmsook1");
echo date("Hi", time())."<br/>"; 

$str = "0|08.00-17.00";
$hr1 = explode("|",$str);
echo addzero("12");
function addzero($num){
	while(strlen($num) < 2){
		$num = "0".$num;
	}
	return $num;
}


?>
</body>
</html>