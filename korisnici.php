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
    <script src="js/delete.js"></script>
    <script src="js/pDelete.js"></script>




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

        <main id="mainFull">
            <div id='main'>
                <h1>Izbrisite dadilju</h1>
                <?php
                $upit = "SELECT * FROM korisnici WHERE obrisan=0 AND status='Dadilja'";
                $rez = $db->query($upit);
                echo "<h3>Broj dadilja: " . $db->num_rows($rez) . "</h3><br><br>";
                while ($red = $db->fetch_object($rez)) {
                    $id = $red->id;
                    echo "<div class='dadilja'>";
                    echo "<div style='display: inline-block; vertical-align: top; margin-right: 5px;'><img src='" . ((file_exists("avatari/$red->id.jpg")) ? "avatari/$red->id.jpg" : "avatari/noimage.jpg") . "' width='150px' alt='Nema slike'></div>";
                    echo "<div style='display: inline-block'>";
                    echo "<a href=profil.php?id=$red->id <p class='bold'>$red->ime $red->prezime</p></a>";
                    echo "<p>Rodjen sam : $red->godRodj.</p>";
                    echo "<p>Grad u kome zelim da radim je $red->grad.</p>";
                    echo "<p>$red->osebi</p>";
                    echo "</div>";
                    echo "<button class='but' name='izbrisi' id='izbrisi' onclick='izbrisi($id)' > Izbrisi korisnika</button></a>";
                    echo "</div>";
                } ?>

                <h1>Izbrisite roditelja</h1>
                <?php
                $upit = "SELECT * FROM korisnici WHERE obrisan=0 AND status='Roditelj'";
                $rez = $db->query($upit);
                echo "<h3>Broj roditelja: " . $db->num_rows($rez) . "</h3><br><br>";
                while ($red = $db->fetch_object($rez)) {
                    $id = $red->id;
                    echo "<div class='dadilja'>";
                    echo "<div style='display: inline-block; vertical-align: top; margin-right: 5px;'><img src='" . ((file_exists("avatariR/$red->id.jpg")) ? "avatariR/$red->id.jpg" : "avatari/noimage.jpg") . "' width='150px' alt='Nema slike'></div>";
                    echo "<div style='display: inline-block'>";
                    echo "<a href=profil.php?id=$red->id <p class='bold'>$red->ime $red->prezime</p></a>";
                    echo "<p>Rodjen sam : $red->godRodj.</p>";
                    echo "<p>Telefon: $red->telefon.</p>";
                    echo "<p>Telefon: $red->adresa</p>";

                    echo "</div>";
                    echo "<button class='but' name='izbrisi' id='izbrisi' onclick='izbrisiP($id)' > Izbrisi korisnika</button></a>";
                    echo "</div>";
                } ?>


                <br><br>
                <div><?= $poruka ?></div>
            </div>

        </main>
    </div>
</section>


<?php
require("_footer.php");
?>