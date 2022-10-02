<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Dashboardstyle.css">  
<title>Student  Dashboard</title>
</head>
<body>
<?php
require 'Authentication.php'; 
?>
<div class="header">  
   <img src="\www.librarymanagement.com\Images\userlogin.png"><br>
   <h1>Welcome <?php echo $_SESSION["Name"]; ?> </h1>
   <ul>
                    <li><a href="Viewbookstudent.php">View Books</a></li>
                    <li><a href="Mestudent.php">Profile</a></li>
                    <li><a href="Index.php"> Back to Home </a></li>
                    <li><a href="Logout.php">Logout</a></li>
                </ul>              
</div>   
</body>
</html>