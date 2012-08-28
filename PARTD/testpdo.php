<?php
define('DB_HOST', 'yallara.cs.rmit.edu.au');
define('DB_PORT', '59785'); 
define('DB_NAME', 'winestore');
define('DB_USER', 'root'); 
define('DB_PW', 'kurian'); 
try {
$db = new PDO(
"mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME,
DB_USER,DB_PW);

} catch(PDOException $e) {
echo $e->getMessage();
}
?>

