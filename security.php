<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$id = $_SESSION["id"];
include_once("db.php");
$query="select * from users where id='$id'";
$myqry=mysqli_query($conn, $query);
$counter=mysqli_num_rows($myqry);
if(($counter != 1) || (!isset($id))){
	header("location:login.php");
}
?>