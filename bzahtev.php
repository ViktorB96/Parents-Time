<?php
session_start();
require_once("require.php");
$db = new Baza();
$db->connect();

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
    <script src="js/prijava.js"></script>
    <script src="js/prihvati.js"></script>
    <script src="js/odbij.js"></script>
    <script src="js/izbrisiZahtev.js"></script>




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
    <h2>Zahtevi za cuvanje</h2><br><br>
    <?php
    if ($_SESSION['status'] == "Dadilja") {
        $upit = "SELECT * FROM zahtev WHERE id_dadilje={$_SESSION['id']}";
        $rez = $db->query($upit);
        $red = $db->num_rows($rez);
        echo "<img src='images/portfolio.png'> Broj zahteva :" . $red . "<br><br>";
        while ($red = $db->fetch_object($rez)) {
            $id = $red->id;
            echo "<div class='vest'>";
            echo "<div style='display: inline-block'>";
            echo "<p><img src='images/clock.png'> Dete treba cuvati od $red->od_kad do $red->do_kad.</p>";
            echo "<p><img src='images/portfolio.png'> Broj dece koje treba cuvati: $red->broj_dece</p>";
            echo "<p><img src='images/age.png'> Uzrast deteta koje treba cuvati: $red->uzrast_deteta</p>";
            echo "<p><img src='images/dog1.png'> Da li roditelj poseduje kucne ljubimce: $red->ljubimci</p>";
            echo "<p><img src='images/knowledge1.png'> Da li je detetu potrebno pomoci oko skolskih aktivnosti: $red->skola</p>";
            echo "<p><img src='images/sky1.png'> Da li je detetu potrebno nocno cuvanje: $red->nocno</p>";
            echo "<p><img src='images/jeep.png'> Da li je obezbedjujete prevoz dadilji: $red->prevoz</p>";
            echo "<p><img src='images/abroad1.png'> Da li je potrebno ici na put sa porodicom: $red->putovanje</p>";
            echo "<p><img src='images/travel1.png'> Da li je potrebno cuvati decu u inostranstvu: $red->inostranstvo</p>";
            echo "<p><img src='images/info.png'> Nesto o porodici :$red->oPorodici</p>";
            if ($red->stanje != "") {
                echo "<p><img src='images/accept.png'> Ovaj zahtev je: $red->stanje</p>";
            } else {
                echo "<button class='but' name='prihvati' id='prihvati' onclick='prihvati($id)'>Prihvati zahtev</button>&nbsp;";
                echo "<button class='but' name='odbij' id='odbij' onclick='odbij($id)'> Odbij zahtev</button></a>";
            }

            echo "</div>";
            echo "</div>";
        }
    } else {
        $upit = "SELECT * FROM zahtev WHERE id_roditelja={$_SESSION['id']}";
        $rez = $db->query($upit);
        $red = $db->num_rows($rez);
        echo "<img src='images/portfolio.png'> Broj zahteva :" . $red . "<br><br>";
        while ($red = $db->fetch_object($rez)) {
            $id = $red->id;
            echo "<div class='vest'>";
            echo "<div style='display: inline-block'>";
            echo "<p><img src='images/clock.png'> Dete treba cuvati od $red->od_kad do $red->do_kad.</p>";
            echo "<p><img src='images/portfolio.png'> Broj dece koje treba cuvati: $red->broj_dece</p>";
            echo "<p><img src='images/age.png'> Uzrast deteta koje treba cuvati: $red->uzrast_deteta</p>";
            echo "<p><img src='images/dog1.png'> Da li roditelj poseduje kucne ljubimce: $red->ljubimci</p>";
            echo "<p><img src='images/knowledge1.png'> Da li je detetu potrebno pomoci oko skolskih aktivnosti: $red->skola</p>";
            echo "<p><img src='images/sky1.png'> Da li je detetu potrebno nocno cuvanje: $red->nocno</p>";
            echo "<p><img src='images/jeep.png'> Da li je obezbedjujete prevoz dadilji: $red->prevoz</p>";
            echo "<p><img src='images/abroad1.png'> Da li je potrebno ici na put sa porodicom: $red->putovanje</p>";
            echo "<p><img src='images/travel1.png'> Da li je potrebno cuvati decu u inostranstvu: $red->inostranstvo</p>";
            echo "<p><img src='images/info.png'> Nesto o porodici :$red->oPorodici</p>";
            echo "<p><img src='images/accept.png'> Ovaj zahtev je: $red->stanje</p>";
            echo "<a href='izmeniZahtev.php?id=$id'><button class='but' name='promeni' id='promeni'>Izmeni zahtev</button></a>&nbsp;";
            echo "<button class='but' name='izbrisi' id='izbrisi' onclick='izbrisi($id)'>Izbrisi zahtev</button></a>";


            echo "</div>";
            echo "</div>";
        }
    }

    ?>



</section>

<?php
require("_footer.php");
?>