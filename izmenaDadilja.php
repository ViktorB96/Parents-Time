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
    <script src="js/slide.js"></script>
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
?>
<section id="central">
    <div class="wrapper">

        <?php
        $poruka = "";
        if (isset($_POST['snimi'])) {

            $lozinka = $_POST['lozinka'];
            $pol = $_POST['pol'];
            $godRodj = $_POST['godRodj'];
            $adresa = $_POST['adresa'];
            $grad = $_POST['grad'];
            $telefon = $_POST['telefon'];
            $mreze = $_POST['mreze'];
            $radila_bih = $_POST['radila_bih'];
            $obrazovanje = $_POST['obrazovanje'];
            $zanimanje = $_POST['zanimanje'];
            $iskustvo = $_POST['iskustvo'];
            $skolska_pomoc = $_POST['skolska_pomoc'];
            $kucni_poslovi = $_POST['kucni_poslovi'];
            $ljubimci = $_POST['ljubimci'];
            $nocno = $_POST['nocno'];
            $ppotrebe = $_POST['ppotrebe'];
            $putovanje = $_POST['putovanje'];
            $stranci = $_POST['stranci'];
            $inostranstvo = $_POST['inostranstvo'];
            $form_satnica = $_POST['form_satnica'];
            $opseg_satnice = $_POST['opseg_satnice'];
            $osebi = $_POST['osebi'];
            if ($lozinka != "" and $pol != "0" and $godRodj != "" and $adresa != "" and $grad != "" and $telefon != "" and $mreze != ""  and $radila_bih != "0" and $obrazovanje != "0" and $zanimanje != "" and $iskustvo != "0" and $skolska_pomoc != "0" and $kucni_poslovi != "0" and $ljubimci != "0" and $nocno != "0" and $ppotrebe != "0" and $putovanje != "0" and $stranci != "0" and $osebi != "" and $inostranstvo != "0" and $form_satnica != "0" and $opseg_satnice != "0") {
                $upit = "UPDATE korisnici SET lozinka=('{$lozinka}'), pol='{$pol}',godRodj='{$godRodj}',adresa='{$adresa}',grad='{$grad}',telefon='{$telefon}',mreze='{$mreze}',radila_bih='{$radila_bih}',obrazovanje='{$obrazovanje}',zanimanje='{$zanimanje}',iskustvo='{$iskustvo}',skolska_pomoc='{$skolska_pomoc}',kucni_poslovi='{$kucni_poslovi}',ljubimci='{$ljubimci}',nocno='{$nocno}',ppotrebe='{$ppotrebe}',putovanje='{$putovanje}',stranci='{$stranci}',inostranstvo='{$inostranstvo}',form_satnica='{$form_satnica}',osebi='{$osebi}',opseg_satnice='{$opseg_satnice}' WHERE id='{$_SESSION['id']}'";
                $rez = $db->query($upit);
                if ($db->error()) $poruka = $db->error();
                else {
                    header('Location: hvalaDadilja.php');
                    Log::upisiLog("logovi/korisnici.txt", "Uspesno izmenjen korisnik $ime $prezime $status");
                    if ($_FILES['avatar']['name'] != "") {
                        $ime = "avatari/" . $_SESSION['id'] . ".jpg";
                        move_uploaded_file($_FILES['avatar']['tmp_name'], $ime);
                    }
                }
            } else
                $poruka = "Niste uneli sve podatke";
        }
        ?>

        <form action="izmenaDadilja.php" method="post" enctype="multipart/form-data">
            <?php
            $sql = "SELECT * FROM korisnici WHERE id={$_SESSION['id']}";
            $rez = $db->query($sql);
            $red = $db->fetch_object($rez);
            ?>

            <h5>Profilna slika:</h5><br>
            <?php
            echo "<img src='" . ((file_exists("avatari/$red->id.jpg")) ? "avatari/$red->id.jpg" : "avatari/noimage.jpg") . " 'width='300px'' alt='Nema slike'><br>";
            ?>
            <label class="but">
                <input type="file" name="avatar" id="avatar" />Promeni sliku
                <br>
            </label>
            <h5>Ime:</h5>
            <input type="text" id=ime name="ime" placeholder="Unesi ime" disabled value="<?= $red->ime ?>"><br><br>
            <h5>Prezime:</h5>
            <input type="text" id=prezime name="prezime" placeholder="Unesite prezime" disabled value="<?= $red->prezime ?>"><br><br>

            <h5>Email:</h5>
            <input type="text" id="email" name="email" placeholder="Unesite email" value="<?= $red->email ?>"><br><br>
            <h5>Lozinka:</h5>
            <input type=" password" name="lozinka" id="lozinka" placeholder="Unesite lozinku" value="<?= $red->lozinka ?>"><br><br>

            <h2>Vas pol:</h2>
            <select name="pol" id="pol">
                <option value="<?= $red->pol ?>"><?= $red->pol ?></option>
                <option value="Musko">Musko</option>
                <option value="Zensko">Zensko</option>
            </select><br><br>
            <h2>Vasa godina rodnjenja:</h2>
            <input type="text" name="godRodj" id="godRodj" placeholder="Godina rodjenja" value="<?= $red->godRodj ?>"><br><br>
            <h5>Vasa adresa:</h5>
            <input type="text" name="adresa" id="adresa" placeholder="Vasa adresa stanovanja" value="<?= $red->adresa ?>"><br><br>
            <h5>Grad u kojem bi ste radili:</h5>
            <input type="text" name="grad" id="grad" placeholder="Grad u kojem bi ste radili" value="<?= $red->grad ?>"><br><br>
            <h5>Vas telefon:</h5>
            <input type="text" name="telefon" id="telefon" placeholder="Vas telefon" value="<?= $red->telefon ?>"><br><br>
            <h5>Vase drustvene mreze(linkovi):</h5>
            <input type="text" name="mreze" id="mreze" placeholder="Vase drustvene mreze" value="<?= $red->mreze ?>"><br><br>
            <h5>Voleo/la bih da radim sa :</h5>
            <select name="radila_bih" id="radila_bih"><br><br>
                <option value="<?= $red->radila_bih ?>"> <?= $red->radila_bih ?></option>
                <option value="bebama do god dana">Bebama do god dana</option>
                <option value="decom vrtickog uzrasta">Decom vrtickog uzrasta</option>
                <option value="decom skolskog uzrasta">Decom skolskog uzrasta</option>
                <option value="Sve od navedenog">Sve od navedenog</option>
            </select><br><br>
            <h5>Vase obrazovanje:</h5>
            <select name="obrazovanje" id="obrazovanje">
                <option value="<?= $red->obrazovanje ?>"><?= $red->obrazovanje ?></option>
                <option value="Osnovna strucna sprema">Osnovna strucna sprema</option>
                <option value="Srednja strucna sprema">Srednja strucna sprema</option>
                <option value="Visa strucna sprema">Visa strucna sprema</option>
                <option value="Visoka strucna sprema">Visoka strucna sprema</option>
            </select><br><br>
            <h5>Vase zanimanje:</h5>
            <input type="text" name="zanimanje" id="zanimanje" placeholder="Vase zanimanje" value="<?= $red->zanimanje ?>"><br><br>
            <h5>Radno iskustvo:</h5>
            <select name="iskustvo" id="iskustvo">
                <option value="<?= $red->iskustvo ?>"><?= $red->iskustvo ?></option>
                <option value="Nemam iskustva u radu sa decom">Nemam iskustva u radu sa decom</option>
                <option value="Imam do godinu dana iskustva u radu sa decom">Imam do godinu dana iskustva u radu sa decom</option>
                <option value="Imam 2 do 3 god iskustva u radu sa decom">Imam 2 do 3 god iskustva u radu sa decom</option>
                <option value="Imam vise od 3 god iskustva u radu s decom">Imam vise od 3 god iskustva u radu s decom</option>
            </select><br><br>
            <h5>Da li biste pristali na ucenje sa decom i pomoc u skolskim aktivnostima?</h5>
            <select name="skolska_pomoc" id="skolska_pomoc">
                <option value="<?= $red->skolska_pomoc ?>"><?= $red->skolska_pomoc ?></option>
                <option value="Da pristala bih">Da pristala bih</option>
                <option value="Ne ne bih radila">Ne ne bih radila</option>
            </select><br><br>
            <h5>Da li biste radili dodatne kucne poslove ukoliko to porodica zahteva?</h5>
            <select name="kucni_poslovi" id="kucni_poslovi">
                <option value="<?= $red->kucni_poslovi ?>"><?= $red->kucni_poslovi ?></option>
                <option value="Da pristala bih">Da pristala bih</option>
                <option value="Ne ne bih radila">Ne ne bih radila</option>
            </select><br><br>
            <h5>Da li vam smetaju kucni ljubimci?</h5>
            <select name="ljubimci" id="ljubimci">
                <option value="<?= $red->ljubimci ?>"><?= $red->ljubimci ?></option>
                <option value="Da">Da</option>
                <option value="Ne">Ne</option>
            </select><br><br>
            <h5>Da li biste cuvali decu u nocnoj smeni? </h5>
            <select name="nocno" id="nocno">
                <option value="<?= $red->nocno ?>"><?= $red->nocno ?></option>
                <option value="Da">Da</option>
                <option value="Ne">Ne</option>
            </select><br><br>
            <h5>Da li biste radili sa decom sa posebnim potrebama i da li imate iskustva u tome?</h5>
            <select name="ppotrebe" id="ppotrebe">
                <option value="<?= $red->ppotrebe ?>"><?= $red->ppotrebe ?></option>
                <option value="Da radio-la bih sa decom sa posebnim potrebama, ali nemam dosadasnjeg iskustva.">Da radio-la bih sa decom sa posebnim potrebama, ali nemam dosadasnjeg iskustva.</option>
                <option value="Da radio-la bih sa decom sa posebnim potrebama, i imam iskustva.">Da radio-la bih sa decom sa posebnim potrebama, i imam iskustva.</option>
                <option value="Ne, ne bih radio-la bih sa decom sa posebnim potrebama.">Ne, ne bih radio-la bih sa decom sa posebnim potrebama.</option>
            </select><br><br>
            <h5>Da li biste putovali sa porodicom ukoliko je to potrebno?</h5>
            <select name="putovanje" id="putovanje">
                <option value="<?= $red->putovanje ?>"><?= $red->putovanje ?></option>
                <option value="Da putovala bih">Da putovala bih</option>
                <option value="Ne ne bih putovala">Ne ne bih putovala</option>
            </select><br><br>
            <h5>Da li biste raditi u porodici koja nije sa naseg govornog podrucja?</h5>
            <select name="stranci" id="stranci">
                <option value="<?= $red->stranci ?>"><?= $red->stranci ?></option>
                <option value="Da">Da</option>
                <option value="Ne">Ne</option>
            </select><br><br>
            <h5>Rad u inostranstvu :</h5>
            <select name="inostranstvo" id="inostranstvo">
                <option value="<?= $red->inostranstvo ?>"><?= $red->inostranstvo ?></option>
                <option value="Da pristala bih">Da pristala bih</option>
                <option value="Ne ne bih pristala">Ne ne bih pristala</option>
            </select><br><br>
            <h5>Na osnovu cega formirate vasu satnicu? :</h5>
            <select name="form_satnica" id="form_satnica">
                <option value="<?= $red->form_satnica ?>"><?= $red->form_satnica ?></option>
                <option value="U zavisnosti od broja dece koju je potrebno cuvati">U zavisnosti od broja dece koju je potrebno cuvati</option>
                <option value="U zavisnosti samo od broja provedenih sati sa detetom">U zavisnosti samo od broja provedenih sati sa detetom</option>
            </select><br><br>
            <h5>Obelezite opseg satnice za koju biste radili:</h5>
            <select name="opseg_satnice" id="opseg_satnice">
                <option value="<?= $red->opseg_satnice ?>"><?= $red->opseg_satnice ?></option>
                <option value="100-200">100-200</option>
                <option value="200-300">200-300</option>
                <option value="300-400">300-400</option>
                <option value="400+">400+</option>
            </select><br><br>
            <h5>Recine nam ukratko nesto o sebi, kako bismo vas bolje upoznali</h5><br>
            <textarea name="osebi" id="osebi" cols="30" rows="10"><?php echo $red->osebi; ?></textarea><br>


            <button class="but" name="snimi" id="snimi">Zapamti!</button>
        </form>
        <div><?= $poruka ?></div>
    </div>
</section>

<?php
require("_footer.php");
?>