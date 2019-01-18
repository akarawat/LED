<?php
include "db_connection.php";
	if (isset($_POST["ledno"]) && isset($_POST["msg"]) && isset($_POST["sec"])){
		$conn = OpenCon();
		$curtime = $UTC;
		$loop_sec = $UTC + $LPSEC;
		$setsec = 0;
		
		if ($_POST["sec"]){ // If set off time
			$setsec = $curtime + $_POST["sec"];
		}
		if($_POST["loopsts"] == "T"){ // If set loop on-off
			$flgloop30 = "T";
			$flgloop30_sts = "T";
			$loopsec = $loop_sec;
			//echo $loopsec; exit();
		}else{
			$loopsec = 0;
			$flgloop30 = "F";
			$flgloop30_sts = "F";
		}
		
		$sql = "update ledcfg set msg = '".trim($_POST["msg"])."', secoff = '".$setsec."', flgloop30 = '".$flgloop30."', flgloop30_sts = '".$flgloop30_sts."', flgloops = '".$loopsec."' where ledno = '".$_POST["ledno"]."'";
		
		if ($conn->query($sql) === TRUE) {
			$res_upd = "แก้ไขเสร็จสมบูรณ์";
			$_msg = $_POST["msg"];
		} else {
			$res_upd = "แก้ไข ผิดพลาด";
		}
		CloseCon($conn);
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  	<title><?=$title?></title>
    <meta http-equiv="refresh" content="1;URL='home_lamp.php'" />
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
</head>
<body>
	<div id="header-wrap">
		<header class="group">
			<h2><a href="index.php" title="LED Matrix By scsthai.com">LED Matrix</a></h2>			
		</header>
	</div><!-- end header wrap -->
<script>
</script>

</body>
</html>
