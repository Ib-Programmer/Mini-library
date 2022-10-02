<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="\Schoolsystem\SuperAdmin\Css\Viewresponsestyle.css"> 
<title></title>
</head>
<body>
<?php 
require 'Connection.php';
$searchresult =  "";
?>
<h1>View Users Suggestions</h1>
<form class="search" method = "POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <input class="searchbox" name = "searchItem" type="text"  placeholder="Search user message"> 
  <input type="submit"  id="btn" name="searchbtn" value="Search">
</form>
<p>
<div class="space"></div>
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
    echo "<p>";
 }
   else{
  $query = "SELECT * FROM suggestions WHERE Message LIKE '%$searchresult%' ";
   $answer = $connection->query($query);
   if($answer != TRUE){
    echo "<br>"."<span class='Errormessage'>"."Error : Query not executed"."</span>"."<br>"; 
    echo "<p>";
   }
   else{
    if($answer->num_rows > 0){ 
   ?>
</form>
<table>
  <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Subject</th>
      <th>Message</th>
      <th>Delete</th>
  </tr>
  <?php 
  while($row = $answer->fetch_assoc()){
    ?>
 <tr><td>
   <?php  echo  $row["Id"]; ?>
    </td><td>
    <?php echo $row["Name"]; ?>
    </td><td>
   <?php  echo $row["Email"]; ?>
    </td><td>
    <?php  echo $row["Subject"]; ?>
    </td><td>
    <?php  echo $row["Message"]; ?>
    </td><td>
   <a href="Delete.php?delsugest=<?php echo $row['Id'];?>" id="a_delete"><button id="btn_delete">Delete</button></a>
    </td></tr><br>
  <?php 
   }
   echo "</table>"."<br>";
} 
else{
  echo "<br>"."<span class='message'>"."No such result found   ".$searchresult."</span>"."<br>"; 
  echo "<p>";
  }
  }
 }
}
?>
<p>
</body>
</html>