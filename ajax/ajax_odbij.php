<?php
session_start();
require_once("../require.php");
$db = new Baza();
$db->connect();
if (!login()) {
    echo "Morate biti ulogovani da biste prihvatili zahtev";
    exit();
}
if (isset($_POST['idKorisnika'])) {
    $id = $_POST['idKorisnika'];
    $ne = "odbijen";
    $sql = "UPDATE zahtev SET stanje='{$ne}' WHERE id='{$id}'";
    $db->query($sql);
    if ($db->error()) echo $db->error();
    else echo "Uspešno ste odbili ovaj zahtev";
} else
    echo "Doslo je do greske.Pokušajte ponovo";
