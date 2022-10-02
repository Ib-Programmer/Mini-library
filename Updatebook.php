<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Registerstyle.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<title>Upload Book</title>
</head>
<body>
<?php 
require 'Connection.php';
require 'Authentication.php';
$error = $success = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM bookinformations  WHERE Id = $id ";
    $result = $connection->query($sql);
    if($result->num_rows > 0){ 
       while($row = $result->fetch_assoc()){
           $id = $row["Id"];
           $booktitle = $row["Booktitle"];
           $bookauthor = $row["Bookauthor"];
           $bookyear = $row["Yearofpub"];
           $booksubarea = $row["Subjectarea"];
          $bookdisc = $row["Bookdisc"];
          $bookimagepath = $row["Bookimage"];
          $bookpdfpath = $row["Bookpdf"];
       } 
    }
  } 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        //function to verify input from user 
        function validate_input($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
        if ($_FILES["pdfimage"]["size"] != 0  &&  $_FILES["pdfdocument"]["size"] != 0 ) {
         $image_dir = "Bookimages/";
         $pdf_dir = "Bookpdf/";
         $bookimage_file = $image_dir . basename($_FILES["pdfimage"]["name"]);
         $bookpdf_file = $pdf_dir . basename($_FILES["pdfdocument"]["name"]);
         $uploadOk = 1;
         $bookimageFileType = strtolower(pathinfo($bookimage_file,PATHINFO_EXTENSION));
         $bookpdfFileType = strtolower(pathinfo($bookpdf_file,PATHINFO_EXTENSION));
       // checking fake image or pdf 
       $pdffilename = $_FILES["pdfdocument"]["tmp_name"];
       $imagefilename = $_FILES["pdfimage"]["tmp_name"];
       $pdfsize = filesize($pdffilename);
       $imagesize = filesize($imagefilename);
       if($imagesize >0  && $pdfsize>0) {
         $uploadOk = 1;
       } else {
         $uploadOk = 0;
       }
        // Check if file already exists
     if(file_exists($bookimage_file) && file_exists($bookpdf_file)) {
      $error = "Sorry, file already exists.  ";
      $uploadOk = 0;
     }
      // Check file size
    if(($_FILES["pdfimage"]["size"] > 625000) && ($_FILES["pdfdocument"]["size"] > 3000000 )) {
      $error = $error."Sorry, your file is too large.  ";
      $uploadOk = 0;
     }
     // checking the file type 
     if($bookimageFileType != "jpg" && $bookimageFileType != "png" && $bookimageFileType != "jpeg"
     && $bookimageFileType != "gif" && $bookpdfFileType != "pdf") {
      $error = $error."Sorry, only JPG, JPEG, PNG & GIF  and pdf files  are allowed.   ";
       $uploadOk = 0;
     }
     // variables for the form fiedls 
    $id =  $booktitle = $bookauthor =  $bookyear = $booksubarea = $bookdisc  =  $bookimagepath = $bookpdfpath = "";

     $sql = $connection->prepare("UPDATE  bookinformations SET Booktitle = ?,Bookauthor=?,
     Yearofpub= ?,Subjectarea = ?,Bookdisc = ?,Bookimage = ?,Bookpdf = ?    WHERE Id = ?");
          $id = validate_input($_POST['id']);
          $booktitle =  validate_input($_POST['booktitle']);
          $bookauthor =  validate_input($_POST['bookauthor']);
          $bookyear =  validate_input($_POST['yearofpublication']);
          $booksubarea =  validate_input($_POST['subjectarea']);
          $bookdisc  =  validate_input($_POST['bookdiscription']);
          $bookimagepath =  $bookimage_file;
          $bookpdfpath =   $bookpdf_file;

          $sql->bind_param("ssssssss",$booktitle,$bookauthor,$bookyear,$booksubarea,$bookdisc,$bookimagepath,$bookpdfpath,$id);
          if(empty($booktitle) || empty($bookauthor) || empty($bookyear) || empty($booksubarea) || empty($bookdisc) || empty($id)){
            $error = $error."Fill in the form please some fields are empty  ";
         }else{
            if($uploadOk == 0){
               $error = $error."Sorry,your file was not uploaded.  "; 
            }
            else{
              if( move_uploaded_file($_FILES["pdfimage"]["tmp_name"], $bookimage_file) &&
                move_uploaded_file($_FILES["pdfdocument"]["tmp_name"], $bookpdf_file)){
                  $sql->execute();
                  $success = "Book was  Successfully Updated";  
                } else {
                  $error = $error."Sorry, there was an error upldating  the  book.   ";
                }
               
                
            }
         }
   }
   else{
    $id =  $booktitle = $bookauthor =  $bookyear = $booksubarea = $bookdisc  =  $bookimagepath = $bookpdfpath = "";

    $sql = $connection->prepare("UPDATE  bookinformations SET Booktitle = ?,Bookauthor=?,
    Yearofpub= ?,Subjectarea = ?,Bookdisc = ?,Bookimage = ?,Bookpdf = ? WHERE Id = ?");
         $id = validate_input($_POST['id']);
         $booktitle =  validate_input($_POST['booktitle']);
         $bookauthor =  validate_input($_POST['bookauthor']);
         $bookyear =  validate_input($_POST['yearofpublication']);
         $booksubarea =  validate_input($_POST['subjectarea']);
         $bookdisc  =  validate_input($_POST['bookdiscription']);
         $bookimagepath =  validate_input($_POST['bookimage']);
         $bookpdfpath =   validate_input($_POST['bookpdf']);

         $sql->bind_param("ssssssss",$booktitle,$bookauthor,$bookyear,$booksubarea,$bookdisc,$bookimagepath,$bookpdfpath,$id);
         if(empty($booktitle) || empty($bookauthor) || empty($bookyear) || empty($booksubarea) || empty($bookdisc) || empty($id) || empty ($bookimagepath) || empty($bookpdfpath)){
           $error = $error."Fill in the form please some fields are empty  ";
        } else{
            $sql->execute();
            $success = "Book was  Successfully Updated";
             if( $sql->execute() === TRUE){
               $success = "Book was  Successfully Updated";
             }
             else{
                $error = "Query not executed".$connection->error;
             }
          }
   }
}
   ?>

<form class="register" id="adminregister"  method="post"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <h1>Book Information</h1>
   <h2>Fill the below form</h2>
     <?php  echo "<span class='Errormessage'>".$error."</span>"."<br>"; 
      echo "<span class='message'>".$success."</span>"."<br>";
   ?>

    <label>Book Title  </label><br>
   <input type="text" class="input_field"  name="booktitle" value = "<?php echo  $booktitle; ?>"><br>

   <label>Book Author  </label><br>
   <input type="text" class="input_field"  name="bookauthor" value = "<?php echo  $bookauthor; ?>"><br>

    <label>Year of Publication</label><br>
    <input type="text" class="input_field" name="yearofpublication" value = "<?php echo  $bookyear; ?>"><br>

     <label>Subject Area </label><br>
     <input type="text" class="input_field" name="subjectarea" value = "<?php echo  $booksubarea; ?>"><br>

     <label>Book Discription</label><br>
     <input type="text" class="input_field" name="bookdiscription" value = "<?php echo  $bookdisc; ?>"><br>

     <label>Select Book image to upload: </label><br>
    <input type="file" name="pdfimage" id="pdfimage"><br>

    <label>Select Book to upload: </label><br>
    <input type="file" name="pdfdocument" id="pdfdocument"><br>
    <input type="hidden" name="id" value = "<?php echo  $id; ?>">
    <input type="hidden" name="bookimage" value = "<?php echo  $bookimagepath; ?>">
    <input type="hidden" name="bookpdf" value = "<?php echo  $bookpdfpath; ?>">
     <input type="submit"   class="btn btn-primary" name="btnadminregister" value="Update"><br>
     <a href="Viewbooks.php" class= "btn btn-primary"> < Back </a>
</form>
</body>
</html>