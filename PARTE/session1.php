<?php
session_start();

if (isset($_SESSION['count']))
{
unset($_SESSION['count']);
session_unset();
session_destroy();
}
 header( 'Location:home.php' ) ;

?>

