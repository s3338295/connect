<?php
session_start();
if(isset($_SESSION['count']))
{
$_SESSION['count'] = 0;
$_SESSION['start'] = time();
}
else
{
$_SESSION['count'] = 1;
header( 'Location:home.php' ) ;
}
?>

