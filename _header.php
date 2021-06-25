<?php

require_once("require.php");
?>

<body>

    <header id="header">

        <div id="headerTop">
            <div class="wrapper">
                <div id="headerTopLeft">
                    <span><i class="fa fa-lg fa-phone"></i>&nbsp;&nbsp;&nbsp;061/ 108 00 04</span>
                    <span><i class="fa fa-lg fa-envelope-o"></i>&nbsp;&nbsp;&nbsp;contact.parentstime@gmail.com</span>
                </div>
                <div id="headerTopRight">
                    <a href="#" target="_blank"><i class="fa fa-lg fa-facebook-square"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-lg fa-linkedin-square"></i></a>
                </div>
            </div>
        </div>

        <div id="headerBottom">
            <div class="wrapper">

                <div id="logo">
                    <a href="index.php">
                        <img src="images/logotop.png" alt="logo">
                    </a>
                </div>

                <nav id="nav">
                    <ul>
                        <li><a href="about_us.php">O nama</a></li>
                        <li><a href="babysiter.php">Dadilje</a></li>
                        <li><a href="contact.php">Kontakt</a></li>

                        <?php
                        if (login()) {
                            //echo "<li><a href='prijava.php?odjava' title='Odjava'>{$_SESSION['ime']} ({$_SESSION['status']})</a></li>";
                            echo "<li><a href='#'>{$_SESSION['ime']} ({$_SESSION['status']})</a>
					<ul>";
                            if ($_SESSION['status'] == "admin") {
                                echo "<li><a href='profil_main.php?id={$_SESSION['id']}'>Izmeni profil</a></li>";
                                echo "<li><a href='korisnici.php'>Izbrisi korisnika</a></li>";
                                echo "<li><a href='bzahtev.php'>Zahtevi za cuvanje</a></li>";
                                echo "<li><a href='adminKomentari.php'>Komentari</a></li>";
                                echo "<li><a href='poruke.php'>Vase poruke</a></li>";
                                echo "<li><a href='logovi.php'>Logovi</a></li>";
                                echo "<li><a href='logout.php'>Odjava</a></li>";
                            } else if ($_SESSION['status'] == "Dadilja") {

                                echo "<li><a href='izmenaDadilja.php?id={$_SESSION['id']}'>Izmeni profil</a></li>
                                    <li><a href='bzahtev.php'>Zahtevi za cuvanje</a></li>
                                     <li><a href='poruke.php'>Vase poruke</a></li>
                                    <li><a href='logout.php'>Odjava</a></li>
                                    </ul>
                                    </li>";
                            } else if ($_SESSION['status'] == "Roditelj")

                                echo "<li><a href='izmeniRoditelj.php?id={$_SESSION['id']}'>Izmeni profil</a></li>
                                <li><a href='bzahtev.php'>Zahtevi za cuvanje</a></li>
                                 <li><a href='poruke.php'>Vase poruke</a></li>
                                <li><a href='logout.php'>Odjava</a></li>
                                </ul>
                                </li>";
                        } else
                            echo "<li><a href='register.php'>Registruj se</a></li>
                            <li><a  href='prijava.php'>Prijava</a></li>";

                        ?>


                    </ul>

                    </ul>
                    <a href="#" id="respmenu" class="but"><i class="fa fa-lg fa-navicon"></i>&nbsp;&nbsp;&nbsp;&nbsp;Navigation</a>
                </nav>

            </div>
        </div>

    </header><!-- kraj #header -->