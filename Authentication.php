<?php
session_start();
if(!isset($_SESSION["Name"])){
    header("Location: \Schoolsystem\Phpfiles\Login.php");
    exit();
}
?>