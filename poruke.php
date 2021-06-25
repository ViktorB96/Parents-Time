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
    <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/parentprijava.js"></script>




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
    <h2>Vase poruke</h2><br><br>

    <?php
    $upit = "SELECT * FROM chat WHERE idPitanog={$_SESSION['id']}";
    $rez = $db->query($upit);
    $red = $db->num_rows($rez);
    echo "<img src='images/portfolio.png'> Broj poruka :" . $red . "<br><br>";
    while ($red = $db->fetch_object($rez)) {
        echo "<div class='dadilja'>";
        echo "<div style='display: inline-block'>";
        echo "<p>Pitanje od: $red->imePP</p>";
        echo "<p>Pitanje je:<br>$red->poruka</p>";
        echo "<p>Pitanje postavljeno:<br>$red->date</p>";
        if ($red->odgovor == "") {
            echo "<p>Niste odgovorili na ovo pitanje!</p>";
        } else {
            echo "<p>Odgovor: $red->odgovor</p>";
        }
        echo "<a href='odgovor.php?id=$red->id'><button class='but'> Odgovori na pitanje </button></a>";
        echo "</div>";
        echo "</div>";
    }
    ?>



</section>


<?php
require("_footer.php");
?>