<?php
session_start();
require_once("require.php");

$db = new Baza();
$db->connect();
$poruka = "";

?>

<?php
if (login()) {


    $upit = "SELECT * FROM korisnici WHERE id={$_SESSION['id']}";
    $rez = $db->query($upit);
    $red = $db->fetch_object($rez);
    if ($red->prvi == 1) {
        if ($_SESSION['status'] == "Dadilja") {
            header('Location: setDadilja.php');
        } else {
            header('Location: setRoditelj.php');
        }
    } else
        header('Location: front.php');
} else
    header('Location:  front.php');
?>

