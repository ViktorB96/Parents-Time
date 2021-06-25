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
        <h1>Komentari</h1>
        <?php
        //Dozvola ili brisanje komentara
        if (isset($_GET['id']) and isset($_GET['funkcija'])) {
            $id = $_GET['id'];
            $funkcija = $_GET['funkcija'];
            if ($funkcija == "dozvoli") $upit = "UPDATE komentari SET odobren=1 WHERE id={$id}";
            else $upit = "DELETE FROM komentari WHERE id={$id}";
            $db->query($upit);
            if ($db->error()) echo "GREŠKA!!!!<br>" . $db->error();
            else echo "Uspešna izmena<br>";
        }
        ?>
        <?php
        //Prikaz svih neodobrenih komentara
        $upit = "SELECT * FROM komentari WHERE odobren=0 order by vreme DESC";
        $rez = $db->query($upit);
        if ($db->num_rows($rez) != 0) {
            while ($red = $db->fetch_object($rez)) {
                echo "<div>";
                echo "$red->vreme<br>";
                echo "$red->ime<br>";
                echo "$red->komentar<br>";
                echo "<a href='adminKomentari.php?id=$red->id&funkcija=dozvoli'>Dozvoli</a> | ";
                echo "<a href='adminKomentari.php?id=$red->id&funkcija=obrisi'>Obriši</a>";
                echo "</div><br><br>";
            }
        } else
            echo "Nemate nijedan neodobren komentar";
        ?>

    </div>

    <?php
    //Priključivanje desnog dela
    //include("_sidebar.php");
    ?>

    </main>
    </div>
</section>


<?php
require("_footer.php");
?>