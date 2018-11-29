<?php
include "../db_connection.php";
$_plgno = "";
$_bitp1 = "";
$_bitp2 = "";
$_bitp3 = "";
$_bitp4 = "";
$_bitp5 = "";

$swplgno = "";
$swplgno = trim($_GET["plgno"]);
function addzero($num){
	while(strlen($num) < 2){
		$num = "0".$num;
	}
	return $num;
}
function SetBitOn($plgno, $bitNo, $sts){
	$conn = OpenCon();
	$sql = "update smpcfg set $bitNo = '".$sts."' WHERE plgno = '".$plgno."'";	
	//echo $sql; exit();
	$conn->query($sql);
	CloseCon($conn);
}
/*
function SetBitOff($plgno, $bitNo){
	$conn = OpenCon();
	$sql = "update smpcfg set $bitNo = '0|00.00-00.00' WHERE plgno = '".$plgno."'";	
	$conn->query($sql);
	CloseCon($conn);
}
*/
if (isset($_GET["plgno"])){
	ini_set('display_errors', 1);
	error_reporting(~0);
	
	$conn = OpenCon();
	$sql = "SELECT plgno, bit1, bit2, bit3, bit4, bit5 FROM `smpcfg` WHERE plgno = '".$swplgno."'";
	
	$query = mysqli_query($conn,$sql);
	if (!$query) {
		printf("Error: %s\n", $conn->error);
		exit();
	}
	$result = $conn->query($sql);
		//echo $sql;
	if ($result->num_rows > 0) {
	// output data of each row
		while($row = $result->fetch_assoc()) {
			$_plgno = $row["plgno"];
			$_bitp1 = $row["bit1"];
			$_bitp2 = $row["bit2"];
			$_bitp3 = $row["bit3"];
			$_bitp4 = $row["bit4"];
			$_bitp5 = $row["bit5"];
			/////echo "id: ".$_plgno."<br>";
		}
	}
		
	$resultArray = array();
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
		array_push($resultArray,$result);
	}
	
	CloseCon($conn);

	echo json_encode($resultArray);
	
	if ($_bitp1 != ""){
		//echo $_bitp1;
		$arrp1 = explode("|",$_bitp1);
		if ($arrp1[1] != "00.00-00.00"){
			$defaultm = "";
			$_dhhst = substr($arrp1[1],0,2);
			$_dmmst = substr($arrp1[1],3,2);
			$_dhhen = substr($arrp1[1],6,2);
			$_dmmen = substr($arrp1[1],9,2);
						
			$_hhstp1 = $_dhhst; //H On
			$_mmstp1 = $_dmmst; //M On
			$_hhenp1 = $_dhhen; //H Off
			$_mmenp1 = $_dmmen; //M Off
			$stTmep1 = ($_hhstp1.$_mmstp1) * 1; //Decimal On
			$enTmep1 = ($_hhenp1.$_mmenp1) * 1; //Decimal Off
			$defaultm = addzero($_dhhst).".".addzero($_dmmst)."-".addzero($_dhhen).".".addzero($_dmmen);
			/*
			<150>&<850
			>1850>&<250
			>2350>&<700
			*/
			$dcurtime = 0;
			$dcurtime = date("Hi", time());
			
			if ($stTmep1 < $enTmep1){
				if (($dcurtime >= $stTmep1 && $dcurtime <= $enTmep1)){
					//echo " >> 1 Set ON".$defaultm;
					SetBitOn($swplgno, "bit1", "1|".$defaultm);
				}else{
					//echo " >> Set Off".$defaultm;
					SetBitOn($swplgno, "bit1", "0|".$defaultm);
				}				
			}else if ($stTmep1 > $enTmep1){
				if (($dcurtime >= $stTmep1 && $dcurtime >= $enTmep1)){
					//echo " >> 2 Set ON".$defaultm;
					SetBitOn($swplgno, "bit1", "1|".$defaultm);
				}else{
					//echo " >> Set Off".$defaultm;
					SetBitOn($swplgno, "bit1", "0|".$defaultm);
				}
			}else{
				//echo " >> Set Off".$defaultm;
				SetBitOn($swplgno, "bit1", "0|".$defaultm);
			}
		}
	}
	
	//### SW P2
	if ($_bitp2 != ""){
		//echo $_bitp2;
		$arrp2 = explode("|",$_bitp2);
		if ($arrp2[1] != "00.00-00.00"){
			$defaultm = "";
			$_dhhst = substr($arrp2[1],0,2);
			$_dmmst = substr($arrp2[1],3,2);
			$_dhhen = substr($arrp2[1],6,2);
			$_dmmen = substr($arrp2[1],9,2);
						
			$_hhstp2 = $_dhhst; //H On
			$_mmstp2 = $_dmmst; //M On
			$_hhenp2 = $_dhhen; //H Off
			$_mmenp2 = $_dmmen; //M Off
			$stTmep2 = ($_hhstp2.$_mmstp2) * 1; //Decimal On
			$enTmep2 = ($_hhenp2.$_mmenp2) * 1; //Decimal Off
			$defaultm = addzero($_dhhst).".".addzero($_dmmst)."-".addzero($_dhhen).".".addzero($_dmmen);
			/*
			<150>&<850
			>1850>&<250
			>2350>&<700
			*/
			$dcurtime = 0;
			$dcurtime = date("Hi", time());
			
			if ($stTmep2 < $enTmep2){
				if (($dcurtime >= $stTmep2 && $dcurtime <= $enTmep2)){
					//echo " >> 1 Set ON".$defaultm;
					SetBitOn($swplgno, "bit2", "1|".$defaultm);
				}else{
					//echo " >> Set Off".$defaultm;
					SetBitOn($swplgno, "bit2", "0|".$defaultm);
				}				
			}else if ($stTmep2 > $enTmep2){
				if (($dcurtime >= $stTmep2 && $dcurtime >= $enTmep2)){
					//echo " >> 2 Set ON".$defaultm;
					SetBitOn($swplgno, "bit2", "1|".$defaultm);
				}else{
					//echo " >> Set Off".$defaultm;
					SetBitOn($swplgno, "bit2", "0|".$defaultm);
				}
			}else{
				//echo " >> Set Off".$defaultm;
				SetBitOn($swplgno, "bit2", "0|".$defaultm);
			}
		}
	}
	
}
?>