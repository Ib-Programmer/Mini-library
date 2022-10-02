
<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\loginstyle.css"> 
<title>LOGIN</title>
</head>
<body>
<?php 
$error_empty = $wrong_username_pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require 'Connection.php';
  $password =  $username = "";
  function validate_input($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = filter_var($data,FILTER_SANITIZE_STRING);
      return $data;
    }
    $username = validate_input($_POST["username"]);
    $password = validate_input($_POST["password"]);
    if(empty($username) || empty($password)){
     $error_empty  =  "Please fill the form password or username is empty .";
    }
    else{
        $sql = "SELECT Regnum,Name,Email,Phonenumber,Password,Privilege FROM users WHERE Regnum = '$username' || Email =  '$username' ";
        $result = $connection->query($sql);
        $user = $result->fetch_assoc();
        if($result->num_rows > 0){ 
             if(password_verify($password, $user['Password'])){
                session_start();
                $_SESSION["Name"] = $user['Name'];
                if($user['Privilege'] === "Admin"){
                   header("Location: Superdashboard.php");
               }
               else if ($user['Privilege'] === "Student"){
                  header("Location: Studentdashboard.php");
               }
               else{
                  header("Location :Login.php");
               }  
        }
       }
       else{
         $wrong_username_pass  = "Wronged Username and Password ";
        }
      
    }   
  $connection->close();
}

?>
<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<img src="\www.librarymanagement.com\Images\Login.jpg" id="logo">
<div class="Login">
   <h1>LOGIN</h1>
   <label>Username</label><br>
   <input type="text" class="input_field"  name="username"/><p>
   <label>Password</label><br>
   <input type="password" class="input_field" name="password" max="10" /><br>
   <input type="submit" id="btnlogin" name="btnlogin" value="LOGIN"/><br>
   <?php  echo "<span class='Errormessage'>".$error_empty."</span>"."<br>"; 
      echo "<span class='Errormessage'>".$wrong_username_pass."</span>"."<br>";
   ?>
   <label id="question">If are not already registered user ? </label> 
   <a href="Register.php"> Please Signup an account with us . </a><br>
   <a href="Index.php"><input type="button" id="btnlogin" value="Back"/></a>
</div>
</form>
</body>
</html>