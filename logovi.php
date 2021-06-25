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
$poruka = "";
?>
<section id="central">
    <div class="wrapper">

        <main>
            <h1>Statistika</h1>
            <form action="#" method='post' enctype="multipart/form-data" name="forma">
                <select name="log" id="log">
                    <option value="0">--izaberite log--</option>
                    <option value="logovanja.txt">Logovanja</option>
                    <option value="korisnici.txt">Korisnici</option>
                </select><br><br>
                <button class="but" name="dugme">Pogledaj LOG</button>
            </form>
            <br><br>
            <div style="border:1px solid black; padding:5px">
                <?php
                if (isset($_POST['log'])) {
                    $imeFajla = "logovi/" . $_POST['log'];
                    if (file_exists($imeFajla)) {
                        $tekst = file_get_contents($imeFajla);
                        $tekst = nl2br($tekst);
                        echo $tekst;
                    } else
                        echo "datoteka ne postoji!!!";
                }
                ?>
            </div>
        </main>
    </div>
</section>


<?php
require("_footer.php");
?>