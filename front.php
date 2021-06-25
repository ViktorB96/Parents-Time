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
        $(function() {
            $('a[href*="#"]:not([href="#"])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
    </script>

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

<article id="hero" class="negative">
    <div class="wrapper">


        <h1>Parent's time</h1>
        <p><i>“Porodicu ne čine samo oni sa kojima smo u krvnom srodstvu. Čine je i oni koji nas drže za ruku onda kada nam je to najpotrebnije.”</i>
        </p>
        <p><a href="#about" class="but">Saznajte vise &raquo;</a></p>

    </div>
</article>


<section id="products">
    <div class="wrapper">

        <header>
            <h1>O nama</h1>
                <p><b>Pronalaženje bebisitera nikad nije bilo jednostavnije! </b></p>
              <p> Parent's time je platforma koja je tu da izadje u susret svakom roditelju kome je potebna pomoć prilikom traženja idealne osobe koja bi čuvala njihovo dete kada oni to nisu u mogućnosti.<br><br>
                U samo par koraka i potpuno besplatno moguće je pronaći bebisitera/dadilju koji odgovaraju baš vašim kriterijumuma.


            </p>
        </header>



    </div>
</section>



<article id="about" class="negative">
    <div class="wrapper">

        <div class="back">

            <h2>Kako platforma funkcionise ?</h2>
            <p>Kako platforma funkcionise?
                Pretražite bazu dostupnih bebisitera - pronadjite bebisiterku/dadilju prema vasim kriterijumima
                Povezite se - pozovite kandidata telefonom ili zakazite intervju na nasem sajtu(ako moze to da se napravi) i izaberite bebisitrku/dadilju koja odgovara vasoj porodici
            </p>
            <p><a href="about_us.php" class="but">Saznajte vise&raquo;</a></p>
        </div>

    </div>
</article>


<section id="partner">
    <div class="wrapper">




    </div>
</section>



<footer id="footer" class="negative">
    <div class="wrapper">

        <div class="footerBlock">
            <h4>Informišite se</h4>
            <p><a href="about_us.php">O nama</a></p>
            <p><a href="babysiter.php">Baza bebisitera/dadilja</a></p>
            <p><a href="Politika privatnosti.pdf">Politika privatnosti</a></p>
            <p><a href="Uslovi korišćenja.pdf">Uslovi korićenja</a></p>
            <p><a href="Mere poverenja i bezbednosti.pdf">Mere poverenja i bezbednosti</a></p>
        </div>
        <div class="footerBlock">
            <h4>Kontaktirajte nas</h4>


            <p> <img src='images/facebook.png'><a href="https://www.facebook.com/Parents-time-102157838176047">&nbsp;&nbsp;Facebook</a></p>
            <p> <img src='images/instagram.png'><a href="https://instagram.com/parents__time?igshid=1x15ah4iiaspd">&nbsp;&nbsp;Instagram</a></p>
            <p> <img src='images/gmail.png'><a href="#">&nbsp;&nbsp;contact.parentstime@gmail.com</a></p>
            <p> <img src='images/phone-call.png'><a href="#">&nbsp;&nbsp;061/ 108 00 04</a></p>

        </div>

        <div class="footerBlockR">
            <img src="images/Logo bez pozadine.png">
        </div>

    </div>
 
</footer>



</body>

</html>