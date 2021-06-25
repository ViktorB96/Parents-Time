<?php
session_start();
require_once("../require.php");
$db = new Baza();
$db->connect();
if (!login()) {
    echo "Morate biti ulogovani da brisali korisnike";
    exit();
}
if (isset($_POST['idZahteva'])) {
    $id = $_POST['idZahteva'];
    $sql = "DELETE FROM zahtev WHERE id='{$id}'";
    $db->query($sql);
    if ($db->error()) echo $db->error();
    else echo "Uspešno ste izbrisali zahtev za cuvanje";
} else
    echo "Doslo je do greske.Pokušajte ponovo";
