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
    <h2>Odgovori na poruku</h2><br><br>
    <form action="odgovor.php?id=<?= $_GET['id']; ?>" method="POST">
        <textarea name="odgovor" id="odgovor" cols="30" rows="10" placeholder="Unesite odgovor"></textarea><br><br>
        <button class="but" name="posalji">Odgovori</button>
    </form><br>
    <?php
    if (isset($_POST['posalji'])) {
        $id = $_GET['id'];
        $id_B = $_SESSION['id'];
        $odgovor = $_POST['odgovor'];
        if ($odgovor != "" and $id_B != "") {
            $upit = "UPDATE chat SET odgovor='{$odgovor}' WHERE id='{$id}'";
            $db->query($upit);
            if ($db->error()) {
                echo "GREŠKA!!!!<br>" . $db->error();
            } else {
                echo "Uspešno snimljeno odgovor";
            }
        } else echo "Svi podaci su obavezni!!!";
    }
    ?>



</section>


<?php
require("_footer.php");
?>