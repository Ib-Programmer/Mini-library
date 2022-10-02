<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Viewresponsestyle.css">
<title></title>
</head>
<body>
<?php 
require 'Connection.php';
require 'Authentication.php'; 
$searchresult =  "";
?>
<h1>View Users Response</h1>
<form class="search" method = "POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <input class="searchbox" name = "searchItem" type="text"  placeholder="Search responses"> 
  <input type="submit"  id="btn" name="searchbtn" value="Search">
</form>
<div class="space">
</div>
<?php
 function validate_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = filter_var($data,FILTER_SANITIZE_STRING);
  return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
   $searchresult = validate_input($_POST["searchItem"]); 
   if(empty($searchresult)){
    echo "<br>"."<span class='Errormessage'>". "Error : You searched an empty item "."</span>"."<br>"; 
   }
   else{
  $query = "SELECT * FROM responses WHERE Respond LIKE '%$searchresult%' ";
   $answer = $connection->query($query);
   if($answer != TRUE){
    echo "<br>"."<span class='Errormessage'>"."Error : Query not executed"."</span>"."<br>"; 
   }
   else{
    if($answer->num_rows > 0){ 
   ?>
</form>
<table>
  <tr>
      <th>ID</th>
      <th>Response</th>
      <th>Time</th>
      <th>Date</th>
      <th>Delete</th>
  </tr>
  <?php 
  while($row = $answer->fetch_assoc()){
    ?>
 <tr><td>
   <?php  echo  $row["Id"]; ?>
    </td><td>
    <?php  echo $row["Respond"]; ?>
    </td><td>
    <?php echo $row["Reg_time"]; ?>
    </td><td>
   <?php  echo $row["Reg_date"]; ?>
    </td><td>
   <a href="Delete.php?delres=<?php echo $row['Id'];?>" id="a_delete"><button id="btn_delete">Delete</button></a>
    </td></tr><br>
  <?php 
   }
   echo "</table>";
} 
else{
  echo "<br>"."<span class='message'>"."No such result found   ".$searchresult."</span>"."<br>"; 
   }
  }
 }
}
?>
</body>
</html>