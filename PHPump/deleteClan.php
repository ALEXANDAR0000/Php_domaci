<?php 
include_once("config.php");

if( isset($_GET["id"])){
$id=$_GET["id"];

$sql="DELETE FROM clanovi WHERE id='$id'";
$conn->query($sql);
}
header("Location: clanoviCRUD.php");
exit;
?>