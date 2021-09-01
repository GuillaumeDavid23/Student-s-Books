
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
                            if(isset($rdv1[$jour[$i+1]][$heure])) {
                                echo $rdv1[$jour[$i+1]][$heure];
                            }
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
            <?php if($_SESSION['rank'] == 4){ ?>
                <div class="mt-5">
                    <h4 class="text-center">Ajouter ou modifier l'emploi du temps</h4>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="d-flex flex-column align-items-center">
                        <div class="mt-3">
                            <label for="days">Choisir le jour :</label>
                            <select name="days" id="days">
                                <option value=""></option>
                                <?php 
                                    for($x = 1; $x < 6; $x++) //Affichage des nom des jour
                                        echo "<option value='$jour[$x]'>".$jour[$x]."</option>"; 
                                ?>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="slots">Crénaux :</label>
                            <select name="slots" id="slots">
                                <option value=""></option>
                                <?php 
                                    foreach($slotsArray as $value) //Affichage des nom des jour
                                        echo "<option value='".$value['id']."'>".$value['slot']."</option>"; 
                                ?>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="slots">Matière :</label>
                            <select name="matters" id="matters">
                                <option value=""></option>
                                <?php 
                                    foreach($mattersArray as $value) //Affichage des nom des jour
                                        echo "<option value='".$value['id']."'>".$value['matter']."</option>"; 
                                ?>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="slots">Salle :</label>
                            <select name="rooms" id="rooms">
                                <option value=""></option>
                                <?php 
                                    foreach($roomsArray as $value) //Affichage des nom des jour
                                        echo "<option value='".$value['id']."'>".$value['room']."</option>"; 
                                ?>
                            </select>
                        </div>

                        <button class="mt-3" type="submit">Ajouter</button>
                    </form>
                </div>
            <?php } ?>
        </div>
