<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    require_once("../config.php"); 
    require_once("../models/zaposleni.php");

    $zaposleniObj = new Zaposleni($conn); 
    $result = $zaposleniObj->sviZaposleni();

    $zaposleni = array();
    while ($row = $result->fetch_assoc()) {
        $zaposleni[] = $row;
    }

    echo json_encode($zaposleni);
} else {
    echo json_encode(array("message" => "Unauthorized"));
}
?>
