<?php
$DB_HOST = 'yallara';
$DB_USER = 'root';
$DB_PW = 'kurian';
$DB_NAME = 'winestore';

require "db.php";
if (!$conn = mysql_connect(DB_HOST, DB_USER, DB_PW)) {
echo 'Could not connect to mysql on ' . DB_HOST . "\n";
exit;
}
echo 'Connected to mysql on ' . DB_HOST . "\n";
if (!mysql_select_db(DB_NAME, $conn)) {
echo 'Could not use database ' . DB_NAME . "\n";
echo mysql_error() . "\n";
exit;
}
?>
<html>
<head>
</head>
<body>
<form name="search" action="search_1.php" method="post">
Wine Name<input type="text" size="30" name="winename" /><br />
Winery Name<input type="text" size="30" name="wineryname" /><br />
Region Name
<?php
$query = mysql_query("select region_name from region");
echo '<select name="regionname">';
while ($row = mysql_fetch_array($query)) {
echo "<option value='$row[0]'>$row[0]</option><br />";
}
echo "</select>";
?>
Grape Variety
<?php
$query = mysql_query("select variety from grape_variety");
echo '<select name="groupvariety">';
while ($row = mysql_fetch_array($query)) {
echo "<option value='$row[0]'>$row[0]</option><br />";
}
echo "</select>";
?>
Grape Variety
<?php
$query = mysql_query("select variety from grape_variety");
echo '<select name="groupvariety">';
while ($row = mysql_fetch_array($query)) {
echo "<option value='$row[0]'>$row[0]</option><br />";
}
echo "</select>";
?>
</form>
</body>
</html>
