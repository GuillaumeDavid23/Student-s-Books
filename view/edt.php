
    <div class="container-fluid h-100 p-0">
        <header class="w-100 mb-5 d-flex align-items-center">
            <img src="../public/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            <a href="../index.php" class="h-100 d-flex align-items-center">
                <img src="../public/img/backward.png" class="img-fluid" width="50" alt="">
            </a>
            <h1 class="ms-4 align-self-center text-center m-0">Emploi du temps</h1>
        </header>
        <div class="row justify-content-center justify-content-lg-evenly mb-5 p-5">
            <table class="text-center">
                <?php
                    echo "<tr><th>Heure</th>";
                    for($x = 1; $x < 6; $x++) //Affichage des nom des jour
                        echo "<th>".$jour[$x]."</th>";
                    echo "</tr>";
                    for($j = 8; $j < 18; $j += 1) { //HEURE
                        echo "<tr>";
                        for($i = 0; $i < 5; $i++) { //JOUR en ligne
                            if($i == 0) {
                                $heure = str_replace(".5", ":30", $j);
                                echo "<td class=\"time\">".$heure."</td>";
                            }
                            echo "<td>";
                            if(isset($rdv[$jour[$i+1]][$heure])) {
                                echo $rdv[$jour[$i+1]][$heure];
                            }
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
