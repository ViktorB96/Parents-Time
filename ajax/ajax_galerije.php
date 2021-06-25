<?php
session_start();
require_once("../require.php");
$db = new Baza();
$db->connect();
$izlaz['greska'] = "";
$izlaz['poruka'] = "";
$funkcija = $_GET['funkcija'];
if ($funkcija == "snimiGaleriju") {
    if (isset($_POST['naziv']) and isset($_POST['komentar'])) {
        $naziv = $_POST['naziv'];
        $komentar = $_POST['komentar'];
        if ($naziv != "") {
            $sql = "INSERT INTO galerije (naziv, komentar) VALUES ('{$naziv}', '{$komentar}')";
            $db->query($sql);
            if ($db->error())
                echo "Greška!!!<br>" . $db->error();
            else
                echo "Uspešno dodata galerija";
        } else
            echo "Niste uneli naziv";
    } else
        echo "Ne postoje podaci";
}

if ($funkcija == "popuniGalerije") {
    $sql = "SELECT * FROM galerije ORDER BY id DESC";
    $rez = $db->query($sql);
    $sve = $db->fetch_all($rez);
    echo JSON_encode($sve, 256);
}

if ($funkcija == "obrisiGaleriju") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        if ($id != "0") {
            $sql = "DELETE FROM galerije WHERE id=" . $id;
            $db->query($sql);
            if ($db->error())
                echo "Doslo je do greske.<br>" . $db->error();
            else
                echo "Uspešno obrisana galerija";
        } else
            echo "Niste izabrali galeriju za brisanje";
    }
}

if ($funkcija == "popuniSlike") {
    if (isset($_POST['idGalerije']) and $_POST['idGalerije'] != "0") {
        $idGalerije = $_POST['idGalerije'];
        $sql = "SELECT * FROM galerijeslike WHERE idGalerije=" . $idGalerije;
        $rez = $db->query($sql);
        $izlaz = "";
        while ($red = $db->fetch_object($rez)) {
            $izlaz .= "<div class='slika' id='slika_$red->id'>";
            $izlaz .= "<img src='galerije/$red->slika' height='100px'>";
            if ($red->komentarSlike == "") $red->komentarSlike = "&nbsp;";
            $izlaz .= "<div>$red->komentarSlike</div>";
            if ($red->tag != "") {
                $sql = "SELECT ime, prezime FROM korisnici WHERE id IN ($red->tag)";
                $pomrez = $db->query($sql);
                $izlaz .= "<div>";
                while ($pomred = $db->fetch_object($pomrez))
                    $izlaz .= $pomred->ime . " " . $pomred->prezime . ", ";
                $izlaz .= "</div>";
            } else $red->tag = "&nbsp;";

            $izlaz .= "<button onclick='obrisiSliku($red->id)' class='but'>Obriši sliku</button>";
            $izlaz .= "</div>";
        }
        echo $izlaz;
        /*$sve=$db->fetch_all($rez);
        echo JSON_encode($sve, 256);*/
    }
}

if ($funkcija == "snimiSliku") {
    $imeSlike = microtime(true) . ".jpg";
    $tempImeSlike = $_FILES['slika']['tmp_name'];
    if (@move_uploaded_file($tempImeSlike, "../galerije/$imeSlike")) {
        $idGalerije = $_POST['idGalerije'];
        $komentarSlike = $_POST['komentarSlike'];
        $sql = "INSERT INTO galerijeslike (idGalerije, slika, komentarSlike) VALUES ({$idGalerije}, '{$imeSlike}', '{$komentarSlike}' )";
        $db->query($sql);
        echo "Uspešno dodata slika";
    } else
        echo "Greška";
}

if ($funkcija == "obrisiSliku") {
    $id = $_POST['id'];
    $sql = "DELETE FROM galerijeslike WHERE id=" . $id;
    $db->query($sql);
}
