<?php
/*
	- Work with Arduino file ทำงานร่วมกับ : ESPRecvAPISendToLoRA_
	- Work with Arduino file > Lora_OLED_ESP32_Wifi_T3.1 for LoRA OLED
	- Recieve and update status 3 Switch
	- Add date time to column
*/
include "db_connection.php";
$curtime = $UTC;
if (isset($_GET["ledno"]) && $_GET["ledno2"] && $_GET["ledno3"]){
	ini_set('display_errors', 1);
	error_reporting(~0);
	$curtime = $UTC;
	$_sec = 0;
	
	$conn = OpenCon();
	$sql = "select ledno, msg, secoff, NOW() as ddt from ledcfg where ledno IN ('".trim($_GET["ledno"])."', '".trim($_GET["ledno2"])."', '".trim($_GET["ledno3"])."')";
	$query = mysqli_query($conn,$sql);
	if (!$query) {
		printf("Error: %s\n", $conn->error);
		exit();
	}
	$resultArray = array();
	$rows = array();
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
		//$rows[] = array('ledno' => $result["ledno"], 'msg' => $result["msg"], 'secoff' => $result["secoff"]);
		$rows[] = array('ledno' => $result["ledno"], 'msg' => $result["msg"], 'secoff' => $result["secoff"], 'ddt' => date("d-m-y H:i:s", ($result["ddt"] + $curtime)));
		$_sec = $result["secoff"];
		if ($_sec != 0 && $_sec <= $curtime){
			setFoodsOff($result["ledno"]);
		}
	}
	
	CloseCon($conn);
	$JsonData = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($rows), ENT_NOQUOTES));
	echo $JsonData;
	
}
function setFoodsOff($ledNo){
	$conn = OpenCon();
	$setsec = 0;		
	$sql = "update ledcfg set msg = 'OFF', secoff = '0' where ledno = '".$ledNo."'";
	$conn->query($sql);
	CloseCon($conn);
}

//////////////////////////////////

?>