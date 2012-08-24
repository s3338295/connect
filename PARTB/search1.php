<html>
<title>
search
</title>
<body>
<?php
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
  function display($conn,$query,$winename)
  {
      if (!($result = @ mysql_query ($query, $conn))) 
      {
         showerror();
      }
      $rowsFound = @ mysql_num_rows($result);
      if ($rowsFound > 0) 
      {
          print "<br />SEARCH RESULT<br />";
          print "\n<table>\n<tr>" . "\n\t<th>Wine Name</th>" .
                "\n\t<th>Variety</th>" . "\n\t<th>Year</th>" . 
                "\n\t<th>Winery</th>" . "\n\t<th>Region</th>" .
		"\n\t\t<th>Stock</th>" . "\n\t\t\t<th>Order</th>" .
		"\n\t\t\t<th>Min.cost</th>" . "\n\t\t\t<th>Max.cost</th>\n</tr>"; 

          while ($row = @ mysql_fetch_array($result)) 
          {
               print "\n<tr>\n\t<td>{$row["wine_name"]}</td>" .
                     "\n\t<td>{$row["variety"]}</td>" .
                     "\n\t<td>{$row["year"]}</td>" .
                     "\n\t<td>{$row["winery_name"]}</td>" .
                     "\n\t<td>{$row["region_name"]}</td>" .
		     "\n\t\t<td>{$row["on_hand"]}</td>" .
                     "\n\t\t<td>{$row["qty"]}</td>" .
                     "\n\t<td>{$row["cost"]}</td>" . 
                     "\n\t<td>{$row["price"]}</td>\n</tr>";
          }
          print "\n</table>"; 
       }
       print "{$rowsFound} records found matching your criteria<br>";
   }
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
	$query .= " AND wine_name = '{$winename}'";
    }
    if (isset($wineryname) && $wineryname != "")
    {
        $query .= " AND winery_name = '{$wineryname}'";
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
    $query .= " GROUP BY wine_name,variety,year,winery_name,region_name,cost";


 display($conn,$query,$winename);

?>
</body>
</html>

