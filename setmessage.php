<?php
include "db_connection.php";
	if (isset($_POST["ledno"])){
		$conn = OpenCon();
		$sql = "select ledno, msg from ledcfg where ledno = '".$_POST["ledno"]."'";
		//echo $sql;
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
	}
	if (isset($_POST["ledno"]) && isset($_POST["msg"])){
		$conn = OpenCon();
		$sql = "update ledcfg set msg = '".trim($_POST["msg"])."' where ledno = '".$_POST["ledno"]."'";
		
		if ($conn->query($sql) === TRUE) {
			$res_upd = "แก้ไขข้อความเสร็จสมบูรณ์";
			$_msg = $_POST["msg"];
		} else {
			$res_upd = "แก้ไขข้อความ ผิดพลาด";
		}
		CloseCon($conn);
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  	<title><?=$title?></title>
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
			<!--<div id="call">
				<img src="images/SCSLogo.png" width="170"/>
			</div>
            -->
            <!-- end call -->
            <form name="setled" method="post" action="#" enctype="multipart/form-data">
			<nav class="group">
				<ul>
					<li class="home"><a href="#" title="">Home</a></li>
                    <li><a href="#" title="LED NO :">LED NO: <?=$_ledno;?></a></li>
                    <li>
						<div align="center">
                        	<input type="hidden" name="ledno" value="<?=$_ledno;?>" maxlength="10" />
							<input type="text" name="msg" value="<?=$_msg;?>" maxlength="100" />
							<input type="submit" name="search" value=" บันทึก " class="search"/>
						</div>
                    </li>
                    <?php
					if (isset($res_upd)){
						?>
                        <script language="javascript">
						<!--
							alert("<?=$res_upd;?>");
						//-->
						</script>
						<li>
							<a href="#"><?=$res_upd;?></a>
						</li>
						<?php
					}
					?>
                    
                    <li class="last">
                        <a href="#"> </a>
					</li>
				</ul>
			</nav>
            </form>
		</header>
	</div><!-- end header wrap -->
<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				generateNextPrev: true,	
			});
		});
</script>

</body>
</html>
