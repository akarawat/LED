<?php
$title = "Smart Connect Solutions, scsthai, internet of things, IOT, ป้าย LED Online อัพเดทข้อความผ่านมือถือได้เองตลอดเวลา";
$LPSEC = 60;
$UTC = time() + 25200;
function OpenCon()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "1234567889";
	$db = "leddb";
	
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	$conn->set_charset('utf8');
	$conn->query("SET collation_connection = utf8_general_ci");
	
	return $conn;
}
 
function CloseCon($conn)
{
	$conn -> close();
}
?>