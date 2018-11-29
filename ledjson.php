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
		array_push($resultArray,$result);
		$_sec = $result["secoff"];
	}
	//echo $_sec;
	CloseCon($conn);

	echo json_encode($resultArray);
		
	// Check if timer ticker Set Off Autometic.
	if ($_sec != 0 && $_sec <= $curtime){
		$conn = OpenCon();
		$setsec = 0;
			
		$sql = "update ledcfg set msg = 'OFF', secoff = '0' where ledno = '".$_GET["ledno"]."'";
		$conn->query($sql);
		CloseCon($conn);
	}
}
?>