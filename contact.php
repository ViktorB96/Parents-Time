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


    <div class="wrapper">

        <main id="mainFull">

            <h1>Kontaktirajte nas</h1>

            <h4>Za sva pitanja, infomacije, kritike, pohvale i sugestije tu smo za vas 24-7!
                Pozovite nas ili nam pišite!
            </h4>

            <div class="contactInfo">
                <p><i class="fa fa-2x fa-phone"></i>061/ 108 00 04</p>
                <p><i class="fa fa-2x fa-envelope"></i>contact.parentstime@gmail.com</p> 
                <img src="images/srbija.png" alt="">       
        </div>
        </main>
        

    </div>
</section>

<?php
require("_footer.php");

?>