<?php
session_start();
define("USER_HOME_DIR", "/home/stud/s3338295");
require(USER_HOME_DIR . "/php/Smarty-3.1.11/libs/Smarty.class.php");
$smarty = new Smarty();
$smarty->template_dir = USER_HOME_DIR . "/php/Smarty-Work-Dir/templates";
$smarty->compile_dir = USER_HOME_DIR . "/php/Smarty-Work-Dir/templates_c";
$smarty->cache_dir = USER_HOME_DIR . "/php/Smarty-Work-Dir/cache";
$smarty->config_dir = USER_HOME_DIR . "/php/Smarty-Work-Dir/configs";
$smarty->assign('title', 'Smarty');
$smarty->assign('head', 'Wine Store');



$winename=$_GET["wname"];
$wineryname=$_GET["wiyname"];
$regionname=$_GET["rname"];
$grapevar=$_GET["gvar"];
$firstyear=$_GET["fyear"];
$secondyear=$_GET["syear"];
$minstock=$_GET["mstock"];
$minorder=$_GET["morder"];
$mincost=$_GET["mcost"];
$maxcost=$_GET["macost"];

if(isset($_SESSION['count']))
{
$count=1;
}

  require "testpdo.php";



    $query = "select wine_name,variety,year,winery_name,region_name,price,qty,cost,on_hand,sum(qty),sum(price)
    from wine,grape_variety,winery,region,wine_variety,items,inventory
    where winery.region_id = region.region_id
    and wine.winery_id = winery.winery_id
    and wine.wine_id = wine_variety.wine_id
    and wine_variety.variety_id = grape_variety.variety_id
    and wine.wine_id=items.wine_id
    and wine.wine_id=inventory.wine_id"; 
    if (isset($winename) && $winename != "") 
    {
	$query .= " AND wine_name LIKE '%{$winename}%'";
    }
    if (isset($wineryname) && $wineryname != "")
    {
        $query .= " AND winery_name LIKE '%{$wineryname}%'";
    }
    if (isset($regionname) && $regionname != "All")
    {
        $query .= " AND region_name = '{$regionname}'";
    }
    if (isset($grapevar) && $grapevar != "")
    {
        $query .= " AND variety = '{$grapevar}'";
    }
    if ((isset($firstyear) && $firstyear != "") && (isset($secondyear) && $secondyear != "")) 
    {
        $query .= " AND year between '{$firstyear}' and '{$secondyear}'";
    }
    if ((isset($minstock) && $minstock != ""))
    {
        $query .= " AND on_hand >= '{$minstock}'";
    }
    if (isset($minorder) && $minorder != "") 
    {
        $query .= " HAVING sum(qty) >= '{$minorder}'";
    }
    if ((isset($mincost) && $mincost != "") && (isset($maxcost) && $maxcost != ""))
    {
        $query .= " AND cost between '{$mincost}' and '{$maxcost}'";
    }
    $query .= " GROUP BY wine_name, variety, year, winery_name, region_name, cost";

         foreach($db->query($query) as $row)
	{
          $string[] = $row;
	  $wine[] = $row[0];
          $rowsFound = 1;
    	}

       if(isset($_SESSION['count'])) 
       {
          $_SESSION['winearray'] = array_merge((array)$_SESSION['winearray'],(array)$wine);
       }	

$smarty->assign('rowsFound', $rowsFound);
$smarty->assign('rows', $string);
$smarty->assign('count',$count);
$smarty->display('home1.tpl');


?>

