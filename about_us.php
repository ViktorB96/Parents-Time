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
            <div id="text">
                <p>Dragi roditelji,</p>
                <p> Koliko puta se desilo da ostanete duze na poslu i ne mozete da stignete da pokupite decu iz vrtica na vreme? ili zelite da izadjete sa muzem-zenom na romanticnu veceru za dvoje? Da se vidite se sa prijateljima koje dugo niste videli? Odete u nabavku i obavite kucne poslove? ili jednostavno zelite da izdvojite vreme za sebe? A bake i deke nisu mogle da uskoce i pripomognu u cuvanju unuka? Mnogo puta, je l tako?
                    Biti roditelj nije lako u danasnje vreme kada se brzo zivi i dan prekratko traje za sve obaveze koje treba obaviti.<br><br>
                    Zato smo mi tu za vas, da vam pomognemo da na najbrzi nacin pronadjete idealnu osobu koja ce voditi racuna o vasim malisanima, u trenucima kada vi to niste u mogucnosti.<br><br>
                    Registrijte se besplatno na nasem sajtu i pronadjite osobu koja ce cuvati vase dete-decu u samo par koraka.
                </p>

            </div>

            <p><img src="images/fotelja.jpeg" alt=""></p>

            <h2>Kako platforma funkcionise?</h2>
            <p><br>
                1 ⦁ Pretražite bazu dostupnih bebisitera - pronadjite bebisiterku/dadilju prema vasim kriterijumima.<br><br>
                2 ⦁ Povezite se - pozovite kandidata telefonom ili putem mejla i izaberite bebisitrku/dadilju koja odgovara vasoj porodici.<br><br>
                3 ⦁ Zakazite datum i vreme i upoznajte se uzivo.<br><br>

                Srecno!
            </p>

        </main>




    </div>
</section>
<?php
require("_footer.php");

?>