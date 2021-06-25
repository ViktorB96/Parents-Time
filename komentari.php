<?php
session_start();
require_once("require.php");
$db = new Baza();
$db->connect();
if (!login()) {
    echo "Morate biti ulogvani da bi komentarisali";
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
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/prijava.js"></script>






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
<section id="central">
    <div class="wrapper">

        <main id="mainFull">
            <h2>Napisite komentar</h2>
            <form action="komentari.php?id=<?= $_GET['id']; ?>" method="post" style='display:<?= $tip ?>'>
                <input type="text" name="ime" placeholder="Unesite ime" /><br><br>
                <textarea name="komentar" id="komentar" cols="30" rows="10" placeholder="Unesite komentar"></textarea><br><br>
                <button class="but">Snimite komentar</button>
            </form><br>
            <?php
            if (isset($_POST['ime']) and isset($_POST['komentar'])) {
                $ime = $_POST['ime'];
                $komentar = $_POST['komentar'];
                $idDadilje = $_GET['id'];
                if ($ime != "" and $komentar != "") {
                    $upit = "INSERT INTO komentari (idDadilje, ime, komentar) VALUES ({$idDadilje}, '{$ime}', '{$komentar}')";
                    $db->query($upit);
                    if ($db->error()) echo "Doslo je do greske!<br>" . $db->error();
                    else echo "Uspešno snimljen komentar. Postaće vidljiv kad ga Administrator odobri";
                } else echo "Svi podaci su obavezni!!!!";
            }
            ?>









        </main>
    </div>
</section>


<?php
require("_footer.php");
?>