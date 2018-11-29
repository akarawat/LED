<?php
include "db_connection.php";
if (isset($_GET["ledno"])){
	ini_set('display_errors', 1);
	error_reporting(~0);
	$curtime = time() + 25200;
	$_sec = 0;
	
	$conn = OpenCon();
	$sql = "select ledno, msg, secoff from ledcfg where ledno = '".trim($_GET["ledno"])."'";
	
	$query = mysqli_query($conn,$sql);
	if (!$query) {
		printf("Error: %s\n", $conn->error);
		exit();
	}
	$resultArray = array();
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
		$arr = array('ledno' => $result["ledno"], 'msg' => $result["msg"], 'secoff' => $result["secoff"]);
		$_sec = $result["secoff"];
	}
	
	CloseCon($conn);
	echo json_encode($arr);
	
	if ($_sec != 0 && $_sec <= $curtime){
		$conn = OpenCon();
		$setsec = 0;
			
		$sql = "update ledcfg set msg = 'OFF', secoff = '0' where ledno = '".$_GET["ledno"]."'";
		$conn->query($sql);
		CloseCon($conn);
	}
}
?>