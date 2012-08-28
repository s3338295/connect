<?php 
session_start(); 
include 'tweet.php';  
foreach ($_SESSION['winearray'] as $key=>$kk)
{
$array[] = $kk;
}
/*
echo count($array) .  "</br>";
$i = 0;
while($i < count($array))
{
$data = $array[$i];
echo $data;
$i++;
}
echo $data;
*/
$temp = implode(",",$array);
echo $temp;
print_r ($tweet->post('statuses/update', array('status' => $temp)));

?>
