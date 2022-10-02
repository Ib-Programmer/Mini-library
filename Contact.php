
<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Contactstyle.css"> 
<title>Contact US </title>
</head>
<body>
<?php include 'Header.php';
$error_empty = $success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        include 'Connection.php';
        function validate_input($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
       $name = $email = $subject = $message = "";
       $stmt = $connection->prepare("INSERT INTO suggestions(Name,
       Email,Subject,Message)
       VALUES (?,?,?,?)");
       if(isset($_POST['contact'])){
         $name =  validate_input($_POST['name']);
         $email =  validate_input($_POST['email']);
         $subject =  validate_input($_POST['subject']);
         $message =  validate_input($_POST['message']);
         $stmt->bind_param("ssss", $name, $email, $subject,$message);
         if(empty($name) || empty($email) || empty($subject) || empty($message)){
            $error_empty = "Fill in the form please some fields are empty";
         }else{
         $stmt->execute();
         $success = "Message Send Successfully";  
         }
       }
}
?>  
<form  class="Contactus" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <h1>Contact Us </h1>
   <?php  echo "<span class='Errormessage'>".$error_empty."</span>"."<br>"; 
      echo "<span class='message'>".$success."</span>"."<br>";
   ?>
   <label>Name</label><br>
   <input type="text" class="input_field"  name="name"/><br>
   <label>Email</label><br>
   <input type="text" class="input_field"  name="email"/><br>
   <label>Subject</label><br>
   <input type="text" class="input_field"  name="subject"/><br>
   <label>Message</label><br>
   <textarea name="message" placeholder="Type your message here" class="message" rows="15" cols="40"></textarea><br>
   <input type="submit" class="btn" name="contact" value="Submit"/><br>
   <label>Email :</label><a href ="mailto:ibmuhd557@gmail.com"><label>ibmuhd557@gmail.com</label></a><br>
   <label>Phone Number : +234 8108101246</label><br>
   <label>Address : Bayero  University, kano<br>
   Faculty of Computing<br>
   Department Of  Computer Science</label><br>
   <a href="Index.php"><input type="button" class="btn" value="Back"/></a>
</form>
<?php include 'Footer.php'?>
</body>
</html>