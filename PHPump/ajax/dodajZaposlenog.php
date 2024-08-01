<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    require_once("../config.php"); 
    require_once("../models/zaposleni.php");

    $zaposleniObj = new Zaposleni($conn); 
    $zaposleniObj->user_name = $_POST['user_name'];
    $zaposleniObj->password = $_POST['password'];
    $zaposleniObj->zanimanje = $_POST['zanimanje'];

    if ($zaposleniObj->dodajZaposlenog()) {
        echo json_encode(array("message" => "Zaposleni uspešno dodat."));
    } else {
        echo json_encode(array("message" => "Greška pri dodavanju zaposlenog."));
    }
} else {
    echo json_encode(array("message" => "Unauthorized"));
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
