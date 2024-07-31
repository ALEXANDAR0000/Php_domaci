<?php 
include_once("config.php");

if( isset($_GET["id"])){
$id=$_GET["id"];

$sql="DELETE FROM clanarine WHERE id='$id'";
$conn->query($sql);
}
header("Location: clanarineCRUD.php");
exit;
?>