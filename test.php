<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
echo date("d/m/y H:i:s", 1543461935)."<br/>"; 
$curtime = time() + 25200;
echo date("d/m/y H:i:s", $curtime)."<br/>"; 

echo "Time:".time()."</br>";
echo "Time +7:".$curtime."</br>";

$str = "0|08.00-17.00";
$hr1 = explode("|",$str);
echo addzero("12");
function addzero($num){
	while(strlen($num) < 2){
		$num = "0".$num;
	}
	return $num;
}


echo "<br/>";

$val = array();
$val["id"]="123456";
$val["name"]="adam";

$data = array();
$data["item"][]=$val;

echo json_encode($data);

?>
</body>
</html>