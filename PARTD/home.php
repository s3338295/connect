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

require('testpdo.php');

$query = "select region_name from region";
foreach ($db->query($query) as $rows)
{
  $rowregion[] = $rows;
}
$smarty->assign('rowregion', $rowregion);
$query = "select variety from grape_variety";
foreach ($db->query($query) as $rows)
{
  $rowvariety[] = $rows;
}
$smarty->assign('rowvariety', $rowvariety);
$query = "select distinct year from wine order by year";
foreach ($db->query($query) as $rows)
{
  $rowfyear[] = $rows;
}
$smarty->assign('rowfyear', $rowfyear);
$query = "select distinct year from wine order by year";
foreach ($db->query($query) as $rows)
{
  $rowsyear[] = $rows;
}
$smarty->assign('rowsyear', $rowsyear);
$smarty->assign('filename', 'home1.php');
$smarty->display('home.tpl');
?>
