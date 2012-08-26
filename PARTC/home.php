<?php
define("USER_HOME_DIR", "/home/stud/s3338295");
require(USER_HOME_DIR . "/php/Smarty-3.1.11/libs/Smarty.class.php");
$smarty = new Smarty();
$smarty->template_dir = USER_HOME_DIR . "/php/Smarty-Work-Dir/templates";
$smarty->compile_dir = USER_HOME_DIR . "/php/Smarty-Work-Dir/templates_c";
$smarty->cache_dir = USER_HOME_DIR . "/php/Smarty-Work-Dir/cache";
$smarty->config_dir = USER_HOME_DIR . "/php/Smarty-Work-Dir/configs";
$smarty->assign('title', 'Smarty');
$smarty->assign('head', 'Wine Store');

require('db.php');
if (!$conn = mysql_connect(DB_HOST, DB_USER, DB_PW)) 
{
echo 'Could not connect to mysql on ' . DB_HOST . "\n";
exit;
}
echo 'Connected to mysql !!!!!!!!!!!!!!'."\n";
if (!mysql_select_db(DB_NAME, $conn)) 
{
echo 'Could not use database !!!!!!!!!!!!!'."\n";
echo mysql_error() . "\n";
exit;
}
$query = mysql_query("select region_name from region");
while ($row = mysql_fetch_array($query)) 
{
  $rowregion[] = $row;
}
$smarty->assign('rowregion', $rowregion);
$query = mysql_query("select variety from grape_variety");
while ($row = mysql_fetch_array($query))
{
  $rowvariety[] = $row;
}
$smarty->assign('rowvariety', $rowvariety);
$query = mysql_query("select distinct year from wine order by year");
while ($row = mysql_fetch_array($query))
{
  $rowfyear[] = $row;
}
$smarty->assign('rowfyear', $rowfyear);
$query = mysql_query("select distinct year from wine order by year");
while ($row = mysql_fetch_array($query))
{
  $rowsyear[] = $row;
}
$smarty->assign('rowsyear', $rowsyear);
$smarty->assign('filename', 'home1.php');
$smarty->display('home.tpl');
?>
