<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Viewresponsestyle.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title></title>
<style>
.text-center{
    margin-top:50px;
    margin-bottom:50px;
}
body{
    background-color: whitesmoke;
}
h1{
    font-weight: bolder;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    margin-top:70%;
    margin-bottom:50px; 
}
.card{
    margin-bottom:50px; 
    margin-top : 30px;
}
.card-text{
    font-weight : bold;
}
.form-control{
  margin-left:10%;
}
</style>
</head>
<body>
<?php 
require 'Connection.php';
require 'Authentication.php'; 
$searchresult =  "";
?>
<form class="search" method = "POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <div class="form-group">
      <div class="row"><h1>View Books</h1></div>
  <div class="row">
    <div class="col-4">
     <input type="text" class="form-control" name = "searchItem" placeholder="Search book by book name or book author or year of publication  and subject">
     </div>
     <div class="col-4">
     <button name="submit" class="btn btn-primary" >Search</button>
     </div>
     </div>
  </div>
</form>
<div class="row"> </div>
<?php
function validate_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = filter_var($data,FILTER_SANITIZE_STRING);
    return $data;
  }
if(isset($_POST["submit"])){
   $searchresult = validate_input($_POST["searchItem"]); 
   if(empty($searchresult)){
    echo "<br>"."<span class='Errormessage'>". "Error : You searched an empty item "."</span>"."<br>"; 
   }
   else{
  $query = "SELECT * FROM bookinformations  WHERE
   Booktitle  LIKE '%$searchresult%' || 
   Bookauthor LIKE '%$searchresult%' || 
   Yearofpub  LIKE '%$searchresult%' || 
   Subjectarea  LIKE '%$searchresult%'|| 
   Bookdisc LIKE '%$searchresult%' ";
   $answer = $connection->query($query);
   if($answer != TRUE){
    echo "<br>"."<span class='Errormessage'>"."Error : Query not executed"."</span>"."<br>"; 
   }
   else{
    if($answer->num_rows > 0){ 
        ?>
    <div class="container">
    <div class="row">
    <?php 
    while($row = $answer->fetch_assoc()){
        $path =  ['Bookpdf'];
?>

    <div class="col-lg-4 m-6 col-sm-12 col-md-12 ">
    <div class="card" style="width: 18rem;align:center" >
    <img class="card-img-top" style ="/*height:30%; width:30%;*/" src="<?php echo $row["Bookimage"] ?>" alt="book image">
    <div class="card-body">
        <h5 class="card-title">Book Name : <?php echo $row["Booktitle"];?></h5>
        <h5 class="card-title">Author : <?php echo $row["Bookauthor"];?> </h5>
        <h5 class="card-title">Year of Publication  :  <?php echo $row["Yearofpub"];?></h5>
        <h5 class="card-title">Area  :  <?php echo $row["Subjectarea"];?></h5>
        <p class="card-text">Book Info :<?php echo $row["Bookdisc"];?></p>
        <a href="<?php echo $row["Bookpdf"]; ?>" class="btn btn-primary">Read online</a>
        <a href="Downloadbook.php?file=<?php echo urlencode($path)?>" class="btn btn-primary">Download</a>
    </div>
    </div>
</div>
<?php }?>     
</div>
</div>
<?php
      }
     }
  }
}
   ?>
</body>
</html>


