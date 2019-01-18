<?php
/*
ทำงานร่วมกับ FARMSOOK_SMART_PLUG_Json_MutiObject_V1.ino
*/
include "db_connection.php";

if (isset($_GET["ledno"]) && $_GET["ledno2"]){
	ini_set('display_errors', 1);
	error_reporting(~0);
	$curtime = $UTC;
	$loop_sec = $UTC + $LPSEC;
	$_sec = 0;
	
	$conn = OpenCon();
	$sql = "select ledno, msg, secoff from ledcfg where ledno IN ('".trim($_GET["ledno"])."', '".trim($_GET["ledno2"])."')";
	$query = mysqli_query($conn,$sql);
	if (!$query) {
		printf("Error: %s\n", $conn->error);
		exit();
	}
	$resultArray = array();
	$rows = array();
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
		$rows[] = array('ledno' => $result["ledno"], 'msg' => $result["msg"], 'secoff' => $result["secoff"]);
	}
	
	CloseCon($conn);
	$JsonData = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($rows), ENT_NOQUOTES));
	echo $JsonData;
	
	/*$dec = json_decode(json_encode($rows));
	echo "[".count($dec)."]";
	for($idx = 0; $idx < count($dec); $idx++){
		$obj = (Array)$dec[$idx];
		echo $obj["secoff"];
	}*/
	
	if (getLoopFlg("farmsook3")){  // For motor loop On-Off
		if (getLoopSts("farmsook3")){
			if (getLoopTime("farmsook3") <= $UTC){ //if time over set OFF and set time next ON
				setOnOffLoop("farmsook3", "OFF", "F", $loop_sec);
			}
		}else{
			if (getLoopTime("farmsook3") <= $UTC){ //if time over set ON and set time next OFF
				setOnOffLoop("farmsook3", "ON", "T", $loop_sec);
			}
		}
	}else{
		$Array = json_decode(json_encode($rows), true);
		foreach ($Array as $key => $value) 	
		{	
			//>>echo "<br/>";
			//>>echo "Key: $key ";
			if ($key == 1){
				foreach ($value as $k => $val)   
				{
					//>>echo "K:$k | Val: $val <br />";
					if ($k == "secoff" && $val != "0"){
						//>>echo "Val:".$val;
						$_sec = $val;
					}
				}    
			}
		 }
	}
	//[flgloop30_sts]
	if ($_sec != 0 && $_sec <= $curtime){
		$conn = OpenCon();
		$setsec = 0;
			
		$sql = "update ledcfg set msg = 'OFF', secoff = '0' where ledno = '".$_GET["ledno2"]."'";
		$conn->query($sql);
		CloseCon($conn);
	}
}
function getLoopFlg($ledNo){
	$conn = OpenCon();
	$sql = "select flgloop30, flgloop30_sts from ledcfg where ledno = '".$ledNo."'";
	//echo 'SQL='.$sql;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$flgloop30 = $row["flgloop30"];
			$flgloop30_sts = $row["flgloop30_sts"];
		}
	}
	CloseCon($conn);
	if ($flgloop30 == "T")
		return true;
	else
		return false;
}
function getLoopSts($ledNo){
	$conn = OpenCon();
	$sql = "select flgloop30, flgloop30_sts from ledcfg where ledno = '".$ledNo."'";
	//echo 'SQL='.$sql;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$flgloop30 = $row["flgloop30"];
			$flgloop30_sts = $row["flgloop30_sts"];
		}
	}
	CloseCon($conn);
	if ($flgloop30_sts == "T")
		return true;
	else
		return false;
}
function getLoopTime($ledNo){
	$conn = OpenCon();
	$sql = "select flgloops from ledcfg where ledno = '".$ledNo."'";
	//echo 'SQL='.$sql;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$flgloops = $row["flgloops"];
		}
	}
	CloseCon($conn);
	return $flgloops;
}
function setOnOffLoop($ledNo, $flg, $flgloop30_sts, $loop_sec){
	$conn = OpenCon();
	$sql = "update ledcfg set msg = '".$flg."', flgloop30_sts='".$flgloop30_sts."', flgloops = '".$loop_sec."' where ledno = '".$ledNo."'";
	$result = $conn->query($sql);
	CloseCon($conn);
}

?>