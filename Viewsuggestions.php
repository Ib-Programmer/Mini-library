<!DOCTYPE HTML>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="\www.librarymanagement.com\Cssfiles\Viewresponsestyle.css">
<title>View Suggestions</title>
</head>
<body>
<?php
 require 'Connection.php';
 require 'Authentication.php';  
 include 'Searchsuggestion.php'; 
 $per_page_record = 5;
if(isset($_GET['page'])){
    $page = $_GET["page"];
}
else {
    $page = 1;
}
$start_from = ($page-1) * $per_page_record;
$sql = "SELECT * FROM suggestions LIMIT $start_from ,$per_page_record";
$result = $connection->query($sql);
?>
  <table class="space">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Delete</th>
    </tr>
  <?php  
if ($result->num_rows > 0){ 
while($row = $result->fetch_assoc()){
    ?>
    <tr><td>
   <?php echo $row["Id"]; ?>
    </td><td>
    <?php echo $row["Name"]; ?>
    </td><td>
   <?php echo $row["Email"]; ?>
    </td><td>
    <?php echo $row["Subject"]; ?>
    </td><td>
    <?php echo $row["Message"]; ?>
    </td><td>
    <a href="Delete.php?delsugest=<?php echo $row['Id'];?>" id="a_delete"><button id="btn_delete">Delete</button></a>
    </td></tr>
    <?php
      } 
    }
 $sql = "SELECT  COUNT(*) FROM  suggestions";
 $result = $connection->query($sql);
 $row = $result->fetch_row();
 $total_records = $row[0];
 ?>
 </table>
 <p>
<?php 
$total_pages = ceil($total_records/ $per_page_record); 
$pagelink = "";
echo "<div class='pagination'>";
if($page>=2){
  
    echo "<span class='page'><a href='Viewsuggestions.php?page=".($page-1)."'>Pre </a></span>";
}
for($i=1;$i<=$total_pages;$i++){
    if($i==$page){
        $pagelink .="<span class='page'><a  href='Viewsuggestions.php?page=".$i."'>".$i."</a></span>";
    }
    else{
        $pagelink .= "<span class='page'><a href='Viewsuggestions.php?page=".$i."'>".$i."</a></span>";
    }
  };
  echo $pagelink;
  if($page<$total_pages){
      echo "<span class='page'><a  href ='Viewsuggestions.php?page=".($page + 1)."'>Next </a></span>";
  }
  echo "</div>";
?> 
<p>
<input id="btn" class="pagenumber" type="number" min="1" max="<?php echo $total_pages; ?>" 
placeholder="<?php echo $page ."/". $total_pages;?>" required > 
<button  id="btn" onClick ="gotoPage();">Go</button>
<script>
function gotoPage(){
    var page = document.querySelector(".pagenumber").value;
    page = ((page > <?php echo $total_pages;?>) ? <?php echo $total_pages;?>:((page<1)?1:page));
    window.location.href='Viewsuggestions.php?page='+ page;
}
</script>
  <p>
<a href="Superdashboard.php"><button id="btn"><<< Back</button></a>
<?php
$connection->close();
?>
</body>
</html>