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

            <?php


            if (isset($_POST['zahtev'])) {
                $id = $_GET['id'];
                $odKad = $_POST['odKad'];
                $doKad = $_POST['doKad'];
                $deca = $_POST['deca'];
                $uzrast = $_POST['uzrast'];
                $ljubimci = $_POST['ljubimci'];
                $skola = $_POST['skola'];
                $ppotrebe = $_POST['ppotrebe'];
                $kucni = $_POST['kucni'];
                $nocno = $_POST['nocno'];
                $prevoz = $_POST['prevoz'];
                $putovanje = $_POST['putovanje'];
                $inostranstvo = $_POST['inostranstvo'];
                $oPorodici = $_POST['oPorodici'];
                if ($id != "" and $odKad != "" and $doKad != "" and $deca != "0" and $uzrast != "0" and $ljubimci != "0" and $skola != "0" and $ppotrebe != "0" and $kucni != "0" and $nocno != "0" and $prevoz != "0" and $putovanje != "0" and $inostranstvo != "0" and $oPorodici != "") {
                    $upit = "UPDATE zahtev SET od_kad='{$odKad}',do_kad='{$doKad}',broj_dece='{$deca}',uzrast_deteta='{$uzrast}',ljubimci='{$ljubimci}',skola='{$skola}',ppotrebe='{$ppotrebe}',kucni='{$kucni}',nocno='{$nocno}',prevoz='{$prevoz}',putovanje='{$putovanje}',inostranstvo='{$inostranstvo}',oPorodici='{$oPorodici}'WHERE id=$id";
                    $db->query($upit);
                    $poruka = "Uspesno ste se izmenili zahtev";
                    header("Location: hvalaZahtev.php");
                } else {
                    echo $db->error();
                    $poruka = "Niste uneli sve podatke.";
                }
            }


            ?>

            <style>
                option[value="0"] {
                    display: none;
                }
            </style>


            <h2>Posalji zahtev za cuvanje</h2><br><br>
            <?php
            $sql = "SELECT * FROM zahtev WHERE id={$_GET['id']}";
            $rez = $db->query($sql);
            $red = $db->fetch_object($rez);
            ?>

            <form action="izmeniZahtev.php?id=<?= $_GET['id']; ?>" method="POST" enctype="multipart/form-data"><br>
                <h4>Od kad</h4>
                <input type="date" name="odKad" id="odKad" placeholder="Od kog datuma treba cuvati dete" value="<?= $red->od_kad ?>"><br>
                <h4>Do kad</h4>
                <input type="date" name="doKad" id="doKad" placeholder="Do kog datuma treba cuvati dete" value="<?= $red->do_kad ?>"><br>
                <h4>Koliko dece je potrebno cuvati</h4>
                <select name="deca" id="deca">

                    <option value="<?= $red->broj_dece ?>"><?= $red->broj_dece ?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="3+">3+</option>

                </select><br><br>

                <h4>Uzrast dece</h4>
                <select name="uzrast" id="uzrast">
                    <option value="<?= $red->uzrast_deteta ?>"><?= $red->uzrast_deteta ?></option>
                    <option value=" Bebe uzrasta do god dana"> Bebe uzrasta do god dana</option>
                    <option value="deca vrtickog uzrasta">Deca vrtickog uzrasta</option>
                    <option value="Skolskog uzrasta">Deca skolskog uzrasta</option>
                    <option value="Bebe uzrasta do god dana i Deca vrtickog uzrasta">Bebe uzrasta do god dana i Deca vrtickog uzrasta</option>
                    <option value="Bebe uzrasta do god dana i Deca skolskog uzrasta">Bebe uzrasta do god dana i Deca skolskog uzrasta</option>
                    <option value="Deca vrtickog uzrasta i bebe uzrasta do god dana">Deca vrtickog uzrasta i bebe uzrasta do god dana</option>
                    <option value="Deca vrtickog uzrasta i skolskog uzrasta">Deca vrtickog uzrasta i skolskog uzrasta</option>
                    <option value="Deca svih navedenih uzrasta">Deca svih navedenih uzrasta</option>



                </select><br><br>
                <h4>Da li imate kucne ljubimce</h4>
                <select name="ljubimci" id="ljubimci">
                    <option value="<?= $red->ljubimci ?>"><?= $red->ljubimci ?></option>
                    <option value="da">Da</option>
                    <option value="ne">Ne</option>

                </select>
                <h4>Pomoc oko skolskih aktivnosti</h4>
                <select name="skola" id="skola">
                    <option value="<?= $red->skola ?>"><?= $red->skola ?></option>
                    <option value=" da">Da</option>
                    <option value="ne">Ne</option>

                </select><br><br>
                <h4>Potrebno mi je cuvanje dece sa posebnim potrebama </h4>
                <select name="ppotrebe" id="ppotrebe">
                    <option value="<?= $red->ppotrebe ?>"><?= $red->ppotrebe ?></option>
                    <option value=" Da potrebna mi je cuvanje deteta sa bosebnim potrtebama, i bitno mi je da ta osoba ima iskustva"> Da potrebna mi je cuvanje deteta sa bosebnim potrtebama, i bitno mi je da ta osoba ima iskustva</option>
                    <option value="Ne nije mi potrebno">Ne nije mi potrebno</option>
                    <option value="Da potrebno mi je, ali je iskustvo nebitno">Da potrebno mi je, ali je iskustvo nebitno</option>

                </select><br><br>
                <h4>Voleo/la bih da osoba koja ce cuvati dete, uz to uradi i dodatne kucne poslove </h4>
                <select name="kucni" id="kucni">
                    <option value="<?= $red->kucni ?>"><?= $red->kucni ?></option>
                    <option value="da">Da</option>
                    <option value="ne">Ne</option>
                </select><br><br>
                <h4>Potrebno mi je cuvanje dece nocu</h4>
                <select name="nocno" id="nocno">
                    <option value="<?= $red->nocno ?>"><?= $red->nocno ?></option>
                    <option value="da">Da</option>
                    <option value="ne">Ne</option>
                </select><br><br>
                <h4>Obezbedjujem prevoz ukoliko je to potrebno u odredjenim situacijama (na primer:nocno cuvanje)</h4>
                <select name="prevoz" id="prevoz">
                    <option value="<?= $red->prevoz ?>"><?= $red->prevoz ?></option>
                    <option value="da">Da</option>
                    <option value="ne">Ne</option>
                </select><br><br>
                <h4>Potrebna mi je osoba koja ce putovati sa nama-Putovanje sa porodicom</h4>
                <select name="putovanje" id="putovanje">
                    <option value="<?= $red->putovanje ?>"><?= $red->putovanje ?></option>
                    <option value="da">Da</option>
                    <option value="ne">Ne</option>
                </select><br><br>
                <h4>Potrebna mi je osoba za rad u inostransotvu.</h4>
                <select name="inostranstvo" id="inostranstvo">
                    <option value="<?= $red->inostranstvo ?>"><?= $red->inostranstvo ?></option>
                    <option value="da">Da</option>
                    <option value="ne">Ne</option>
                </select><br>
                <h4>Nesto o porodici</h4>
                <textarea style='width:50%;' name="oPorodici" id="oPorodici" cols="30" rows="10"><?php echo $red->oPorodici; ?></textarea>
                <br>
                <br>

                <button type="submit" class="but" name="zahtev" id="zahtev">Izmeni zahtev</button>

            </form>




</section>


<?php
require("_footer.php");
?>