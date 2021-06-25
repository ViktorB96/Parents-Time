<?php
session_start();
require_once("require.php");

$db = new Baza();
$db->connect();
$poruka = "";

?>
<!doctype html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#e84e1b">
    <meta name="viewport" content="width=device-width">
    <title>Parents time</title>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="js/prijava.js"></script>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
        $(document).ready(function() {

            var respmenu = $('#respmenu');
            var menu = $('#nav>ul');

            $(respmenu).on('click', function(e) {
                e.preventDefault();
                menu.slideToggle();
            });

            $(window).resize(function() {
                var sirina = $(window).width();
                if (sirina > 768 && menu.is(':hidden')) {
                    menu.removeAttr('style');
                }
            });

        });
    </script>


</head>

<?php
require("_header.php");

?>

<section id="central">


    <h1>Postavite vase pitanje</h1>
    <form action="chat.php?id=<?= $_GET['id']; ?>" method="POST">
        <textarea name="pitanje" id="pitanje" cols="30" rows="10" placeholder="Unesite pitanje"></textarea><br><br>
        <button class="but" name="posalji">Pošaljite poruku</button>
    </form><br>
    <?php

    if (isset($_POST['posalji'])) {
        $id = $_GET['id'];
        $idPP = $_SESSION['id'];
        $imePP = $_SESSION['ime'];
        $pitanje = $_POST['pitanje'];
        if ($pitanje != "" and  $idPP != "" and $imePP != "") {
            $upit = "INSERT INTO chat (idPitanog,idPP,imePP,poruka) VALUES ('{$id}','{$idPP}','{$imePP}','{$pitanje}')";
            $db->query($upit);
            if ($db->error()) {
                echo "Doslo je do greske.<br>" . $db->error();
            } else {
                echo "Uspešno snimljeno pitanje";
            }
        } else echo "Svi podaci su obavezni!!!";
    }
    ?>



</section>

<?php
require("_footer.php");

?>