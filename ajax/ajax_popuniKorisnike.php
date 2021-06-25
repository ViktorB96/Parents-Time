<?php
session_start();
require_once("../require.php");
$db = new Baza();
$db->connect();


$sql = "SELECT * FROM korisnici WHERE id={$_SESSION['id']}";
$rez = $db->query($sql);
$sve = $db->fetch_all($rez);
$json = JSON_encode($sve, 256);
