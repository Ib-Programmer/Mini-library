<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
<title></title>
</head>
<body>
<?php 
require 'Connection.php';
require 'Authentication.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = $connection->prepare("DELETE FROM  bookinformations WHERE Id= ?"); 
    $sql->bind_param('s',$id); 
    $sql->execute();
  if($sql->execute() === TRUE){
    header("Location: Viewbooks.php");
    }
    else {
        ?>

     <script>alert("Something wrong cannot delete book.");</script>
  <?php   }
}
?>
</body>
</html>