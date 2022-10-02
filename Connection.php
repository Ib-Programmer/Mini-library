<!DOCTYPE HTML>
<html>
<head>
<title></title>
</head>
<body>
    <?php   
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";
$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed !");
} 
    ?>
</body>
</html>   