<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">  
    <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Registerstyle.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Delete</title>
</head>
<body>
<?php
 require 'Authentication.php'; 
 require 'Connection.php';
 $page = "";
 // deleting from response table 
  if(isset($_GET['delres'])){
     $id = $_GET['delres'];
     $sql = $connection->prepare("DELETE FROM responses  WHERE Id= ?"); 
     $sql->bind_param('s',$id); 
     $sql->execute();
     if ($sql->execute() === TRUE){
      header("Location: Viewresponse.php");
     }
   else {
       ?>

    <script>alert("Something wrong cannot delete response.");</script>
 <?php 
    }
  }
 // deleting from users 
 else if(isset($_GET['deluser'])){
    $id = $_GET['deluser'];
    $sql = $connection->prepare("DELETE FROM users  WHERE Id= ?");
    $sql->bind_param('s',$id); 
     $sql->execute();
     if ($sql->execute() === TRUE){
      header("Location: Viewusers.php");
     }
   else {
       ?>

    <script>alert("Something wrong cannot delete user.");</script>
 <?php 
    }   
 }

// deleting from user suggestioins  
else if(isset($_GET['delsugest'])){
    $id = $_GET['delsugest'];
    $sql = $connection->prepare("DELETE FROM suggestions  WHERE Id= ?"); 
    $sql->bind_param('s',$id); 
    $sql->execute();
    if ($sql->execute() === TRUE){
     header("Location: Viewsuggestions.php");
    }
  else {
      ?>

   <script>alert("Something wrong cannot delete response.");</script>
<?php 
   }   
    
 }
    else{
     echo "<span class='Errormessage'>"."Error: the record was not deleted."."</span>"."<p>";
     echo "<a href='Superdashboard.php'>"."<input type='submit' class='btn btn-primary' value='<<< Back'>"."</a>";
   } 
 $connection->close();
?>
</body>
</html>