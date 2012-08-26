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
  function showerror()
  {
      die("Error " . mysql_errno() . " : " . mysql_error());
  }
  require "db.php";

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


      if (!($result = @ mysql_query ($query, $conn)))
      {
         showerror();
      }
      $rowsFound = @ mysql_num_rows($result);


          while ($row = @ mysql_fetch_array($result))
	{
          $string[] = $row;
    	}

$smarty->assign('rowsFound', $rowsFound);
$smarty->assign('rows', $string);
$smarty->display('home1.tpl');


?>

