<?php
session_start();
require_once("../require.php");
$db = new Baza();
$db->connect();
if (!login()) {
    echo "Morate biti ulogovani da brisali korisnike";
    exit();
}
if (isset($_POST['idRoditelja'])) {
    $id = $_POST['idRoditelja'];
    $da = 1;
    $sql = "UPDATE korisnici SET obrisan= $da WHERE id='{$id}'";
    $db->query($sql);
    if ($db->error()) echo $db->error();
    else echo "Uspešno ste izbrisali korisnika";
} else
    echo "Doslo je do greske.Pokušajte ponovo";
