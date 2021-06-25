<?php
session_start();
require_once("../require.php");
$db = new Baza();
$db->connect();
if(isset($_POST['act'])){
    $id_korisnika=$_SESSION['id'];
    $ip = $_SERVER["REMOTE_ADDR"];
    $therate = $_POST['rate'];
    $thepost = $_POST['id_dadilje'];
    $upit="SELECT * FROM star where ip= '$ip' AND id_dadilje= '$thepost' AND id_korisnika= '$id_korisnika' ";
    $red=$db->query($upit);
    while($data = $db->fetch_assoc($red)){
        $rate_db[] = $data;
    }

    if(@count($rate_db) == 0 ){
        $upit="INSERT INTO star (id_dadilje, ip, rate,id_korisnika)VALUES('$thepost', '$ip', '$therate','$id_korisnika')";
        $db->query($upit);
    }else{
        $upit="UPDATE star SET rate= '$therate' WHERE ip = '$ip' AND id_dadilje= '$thepost' AND id_korisnika= '$id_korisnika' ";
        $db->query($upit);
    }
} 
