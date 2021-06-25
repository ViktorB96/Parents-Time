<?php
session_start();
require_once("require.php");
$db = new Baza();
$db->connect();
if (!login()) {
    die();
} else
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/galerije.js"></script>





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
$poruka = "";
?>
<section id="profil">
    <div class="wrapper">

        <h1>Galerije</h1>
        <h2>Unesite naziv galerije</h2>
        <input type="text" id="nazivGalerije" placeholder="Unesite naziv"><br><br>
        <input type="text" id="komentarGalerije" placeholder="Unesite komentar"><br><br>

        <button class="but" id="btnSnimiGaleriju">Snimite galeriju</button><br><br>
        <div id="odgovor"></div>

        <hr>

        <br><br>
        <form id="forma" action="" method="" enctype="multipart/form-data">
            <h2>Izaberite galeriju</h2>
            <select name="idGalerije" id="idGalerije" onchange="popuniSlike()"></select><br>
            <button class="but" id="obrisiGaleriju" type="button">Obriši galeriju</button><br><br>
            <label for="slika">
                <input type="file" id="slika" name="slika"><br><br>
            </label>
            <input type="text" id="komentarSlike" name="komentarSlike" placeholder="Unesite komentar"><br><br>
            <button class="but " type="button" id="btnSnimiSliku">Snimi sliku</button>
        </form>
        <hr>
        <div id="divPrikazSlika"></div>
    </div>
</section>


<?php
require("_footer.php");
?>