<?php
session_start();
require_once("../require.php");
$db = new Baza();
$db->connect();
$izlaz['greska'] = "";
$izlaz['poruka'] = "";
$funkcija = $_GET['funkcija'];
if ($funkcija == "prijava") {
    if (isset($_POST['email']) and isset($_POST['lozinka'])) {
        $email = $_POST['email'];
        $lozinka = $_POST['lozinka'];
        if ($email != "" and $lozinka != "") {
            if (validanString($email) and validanString($lozinka)) {
                $upit = "SELECT * FROM korisnici WHERE email='{$email}'";
                $rez = $db->query($upit);
                if ($db->num_rows($rez) == 1) {
                    $red = $db->fetch_object($rez);
                    if ($red->lozinka == $lozinka) {
                        if ($red->validan == 1) {
                            napraviSesiju($red->id, $red->ime, $red->prezime, $red->status, $red->email);
                            Log::upisiLog("../logovi/logovanja.txt", "Uspešna prijava korisnika {$_SESSION['ime']}");
                            $izlaz['poruka'] = "index.php";
                        } else {
                            $izlaz['greska'] = "Podaci su ispravni, ali email adresa nije validirana";
                            Log::upisiLog("../logovi/logovanja.txt", "Podaci su ispravni, ali email adresa nije validirana");
                        }
                    } else {
                        $izlaz['greska'] = "Pogrešna lozinka za korisnika sa korisničkim imenom <b>$email</b>";
                        Log::upisiLog("../logovi/logovanja.txt", "Pogrešna lozinka za korisnika sa korisničkim imenom <b>$email</b> sa IP:" . $_SERVER['REMOTE_ADDR']);
                    }
                } else {
                    $izlaz['greska'] = "Ne postoji korisnik sa korisničkim imenom <b>$email</b>";
                    Log::upisiLog("../logovi/logovanja.txt", "Ne postoji korisnik sa korisničkim imenom <b>$email</b> sa IP:" . $_SERVER['REMOTE_ADDR']);
                }
            } else {
                $izlaz['greska'] = "Korisničko ime i lozinka sadrže nedozvoljene karaktere";
                Log::upisiLog("../logovi/logovanja.txt", "Korisničko ime i lozinka sadrže nedozvoljene karaktere sa IP:" . $_SERVER['REMOTE_ADDR']);
            }
        } else {
            $izlaz['greska'] = "Niste uneli sve podatke!!";
        }
    }
    echo JSON_encode($izlaz, 256);
}


if ($funkcija == "registracija") {
    if (isset($_POST['ime']) and isset($_POST['prezime']) and isset($_POST['email']) and isset($_POST['status'])) {
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $email = $_POST['email'];
        $lozinka = generisiLozinku();
        $status = $_POST['status'];
        $vkey = md5(time() . $ime);
        if ($ime != "" and $prezime != "" and $email != "" and $status != "0") {
            $sql = "SELECT email FROM korisnici WHERE email='{$email}'";
            $rez = $db->query($sql);
            if ($db->num_rows($rez) == 0) {
                $sql = "INSERT INTO korisnici (ime, prezime, email, lozinka,status,vkey) VALUES ('{$ime}', '{$prezime}', '{$email}', '{$lozinka}','{$status}','{$vkey}')";
                $db->query($sql);
                if ($db->error()) echo $db->error();
                else {
                    $poruka = "<h4>Uspešna registracija</h4><br>Korisničko ime: $email<br>Lozinka: $lozinka<br><br><a href='potvrda.php?vkey=$vkey' target='_blank'>http://localhost/ParentsTime/potvrda.php?vkey=$vkey</a>";
                    @mail($email, "Potvrda registracije - Lineweb", $poruka);
                    echo "Uspešna registracija!!!<br>Proverite mejl za potvrdu<br>" . $poruka;
                }
            } else {
                echo "Korisnik sa ovim email vec postoji";
                Log::upisiLog("../logovi/logovanja.txt", "Nisu uneti svi podaci za registraciju sa IP:" . $_SERVER['REMOTE_ADDR']);
            }
        } else {
            echo "Niste uneli sve podatke za registraciju";
            Log::upisiLog("../logovi/logovanja.txt", "Nisu uneti svi podaci za registraciju sa IP:" . $_SERVER['REMOTE_ADDR']);
        }
    } else {
        echo "Niste uneli sve podatke za registraciju";
        Log::upisiLog("../logovi/logovanja.txt", "Nisu uneti svi podaci za registraciju sa IP:" . $_SERVER['REMOTE_ADDR']);
    }
}

if ($funkcija == "lozinka") {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if ($email != "") {
            $novalozinka = generisiLozinku();
            $sql = "UPDATE korisnici SET lozinka='{$novalozinka}' WHERE email='{$email}'";
            $db->query($sql);
            if ($db->affected_rows() == 1) {
                $poruka = "<h4>Uspešna promena lozinke</h4><br>Korisničko ime: $email<br>Lozinka: $novalozinka<br>";
                @mail($email, "Potvrda registracije - Lineweb", $poruka);
                echo "Uspešna promena lozinke<br>Proverite mejl" . $poruka;
            } else
                echo "Korisnik sa tim mejlom nije registrovan";
        } else
            echo "Niste uneli email";
    }
}
