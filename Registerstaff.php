<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Registerstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<title>Register Staff</title>
</head>
<body>
<?php
require 'Authentication.php'; 
//variables contain error message.
$empty_admin = $success_admin = "";
$empty_school = $success_school = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        include 'Connection.php';
        //function to verify input from user 
        function validate_input($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
       $name = $email = $phonenumber = $password = "";
       $privilege = 'Admin';
       $stmt = $connection->prepare("INSERT INTO users(Name,
       Email, Phonenumber, Password, Privilege)
       VALUES (?,?,?,?,?)");
      if(isset($_POST['btnadminregister'])){
            $name =  validate_input($_POST['name']);
            $email =  validate_input($_POST['email']);
            $phonenumber =  validate_input($_POST['phonenumber']);
           $password =  validate_input($_POST['password']);
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $stmt->bind_param("sssss",$name, $email, $phonenumber,$hash,$privilege);
            if(empty($name) || empty($email) || empty($phonenumber) || empty($password) ){
               $empty_admin = "Fill in the form please some fields are empty";
            }else{
              $stmt->execute();
              $success_admin = "You are Successfully Registered ";  
            }
      }
   
}
   ?>
<form class="register" id="adminregister"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <h1> Staff Information</h1>
   <h2>Fill the below form</h2>
     <?php  echo "<span class='Errormessage'>".$empty_admin."</span>"."<br>"; 
      echo "<span class='message'>".$success_admin."</span>"."<br>";
   ?>
   <label>Name </label><br>
   <input type="text" class="input_field"  name="name"><br>

    <label>Email</label><br>
    <input type="text" class="input_field" name="email"><br>

     <label>Phone Number</label><br>
     <input type="text" class="input_field" name="phonenumber"><br>

     <label>Password</label><br>
     <input type="password" class="input_field" name="password"><br>

     <input type="submit"  id="btnadminreg"  class="btn btn-primary" name="btnadminregister" value="Signup"><br>
       <a href="Superdashboard.php"  class="btn btn-primary">< Back </a>
</form>

</body>
</html>  
