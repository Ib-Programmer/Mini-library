<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>View Books</title>
<style>
.text-center{
    margin-top:50px;
    margin-bottom:50px;
}
body{
    background-color: whitesmoke;
}
.card{
    margin-bottom:50px; 
}
.card-text{
    font-weight : bold;
}
</style>
</head>
<body>
<?php 
require 'Connection.php';
$sql = "SELECT * FROM bookinformations";
$result = $connection->query($sql);
?>

<?php
include 'Searchbookstudent.php';
if($result->num_rows > 0){
    ?>
    <div class="container">
    <div class="row">
    <?php 
    while($row = $result->fetch_assoc()){
        $path = $row['Bookpdf'];
?>

    <div class="col-lg-4 m-6 col-sm-12 col-md-12 ">
    <div class="card" style="width: 18rem;align:center" >
    <img class="card-img-top" style ="/*height:30%; width:30%;*/" src="<?php echo $row["Bookimage"] ?>" alt="book image">
    <div class="card-body">
        <h5 class="card-title">Book Name : <?php echo $row["Booktitle"]?></h5>
        <h5 class="card-title">Author : <?php echo $row["Bookauthor"]?> </h5>
        <h5 class="card-title">Year of Publication  :  <?php echo $row["Yearofpub"]?></h5>
        <h5 class="card-title">Area  :  <?php echo $row["Subjectarea"]?></h5>
        <p class="card-text">Book Info :<?php echo $row["Bookdisc"]?></p>
        <a href="<?php echo $row["Bookpdf"]; ?>" class="btn btn-primary">Read online</a>
        <a href="Downloadbook.php?file=<?php echo urlencode($path)?>" class="btn btn-primary">Download</a>
    </div>
    </div>
</div>
<?php }?>     
</div>
<a href="Studentdashboard.php" class="btn btn-primary">Back </a>
</div>

<?php        
   }
   else {
       ?>
    <a href="Studentdashboard.php" class="btn btn-primary">Back </a>
  <?php }
$connection->close();
?>
</body>
</html>