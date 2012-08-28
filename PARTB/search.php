<?php
require "db.php";
if (!$conn = mysql_connect(DB_HOST, DB_USER, DB_PW)) {
echo 'Could not connect to mysql on ' . DB_HOST . "\n";
exit;
}
echo 'Connected to mysql !!!!!!!!!!!!!!'."\n";
if (!mysql_select_db(DB_NAME, $conn)) {
echo 'Could not use database !!!!!!!!!!!!!'."\n";
echo mysql_error() . "\n";
exit;
}
?>
<script type="text/javascript">
function validate(search)
{
	if(search.fyear.value > search.syear.value)
        {
		alert("Please enter the correct range of year");
		search.syear.focus();
		return false;
	}
	if(search.mcost.value < search.macost.value)
        {
                alert("Maximum cost should be greater than Minimum cost");
                search.macost.select();
                search.macost.focus();
                return false;
        }
}
</script>
<html>
<head>
</head>
<body>
<form name="search" action="search1.php" method="get" onsubmit="return validate(this)">
Wine Name(or part of a wine name)<input type="text" size="30" name="wname" /><br />
Winery Name(or part of a winery name)<input type="text" size="30" name="wiyname" /><br />
Region Name
<?php
$query = mysql_query("select region_name from region");
echo '<select name="rname">';
while ($row = mysql_fetch_array($query)) {
echo "<option value='$row[0]'>$row[0]</option><br />";
}
echo "</select>";
echo "<br />";
?>
Grape Variety
<?php
$query = mysql_query("select variety from grape_variety");
echo '<select name="gvar">';
echo "<option value='$row[0]'>All</option><br />";
while ($row = mysql_fetch_array($query)) {
echo "<option value='$row[0]'>$row[0]</option><br />";
}
echo "</select>";
echo "<br />";
?>
Range of Year from
<?php
$query = mysql_query("select distinct year from wine order by year");
echo '<select name="fyear">';
echo "<option value='$row[0]'>All</option><br />";
while($row = mysql_fetch_array($query))
{ 
echo "<option value='$row[0]'>$row[0]</option><br />";
}
echo "</select>";
?>
to
<?php
$query = mysql_query("select distinct year from wine order by year");
echo '<select name="syear">';
echo "<option value='$row[0]'>All</option><br />";
while ($row = mysql_fetch_array($query)) {
echo "<option value='$row[0]'>$row[0]</option><br />";
}
echo "</select>";
echo "<br />";
?>
Minimum number of wines in stock, per wine
<input type="text" size="7" name="mstock" /><br />
Minimum number os wines ordered, per wine
<input type="text" size="7" name="morder" /><br />
Cost range minimum
<input type="text" size="7" name="mcost" />
to maximum
<input type="text" size="7" name="macost" /><br /><br />
<input type="submit" size="7" name="submit" value="search" /><br />
</form>
</body>
</html>
