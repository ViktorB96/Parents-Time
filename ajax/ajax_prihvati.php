<?php
session_start();
require_once("../require.php");
$db = new Baza();
$db->connect();
if (!login()) {
    echo "Morate biti ulogovani da biste prihvatili zahtev";
    exit();
}
if (isset($_POST['idZahteva'])) {
    $id = $_POST['idZahteva'];
    $da = "prihvaćen";
    $sql = "UPDATE zahtev SET stanje='{$da}' WHERE id='{$id}'";
    $db->query($sql);
    if ($db->error()) echo $db->error();
    else echo "Uspešno ste prihvatili ovaj zahtev";
} else
    echo "Doslo je do greske.Pokušajte ponovo";
