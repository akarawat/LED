<?php
include "db_connection.php";
	if (isset($_POST["ledno"])){
		$conn = OpenCon();
		$sql = "select ledno from ledcfg where ledno = '".trim($_POST["ledno"])."'";
		$result = $conn->query($sql);
		//echo $sql;
		if ($result->num_rows > 0) {
		// output data of each row
			while($row = $result->fetch_assoc()) {
				//echo "id: " . $row["ledno"]."<br>";
				$_ledno = $row["ledno"];
			}
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
    <style>
	</style>
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
                    <li><a href="#" title="LED NO :">แก้ไขข้อความ ระบุหมายเลข LED : </a></li>
                    <li>
						<div align="center">
							
                            <input type="text" name="ledno" placeholder="LED NO :" maxlength="10" />
							<input type="submit" name="search" value=" GO " class="search"/>
						</div>
                    </li>
                    <?php
					if (isset($_POST["ledno"])){
						if (isset($_ledno)){
						?>
						<script language="javascript">
						<!--
							document.setled.action = "setmessage.php";
							document.setled.ledno.value = <?=$_ledno?>;
							document.setled.method = "post";
							document.setled.target = "_self";
							document.setled.submit();
						//-->
						</script>
						<?php	
						}else{
						?>
						<li>
							<a href="#">ไม่พบหมายเลขนี้ในระบบ</a>
						</li>
						<?php
						}
					}
					?>
                    
                    <li class="last">
                        <a href="#"></a>
					</li>
				</ul>
			</nav>
            <br/><br/><br/>
            </form>
		</header>
	</div><!-- end header wrap -->
    
    <div id="widget-wrap" class="group">
		<div id="widget">
			<div id="links" class="group">
				<h4 class="white"><strong>ป้าย LED Online อัพเดทข้อความผ่านมือถือได้เองตลอดเวลา</strong></h4>
				<ul>
					<li><a href="LED_Wifi_Online.pdf" target="_blank" title="Click">Download คู่มือ</a></li>
				</ul>
                <br/>
                <h4 class="white"><strong>สอบถาม</strong></h4>
				<ul>
					<li><font color="#FFFFFF">097 234 0388</font></li>
				</ul>
			</div>
			
			<div id="blog" style="display:none">
				<h4 class="footer-header white">Contact Us <strong>Blog</strong></h4>
				<img src="images/blog.png" alt="blog" />
				<p class="title">บริษัท สมาร์ท คอนเนค โซลูชั่น จำกัด 122 13160 1, ตำบล คลองจิก อำเภอ บางปะอิน พระนครศรีอยุธยา</p>
				<p class="date">+66 97 234 0388</p>
			</div><!-- end blog -->
			
			<div id="location" style="display:none">
				<h4 class="footer-header white">Our <strong>Location</strong></h4>
				
                <img src="images/map.png" alt="map" border="0" />
                
			</div><!-- end location -->
		</div><!-- end widget -->
	</div> <!--! end widget-wrap -->
    
    <footer class="group">
		<div id="footer-left">
			<p class="title">บริษัท สมาร์ท คอนเนค โซลูชั่น จำกัด 122 13160 1, ตำบล คลองจิก อำเภอ บางปะอิน พระนครศรีอยุธยา</p>
				<p class="date">+66 97 234 0388</p>
                <a href="farmsook_lamp.php"><p class="date">+66 95 953 130</p></a>
		</div>
			
		<div id="footer-right">
			<!--<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Services</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Testimonials</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>-->
		</div>
				
		<a href="#header-wrap"><img src="images/back-top.png" alt="back-top" class="back-top" /></a>		
	</footer>
    
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
