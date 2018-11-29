<?php
include "../db_connection.php";
$_plgno = "";
$_bit1 = "";
$_bit2 = "";
$_bit3 = "";
$_bit4 = "";
$_bit5 = "";
	if (isset($_GET["plgno"])){
		$conn = OpenCon();
		//$sql = "select plgno from smpcfg where plgno = '".trim($_GET["plgno"])."'";
		$sql = "SELECT plgno, bit1, bit2, bit3, bit4, bit5 FROM `smpcfg` WHERE plgno = '".trim($_GET["plgno"])."'";
		$result = $conn->query($sql);
		//echo $sql;
		if ($result->num_rows > 0) {
		// output data of each row
			while($row = $result->fetch_assoc()) {
				$_plgno = $row["plgno"];
				$_bit1 = $row["bit1"];
				$_bit2 = $row["bit2"];
				$_bit3 = $row["bit3"];
				$_bit4 = $row["bit4"];
				$_bit5 = $row["bit5"];
				/////echo "id: ".$_plgno."<br>";
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
    <link rel="stylesheet" href="../style.css">

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
  <script src="../js/slides.min.jquery.js"></script>
	
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
	<?php
        //if (isset($_GET["plgno"])){
            if (isset($_plgno)){
            ?>
            <script language="javascript">
            <!--
                //document.setled.action = "setscheduleconfig.php";
                //document.setled.plgno.value = <?=$_plgno?>;
				document.getElementById("plgno").value = <?=$_plgno?>;
                //document.setled.method = "get";
                //document.setled.target = "_self";
                //document.setled.submit();
				
				function setSchedule(bt, st, en){
					document.setled.action = "setscheduleconfig.php";
					document.setled.chanel.value = bt;	
					document.setled.sttm.value = st;	
					document.setled.entm.value = en;	
					document.setled.method = "get";
					document.setled.target = "_self";
					document.setled.submit();
				}
            //-->
            </script>
            <?php	
            }
        //}
    ?>
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
            <form name="setled" method="get" action="#" enctype="multipart/form-data">
            	<input type="hidden" name="chanel">
                <input type="hidden" name="sttm">
                <input type="hidden" name="entm">
			<nav class="group">
				<ul>
					<li class="home"><a href="#" title="">Home</a></li>
                    <li><a href="#" title="SMART PLUG NO :"> ระบุหมายเลข SMART PLUG : </a></li>
                    <li>
						<div align="center">							
                        <input type="text" name="plgno" id="plgno" value="<?=$_plgno?>" placeholder="PLUG NO :" maxlength="10" />
							<input type="submit" name="search" value=" GO " class="search"/>
						</div>
                    </li>
                    <?php
					if ($_plgno == ""){
						?>
						<li>
							<a href="#">ไม่มีหมายเลขนี้ในระบบ</a>
						</li>
						<?php
					}
					?>
				</ul>
			</nav>
            <br/>
            <?php
            if ($_plgno != ""){
				$_pic1 = "";
				$_pic2 = "";
				$_pic3 = "";
				$_pic4 = "";
				$_pic5 = "";
				$_set1 = "";
				$_set2 = "";
				$_set3 = "";
				$_set4 = "";
				$_set5 = "";
				
				$_hhstp1 = "00";
				$_mmstp1 = "00";
				$_hhenp1 = "00";
				$_mmenp1 = "00";
				
				$_hhstp2 = "00";
				$_mmstp2 = "00";
				$_hhenp2 = "00";
				$_mmenp2 = "00";
				
				$_hhstp3 = "00";
				$_mmstp3 = "00";
				$_hhenp3 = "00";
				$_mmenp3 = "00";
				
				$arr1 = explode("|",$_bit1);
				if ($arr1[0] == "0"){
					$_pic1 = "reddot70.png";
					$_set1 = "1";
				}else if ($arr1[0] == "1"){
					$_pic1 = "greedot70.png";
					$_set1 = "0";
				}
				if ($arr1[1] != "00.00-00.00"){
					$_hhstp1 = substr($arr1[1],0,2);
					$_mmstp1 = substr($arr1[1],3,2);
					$_hhenp1 = substr($arr1[1],6,2);
					$_mmenp1 = substr($arr1[1],9,2);
				}
				
				$arr2 = explode("|",$_bit2);
				if ($arr2[0] == "0"){
					$_pic2 = "reddot70.png";
					$_set2 = "1";
				}else if ($arr2[0] == "1"){
					$_pic2 = "greedot70.png";
					$_set2 = "0";
				}
				if ($arr2[1] != "00.00-00.00"){
					$_hhstp2 = substr($arr2[1],0,2);
					$_mmstp2 = substr($arr2[1],3,2);
					$_hhenp2 = substr($arr2[1],6,2);
					$_mmenp2 = substr($arr2[1],9,2);
				}
				
				$arr3 = explode("|",$_bit3);
				if ($arr3[0] == "0"){
					$_pic3 = "reddot70.png";
					$_set3 = "1";
				}else if ($arr3[0] == "1"){
					$_pic3 = "greedot70.png";
					$_set3 = "0";
				}
				if ($arr3[1] != "00.00-00.00"){
					$_hhstp3 = substr($arr3[1],0,2);
					$_mmstp3 = substr($arr3[1],3,2);
					$_hhenp3 = substr($arr3[1],6,2);
					$_mmenp3 = substr($arr3[1],9,2);
				}
				
				$arr4 = explode("|",$_bit4);
				if ($arr4[0] == "0"){
					$_pic4 = "reddot70.png";
					$_set4 = "1";
				}else if ($arr4[0] == "1"){
					$_pic4 = "greedot70.png";
					$_set4 = "0";
				}
				$arr5 = explode("|",$_bit5);
				if ($arr5[0] == "0"){
					$_pic5 = "reddot70.png";
					$_set5 = "1";
				}else if ($arr5[0] == "1"){
					$_pic5 = "greedot70.png";
					$_set5 = "0";
				}
			?>
            
            <nav class="group">
				<ul>
					<li class="homeblnk"></li>
                    <li>
                    <a href="setconfig.php?plgno=<?=$_plgno?>&chanel=b1&sets=<?=$_set1?>" title="SMART PLUG CHANEL :"><img src="../images/<?=$_pic1;?>" width="20" alt="middle" border="0"/> PLUG 1</a>
                    </li>
                    <li><a>หรือตั้งเวลา</a></li>
                    <li>
                    <a> ON
                    <select name="stHrPlg1">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option selected><?=$_hhstp1?></option>
                    </select>
                    <select name="stMnPlg1">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="59">59</option>
                        <option selected><?=$_mmstp1?></option>
                    </select>
                    </a>
                    </li>
                    <li>
                    <a> OFF
                    <select name="EnHrPlg1">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option selected><?=$_hhenp1?></option>
                    </select>
                    <select name="EnMnPlg1">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="59">59</option>
                        <option selected><?=$_mmenp1?></option>
                    </select>
                    </a>
                    </li>
                    <li>
                     <a><input type="button" value="บันทึกการตั้งค่า" onClick="if (confirm('ยืนยันการ บันทึกการตั้งค่า?')) setPlg1();"/></a>
                    </li>
                    <li>
                     <a><input type="button" value="ลบการตั้งค่า" onClick="if (confirm('ยืนยันการ ลบการตั้งค่า?')) setSchedule('b1','00.00','00.00');"/></a>
                    </li>
				</ul>
			</nav>
            <script language="javascript">
            	function setPlg1(){
					var stHHplg1 = document.setled.stHrPlg1.value; 
					var stMMplg1 = document.setled.stMnPlg1.value; 
					var STplg1 = stHHplg1 + ":" + stMMplg1;
					//alert(STplg1);
					var enHHplg1 = document.setled.EnHrPlg1.value; 
					var enMMplg1 = document.setled.EnMnPlg1.value; 
					var ENplg1 = enHHplg1 + ":" + enMMplg1;
					//alert(ENplg1);
					if (STplg1 == "00.00" && ENplg1 == "00.00")
					{
						return;
					}else{
						//alert(STplg1 + "-" + ENplg1);
						setSchedule('b1', STplg1, ENplg1);
					}
				}
            </script>
            <br/>
            
            <nav class="group">
				<ul>
					<li class="homeblnk"></li>
                    <li>
                    <a href="setconfig.php?plgno=<?=$_plgno?>&chanel=b2&sets=<?=$_set2?>" title="SMART PLUG CHANEL :"><img src="../images/<?=$_pic2;?>" width="20" alt="middle" border="0"/> PLUG 2</a>
                    </li>
                    <li><a>หรือตั้งเวลา</a></li>
                    <li>
                    <a> ON
                    <select name="stHrPlg2">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option selected><?=$_hhstp2?></option>
                    </select>
                    <select name="stMnPlg2">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="59">59</option>
                        <option selected><?=$_mmstp2?></option>
                    </select>
                    </a>
                    </li>
                    <li>
                    <a> OFF
                    <select name="EnHrPlg2">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option selected><?=$_hhenp2?></option>
                    </select>
                    <select name="EnMnPlg2">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="59">59</option>
                        <option selected><?=$_mmenp2?></option>
                    </select>
                    </a>
                    </li>
                    <li>
                     <a><input type="button" value="บันทึกการตั้งค่า" onClick="if (confirm('ยืนยันการ บันทึกการตั้งค่า?')) setPlg2();"/></a>
                    </li>
                    <li>
                     <a><input type="button" value="ลบการตั้งค่า" onClick="if (confirm('ยืนยันการ ลบการตั้งค่า?')) setSchedule('b2','00.00','00.00');"/></a>
                    </li>
				</ul>
			</nav>
            <script language="javascript">
            	function setPlg2(){
					var stHHPlg2 = document.setled.stHrPlg2.value; 
					var stMMPlg2 = document.setled.stMnPlg2.value; 
					var STPlg2 = stHHPlg2 + ":" + stMMPlg2;
					//alert(STPlg2);
					var enHHPlg2 = document.setled.EnHrPlg2.value; 
					var enMMPlg2 = document.setled.EnMnPlg2.value; 
					var ENPlg2 = enHHPlg2 + ":" + enMMPlg2;
					//alert(ENPlg2);
					if (STPlg2 == "00.00" && ENPlg2 == "00.00")
					{
						return;
					}else{
						alert(STPlg2 + "-" + ENPlg2);
						setSchedule('b2', STPlg2, ENPlg2);
					}
				}
            </script>
            <br/>
            <!--
            <nav class="group">
				<ul>
					<li class="homeblnk"></li>
                    <li>
                    <a href="setconfig.php?plgno=<?=$_plgno?>&chanel=b3&sets=<?=$_set3?>" title="SMART PLUG CHANEL :"><img src="../images/<?=$_pic3;?>" width="20" alt="middle" border="0"/> PLUG 3</a>
                    </li>
                    <li><a>หรือตั้งเวลา</a></li>
                    <li>
                    <a> ON
                    <select name="stHrPlg3">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option selected><?=$_hhstp3?></option>
                    </select>
                    <select name="stMnPlg3">
                    	<option value="00">00</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option selected><?=$_mmstp3?></option>
                    </select>
                    </a>
                    </li>
                    <li>
                    <a> OFF
                    <select name="EnHrPlg3">
                    	<option value="00">00</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option selected><?=$_hhenp3?></option>
                    </select>
                    <select name="EnMnPlg3">
                    	<option value="00">00</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option selected><?=$_mmenp3?></option>
                    </select>
                    </a>
                    </li>
                    <li>
                     <a><input type="button" value="บันทึกการตั้งค่า" onClick="if (confirm('ยืนยันการ บันทึกการตั้งค่า?')) setPlg3();"/></a>
                    </li>
                    <li>
                     <a><input type="button" value="ลบการตั้งค่า" onClick="if (confirm('ยืนยันการ ลบการตั้งค่า?')) setSchedule('b3','00.00','00.00');"/></a>
                    </li>
				</ul>
			</nav>
            <script language="javascript">
            	function setPlg3(){
					var stHHPlg3 = document.setled.stHrPlg3.value; 
					var stMMPlg3 = document.setled.stMnPlg3.value; 
					var STPlg3 = stHHPlg3 + ":" + stMMPlg3;
					//alert(STPlg3);
					var enHHPlg3 = document.setled.EnHrPlg3.value; 
					var enMMPlg3 = document.setled.EnMnPlg3.value; 
					var ENPlg3 = enHHPlg3 + ":" + enMMPlg3;
					//alert(ENPlg3);
					if (STPlg3 == "00.00" && ENPlg3 == "00.00")
					{
						return;
					}else{
						alert(STPlg3 + "-" + ENPlg3);
						setSchedule('b3', STPlg3, ENPlg3);
					}
				}
            </script>
            <br/>
            -->
            
            <?php } ?>
            <br/><br/><br/>
            </form>
		</header>
	</div><!-- end header wrap -->
    
    <div id="widget-wrap" class="group">
		<div id="widget">
			<div id="links" class="group">
				<h4 class="white"><strong>Smart Plug ปิด/เปิด ผ่านมือถือได้เองตลอดเวลา</strong></h4>
				<ul>
					<li></li>
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
