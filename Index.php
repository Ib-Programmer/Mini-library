<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Indexstyle.css"> 
<title>Home</title>
</head>
<body>
    <?php
      include 'Header.php';
      $empty_responce =$success_responce = "";
      $empty_email = $success_email = "";
          if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
            require 'Connection.php';
            $time = $respond = $date = "";
            function validate_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                $data = filter_var($data,FILTER_SANITIZE_STRING);
                return $data;
              }
              $stmt = $connection->prepare("INSERT INTO responses(Respond,Reg_time,Reg_date)
               VALUES (?,?,?)");
              $stmt->bind_param("sss", $respond, $time, $date);
            if(isset($_POST['res'])){
                $date = date("d/m/Y");
                $time = date("h:i:sa"); 
                $respond =  validate_input($_POST['usermessage']);
                if(empty($respond)){
                  $empty_responce = "Fill the responce form please ";
                }
                else{
                  $stmt->execute();
                  $success_responce = "Your responce was successfully submitted";
                }
           }
           $stmt->close();
         
    $connection->close();
  }
    ?>


    <div class="slideshow-container">
        <div class="mySlides fade">
           <img src="\www.librarymanagement.com\Images\Image2.jpg">
        </div>
        <div class="mySlides fade">
           <img src="\www.librarymanagement.com\Images\Image3.jpg">
         </div>
        <div class="mySlides fade">
           <img src="\www.librarymanagement.com\Images\Image4.jpg">
        </div>
        </div>
        <div class="Introduction">
          <p>
           <strong id="welcome"> Welcome</strong> to online  mini library  web application.The web application was design tackle the problems of manual
            library system, which lead to alot of problems to  students and teachers in various institutions  
              respectively . We offer various library  services <a href="#Services">check our services to see more.</a> 
          </p>
        </div>
        
        <form class="responseform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <label for="Response">Please send us your response</label><br>
          <?php  echo "<span class='Errormessage'>".$empty_responce."</span>"."<br>"; 
               echo "<span class='success'>".$success_responce."</span>"."<br>";
           ?>
          <textarea name="usermessage" placeholder="Type your response here" class="message" rows="15" cols="40"></textarea><br>
          <input type="submit" id="btn" value="Submit" name="res">
        </form>
        <script src="\www.librarymanagement.com\Javascript\Indexscript.js"></script> 
        <?php include 'Footer.php';?> 
</body>
</html>