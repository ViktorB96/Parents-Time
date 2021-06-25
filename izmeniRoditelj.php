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
    <script src="js/popuniKorisnike.js"></script>
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

        <?php
        $poruka = "";
        if (isset($_POST['snimi'])) {

            $email = $_POST['email'];
            $lozinka = $_POST['lozinka'];
            $pol = $_POST['pol'];
            $godRodj = $_POST['godRodj'];
            $adresa = $_POST['adresa'];
            $grad = $_POST['grad'];
            $telefon = $_POST['telefon'];
            $osebi = $_POST['osebi'];
            if ($email != "" and $lozinka != "" and $pol != "0" and $godRodj != "" and $adresa != "" and $grad != "" and $telefon != "" and $osebi != "") {
                $upit = "UPDATE korisnici SET email='{$email}',lozinka='{$lozinka}', pol='{$pol}',godRodj='{$godRodj}',adresa='{$adresa}',grad='{$grad}',telefon='{$telefon}',osebi='{$osebi}' WHERE id='{$_SESSION['id']}')";
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
                $poruka = $db->error() . "Niste uneli sve podatke";
        }
        ?>

        <form action="izmeniRoditelj.php" method="POST" enctype="multipart/form-data">
            <?php
            $sql = "SELECT * FROM korisnici WHERE id={$_SESSION['id']}";
            $rez = $db->query($sql);
            $red = $db->fetch_object($rez);
            ?>

            <?php
            echo "<img src='" . ((file_exists("avatari/$red->id.jpg")) ? "avatari/$red->id.jpg" : "avatari/noimage.jpg") . " 'width='300px'' alt='Nema slike'>";
            ?>
            <hr>
            <label class="but">
                <input type="file" name="avatar" />Promeni sliku
                <br>
            </label>
            <h5>Email:</h5>
            <input type="text" id="email" name="email" placeholder="Unesite email" value="<?php echo $red->email ?>"><br><br>
            <h5>Lozinka:</h5>
            <input type=" password" name="lozinka" id="lozinka" placeholder="Unesite lozinku" value="<?php echo $red->lozinka ?>"><br><br>
            <h2>Vas pol:</h2>
            <select name="pol" id="pol">
                <option value="<?= $red->pol ?>"><?= $red->pol ?></option>
                <option value="Musko">Musko</option>
                <option value="Zensko">Zensko</option>
            </select><br><br>
            <h2>Vasa godina rodnjenja:</h2>
            <input type="text" name="godRodj" id="godRodj" placeholder="Godina rodjenja" value="<?php echo $red->godRodj ?>"><br><br>
            <h5>Vasa adresa:</h5>
            <input type="text" name="adresa" id="adresa" placeholder="Vasa adresa stanovanja" value="<?php echo $red->adresa ?>"><br><br>
            <h5>Grad u kojem zivite:</h5>
            <input type="text" name="grad" id="grad" placeholder="Grad u kojem bi ste radili" value="<?php echo $red->grad ?>"><br><br>
            <h5>Vas telefon:</h5>
            <input type="text" name="telefon" id="telefon" placeholder="Vas telefon" value="<?php echo $red->telefon ?>"><br><br>
            <h5>Recine nam ukratko nesto o sebi, kako bismo vas bolje upoznali</h5><br>
            <textarea name="osebi" id="osebi" cols="30" rows="10"><?php echo $red->osebi; ?></textarea><br><br>
            <button class="but" type="submit" name="snimi" id="snimi">Zapamti!</button>
        </form>
        <div><?= $poruka ?></div>
    </div>
</section>

<?php
require("_footer.php");
?>