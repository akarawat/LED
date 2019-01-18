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
function getTimeOut($ledNo){		
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
function getSecOff($ledNo){		
	$conn = OpenCon();
	$sql = "select secoff from ledcfg where ledno = '".$ledNo."'";
	//echo 'SQL='.$sql;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$flgloops = $row["secoff"];
		}
	}
	CloseCon($conn);
	return $flgloops;
	}	
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  	<title>ฟาร์มปลา ฟาร์มศุข <?=$title?></title>
    <meta http-equiv="refresh" content="5">
    <link rel="SHORTCUT ICON" href="http://led.scsthai.com/images/SCS_icon.ico" />
    <link rel="icon" href="http://led.scsthai.com/images/SCS_icon.ico" type="image/ico" />
  	<link rel="stylesheet" href="style.css">

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  <script src="js/slides.min.jquery.js"></script>
	
	<!--[if IE]>
	<script type="text/javascript">
	(function(){
	var html5elmeents = "address|article|aside|audio|canvas|command|datalist|details|dialog|figure|figcaption|footer|header|hgroup|keygen|mark|meter|menu|nav|progress|ruby|section|time|video".split('|');
	for(var i = 0; i < html5elmeents.length; i++){
	document.createElement(html5elmeents[i]);
	}
	}
	)();
	</script>
	<![endif]-->
    <style>
		<!--
			body{ 
				font-size:24px;
				color:#666;
			}	
			.btn {
				font-size:16px;
				background-color:#0C3;
				color:#FFF;
				border-radius: 5px;
				border: 1px solid #336c2b;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				height:50px;
			}
			.btn3sec {
				font-size:16px;
				background-color:#FC0;
				color:#C00;
				border-radius: 5px;
				border: 1px solid #336c2b;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				height:50px;
			}
			.btnC {
				font-size:16px;
				background-color:#0C3;
				color:#C00;
				border-radius: 5px;
				border: 1px solid #336c2b;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				height:50px;
			}
			.btnClose {
				font-size:16px;
				background-color:#F00;
				color:#C00;
				border-radius: 5px;
				border: 1px solid #336c2b;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				height:50px;
			}
		-->
	</style>
</head>
<body>
	<table border="0" cellpadding="3" cellspacing="5">
        <tr>
            <td><a href="index.php" title="LED Matrix By scsthai.com"><img src="images/LED_Logo_214.png"></a></td>
        </tr>
    </table>
    <form name="setled" method="post" action="farmsook_lamp_succ.php" enctype="multipart/form-data">
    	<input type="hidden" name="ledno" maxlength="20" />
        <input type="hidden" name="msg" maxlength="100" />
        <input type="hidden" name="sec" />
        <input type="hidden" name="loopsts" />
        <input type="submit" name="search" value=" บันทึก " class="" style="display:none" />
        <table border="1" cellpadding="3" cellspacing="5">
            <tr bgcolor="#C1F99D">
            	<td>&nbsp;</td>
                <td valign="middle"></td>
                <td>
                    
                </td>
                <td>
                </td>
            </tr>
            <tr bgcolor="#C1F99D">
            	<td>&nbsp;</td>
                <td valign="middle"></td>
                <td>
                    <div align="left"> HOME LAMP</div>
                </td>
                <td>
                </td>
            </tr>
            <tr bgcolor="#C1F99D">
            	<td>&nbsp;</td>
                <td valign="middle"> ไฟหน้าบ้าน </td>
                <td>
                    [<?=getmsg("homeplug1")?>]
                </td>
                <td>
                <div align="left">&nbsp;
                    <input type="button" name="btnOn1" value="&nbsp;&nbsp;&nbsp; เปิด &nbsp;&nbsp;&nbsp;" class="btn" onClick="setOnOff('homeplug1','ON', '0', 'F')" />
                    &nbsp;&nbsp;&nbsp;
                    <input type="button" name="btnOff1" value="&nbsp;&nbsp;&nbsp; ปิด &nbsp;&nbsp;&nbsp;" class="btnClose" onClick="setOnOff('homeplug1','OFF', '0', 'F')"/>
                </div>
                </td>
            </tr>
            <tr bgcolor="#CCCCCC">
            	<td colspan="4" height="3"></td>
            </tr>
            <tr bgcolor="#C1F99D">
            	<td>&nbsp;</td>
                <td valign="middle"></td>
                <td>
                    
                </td>
                <td>
                </td>
            </tr>
        </table>
    </form>
<script>
	function setOnOff(led, flg, sec, loopsts){
		<!--
			//alert(flg);
			document.setled.action = "home_lamp_succ.php";
			document.setled.ledno.value = led;
			document.setled.msg.value = flg;
			document.setled.sec.value = sec;
			document.setled.loopsts.value = loopsts;
			document.setled.method = "post";
			document.setled.target = "_self";
			document.setled.submit();
		//-->
	}
		$(function(){
			$('#slides').slides({
				preload: true,
				generateNextPrev: true,	
			});
		});
</script>

</body>
</html>
