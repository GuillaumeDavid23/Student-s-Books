<div class="row h-100 justify-content-center align-items-center m-0">
    <div class="d-flex justify-content-between">
        <a href="/index.php?page=3&day=<?= $currentDayNumber-1 ?>"><i class="fas fa-chevron-circle-left fa-2x"></i></a>

        <a href="/index.php?page=3&day=<?= $currentDayNumber+1 ?>"><i class="fas fa-chevron-circle-right fa-2x"></i></a>
    </div>
    <!-- VERSION DESKTOP -->
    <table class="text-center d-none d-md-table w-75">
        <tr>
            <th>Heure</th>
            <?php for($x = 1; $x < 6; $x++){ ?><!-- Affichage des nom des jours -->
                <th><?=$jour[$x] ?></th>
            <?php } ?> 
        </tr>
        <?php for($j = 8; $j < 18; $j += 1) { ?> <!-- Heure -->
            <tr>
                <?php for($i = 0; $i < 5; $i++) //Jours en lignes
                {
                    if($i == 0) {
                        $heure = str_replace(".5", ":30", $j);
                        echo "<td class=\"time\">".$heure."</td>";
                    }
                    echo "<td>";
                    if(isset($rdv1[$jour[$i+1]][$heure])) {
                        echo $rdv1[$jour[$i+1]][$heure];
                    }
                    echo "</td>";
                }?>
            </tr>
        <?php } ?>
    </table>

    <!-- VERSION MOBILE -->
    <table class="text-center d-md-none d-sm-table"> 
        <tr>
            <th>Heure</th>
            <!-- Affichage du jour -->
            <th><?=$jour[$currentDayNumber] ?></th>
        </tr>
        <?php for($j = 8; $j < 18; $j += 1) { ?> <!-- Heure -->
            <tr>
                <?php for($i = 0; $i < 1; $i++) //Jours en lignes
                {
                    if($i == 0) {
                        $heure = str_replace(".5", ":30", $j);
                        echo "<td class=\"time\">".$heure."</td>";
                    }
                    echo "<td>";
                    if(isset($rdv1[$jour[$currentDayNumber]][$heure])) {
                        echo $rdv1[$jour[$currentDayNumber]][$heure];
                    }
                    echo "</td>";
                }?>
            </tr>
        <?php } ?>
    </table>

    <!-- Partie Admin -->
    <?php if($_SESSION['user']->id_ranks == 3){ ?>
        <div class="col-lg-6 mt-5 resumeBloc pt-3 pb-3 text-white ">
            <h4 class="text-center">Ajouter ou modifier l'emploi du temps</h4>
            <?php if($code) :?>
                <div class="text-center h5 alert <?= $messageCode[$code]['type'] ?>">
                    <?= $messageCode[$code]['msg'] ?>
                </div>
            <?php endif ?>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="POST" class="d-flex flex-column align-items-center">
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
                <div class="mt-3 text-center">
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
                <div class="mt-3">
                    <label for="slots">Classe :</label>
                    <select name="class" id="class">
                        <option value=""></option>
                        <?php 
                            foreach($classArray as $value) //Affichage des nom des jour
                                echo "<option value='".$value['id']."'>".$value['class']."</option>"; 
                        ?>
                    </select>
                </div>
                <button class="mt-3 btn btn-success" type="submit">Ajouter</button>
            </form>
        </div>
    <?php } ?>
</div>
