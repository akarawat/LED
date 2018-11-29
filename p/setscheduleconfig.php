<?php
include "../db_connection.php";
	if (isset($_GET["plgno"]) && isset($_GET["chanel"]) && isset($_GET["sttm"]) && isset($_GET["entm"])){
		$conn = OpenCon();
		$_bt = "";
		if ($_GET["chanel"] == "b1") $_bt = "bit1";
		else if ($_GET["chanel"] == "b2") $_bt = "bit2";
		else if ($_GET["chanel"] == "b3") $_bt = "bit3";
		else if ($_GET["chanel"] == "b4") $_bt = "bit4";
		else if ($_GET["chanel"] == "b5") $_bt = "bit5";
		
		$sql = "update smpcfg set $_bt = '0|".$_GET["sttm"]."-".$_GET["entm"]."' WHERE plgno = '".$_GET["plgno"]."';";
		//echo $sql; //exit();
		if ($conn->query($sql) === TRUE) {
			$res_upd = "แก้ไขข้อความเสร็จสมบูรณ์";
		} else {
			$res_upd = "แก้ไขข้อความ ผิดพลาด";
		}
		CloseCon($conn);
		//echo $res_upd;
		header("Location:index.php?plgno=".$_GET["plgno"]."");
	}
	
?>
