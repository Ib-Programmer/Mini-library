<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Viewresponsestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<title>Me</title>
</head>
<body>
<?php
 require 'Authentication.php'; 
 require 'Connection.php'; 
 $username = $_SESSION["Name"];
 $id = $regnumber = $name = $email = $phonenumber = $password = $privilege = "";
 $sql = "SELECT * FROM users WHERE Name = '$username' ";
 $result = $connection->query($sql);
 if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){
        $id = $row["Id"];
        $regnumber = $row['Regnum'];
        $name = $row["Name"];
        $email=$row["Email"];
        $phonenumber = $row["Phonenumber"];
       $password = $row["Password"];
       $privilege = $row["Privilege"];
    } 
 }
   $msgerror = $msgsuccess = ""; 
   if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $id =$regnumber =  $name = $email = $phonenumber = $password = $privilege = "";
      function validate_input($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
        return $data;
       }
      $id =  validate_input($_POST['id']);
      $regnumber =  validate_input($_POST['regnumber']);
      $name =  validate_input($_POST['name']);
      $email =  validate_input($_POST['email']);
      $phonenumber =  validate_input($_POST['phonenumber']);
      $privilege =   "Student";
      if(empty($_POST['password'])){
         // the user didn't  change the password 
         // prepared statement if the password is not updated for updating the data in the database.
         $sql = $connection->prepare("UPDATE users SET Regnum = ?, Name = ?, Email = ?,Phonenumber = ?,
         Privilege = ? WHERE Id = ? ");
        //binding the prepered statement
        $sql->bind_param('ssssss',$regnumber,$name,$email,$phonenumber,$privilege,$id);   
      }
      else{
         $password = validate_input($_POST['password']);
         $password = password_hash($password,PASSWORD_DEFAULT);   
         // prepared statement for updating the data in the database.
         $sql = $connection->prepare("UPDATE users SET Regnum = ?,Name = ?,Email = ?,Phonenumber = ?,
         Password = ?,Privilege = ? WHERE Id = ? ");
        //binding the prepered statement
        $sql->bind_param('sssssss',$regnumber,$name,$email,$phonenumber,$password,$privilege,$id);
      }
      if(empty($id) || empty($regnumber) || empty($name) || empty($email) || empty($phonenumber) || empty($privilege)){
            $msgerror = "Update the form please some fields are empty.";
     }
    else{
         $sql->execute();
         if( $sql->execute() === TRUE) {
             $msgsuccess = "Successfully Updated";
         }
        else{
             $msgerror = "<br>"."Error occurred in updating ";
        } 
      }
   }
?>
   <h2 style ="margin-top:3%;">Update Your Information </h2>
 <form class="updateuser" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
     echo "<span class='Errormessage'>".$msgerror."</span>"."<br>";
     echo "<span class='message'>".$msgsuccess."</span>";
    ?>
   <input type="hidden" name="id" value="<?php echo $id; ?>"><br>
   <label>Reg Number</label><br>
    <input type="text" class="input_field"  name="regnumber" value="<?php echo $regnumber; ?>"><br>
    <label>Name</label><br>
    <input type="text" class="input_field"  name="name" value="<?php echo $name; ?>"><br>
   
   <label>Email</label><br>
   <input type="text" class="input_field" name="email" value="<?php echo $email; ?>"><br>
   
   <label>Phone Number</label><br>
   <input type="text" class="input_field" name="phonenumber" value="<?php echo $phonenumber; ?>"><br>
   
   <label>Password</label><br>
   <input type="password" class="input_field" name="password" placeholder="Type new password if you want to change it"><br>
   
   <p>
   <input type="submit" class="btn btn-primary" name="update" value="Update"><br>
    <a href="Studentdashboard.php" class="btn btn-primary">< Back</a>
    </form>
    <p>
    

</body>
</html>