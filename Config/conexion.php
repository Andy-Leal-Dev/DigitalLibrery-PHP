<?php 

$host = "localhost";
$dbname = "digital_library";
$username = "root";
$password = "";

try {
    
    $conn = new mysqli($host,$username,$password, $dbname);
    //$conn = pg_connect("host=$host dbname=$dbname user=$username password=$password") ;

   // $conn = new ("pgsql:host=$host; dbname=$dbname", $username, $password);
   
} catch(PDOException $exp) {
    echo ("Error de conexión: $exp");

}

return $conn;

?>
