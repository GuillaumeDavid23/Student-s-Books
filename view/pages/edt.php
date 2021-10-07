<div class="row h-100 justify-content-center align-items-center m-0">
    <div class="d-flex justify-content-between justify-content-md-center mb-md-3">
        
        <a href="/index.php?page=3&day=<?= $currentDayNumber-1 ?>&idClass=<?= $selectClass ?? '' ?>" class="d-md-none"><i class="fas fa-chevron-circle-left fa-2x"></i></a>
        <?php if($_SESSION['user']->id_ranks == 3 || $_SESSION['user']->id_ranks == 4){ ?>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>&day=<?= $currentDayNumber ?>&idClass=<?= $selectClass ?? '' ?>" method="POST" id="formClass" class="d-flex align-items-center">
            <select name="selectClass" id="selectClass">
                <option value="">Sélectionner une classe</option>
                <?php 
                    foreach($classArray as $value){?>
                        <option <?= $test = $selectClass == $value['id'] ? 'selected' : '' ?> value='<?=$value['id']?>'><?= $value['class']?></option.> 
                    <?php }?>
            </select>
        </form>
        <?php } ?>
        <a href="/index.php?page=3&day=<?= $currentDayNumber+1 ?>&idClass=<?= $selectClass ?? '' ?>" class="d-md-none"><i class="fas fa-chevron-circle-right fa-2x "></i></a>
    </div>
    <?php if($code) :?>
        <div class="text-center h5 alert <?= $messageCode[$code]['type'] ?>">
            <?= $messageCode[$code]['msg'] ?>
        </div>
    <?php endif ?>
    <!-- VERSION DESKTOP -->
    <table class="text-center d-none d-md-table w-75">
        <tr>
            <th>Heure</th>
            <?php for($x = 1; $x < 6; $x++){ ?><!-- Affichage des nom des jours -->
                <th><?=$jour[$x] ?></th>
            <?php } ?> 
        </tr>
        <?php for($j = 8; $j < 18; $j += 1) { 
                
        ?> <!-- Heure -->
            <tr>
                <?php for($i = 0; $i < 5; $i++) //Jours en lignes
                {
                    if($i == 0) {
                        $heure = str_replace(".5", ":30", $j);
                        echo "<td class=\"time\">".$heure."</td>";
                    }
                    if(isset($rdv1[$jour[$i+1]][$heure])) {
                        $str = $rdv1[$jour[$i+1]][$heure];
                        $AddClass = ColorMatter($str);
                    }
                    
                    
                    if(isset($rdv1[$jour[$i+1]][$heure])) {
                        echo "<td ".' '.'class="'.$AddClass."\">";
                        echo $rdv1[$jour[$i+1]][$heure];
                        if($_SESSION['user']->id_ranks == 4){ 
                            $schedule = Schedule::SelectOne($arrayRdvId[$count]);
                            $matterRoom = explode(' ',$rdv1[$jour[$i+1]][$heure]);
                            ?>
                            
                            <button class="btn btn-sm btn-blue" data-bs-toggle="modal" data-bs-target="#modifModal<?= $arrayRdvId[$count] ?>"><i class="fas fa-pen"></i></button>
                            <!-- Modal modification -->
                            <div class="modal fade" id="modifModal<?= $arrayRdvId[$count] ?>" tabindex="-1" aria-labelledby="modifModalLabel<?= $arrayRdvId[$count] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content text-dark">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modifModalLabel<?= $arrayRdvId[$count] ?>">Modifier le devoir :</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="post" enctype='multipart/form-data'>
                                            <input type="hidden" name="idSchedule" value="<?=$arrayRdvId[$count]?>">
                                            <div class="mt-3">
                                                <label for="days">Choisir le jour :</label>
                                                <select name="days" id="days">
                                                    <option value=""></option>
                                                    <?php 
                                                        for($x = 1; $x < 6; $x++){?>
                                                            <option <?= $test = $jour[$x] == $jour[$i+1] ? 'selected' : '' ?> value='<?=$jour[$x]?>'><?=$jour[$x]?></option>
                                                        <?php } ?> 
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label for="slots">Crénaux :</label>
                                                <select name="slots" id="slots">
                                                    <option value=""></option>
                                                    <?php 
                                                        foreach($slotsArray as $value){ ?>
                                                            <option <?= $test = $heure == $value['slot'] ? 'selected' : '' ?> value='<?=$value['id']?>'><?=$value['slot']?>h</option>; 
                                                        <?php } ?> 
                                                </select>
                                            </div>
                                            <div class="mt-3 text-center">
                                                <label for="slots">Matière :</label>
                                                <select name="matters" id="matters">
                                                    <option value=""></option>
                                                    <?php 
                                                        foreach($mattersArray as $value){ 
                                                            ?>
                                                            <option <?= $test = $matterRoom[0] == $value['matter'] ? 'selected' : '' ?> value='<?=$value['id']?>'><?=$value['matter']?></option>
                                                        
                                                        <?php }?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label for="slots">Salle :</label>
                                                <select name="rooms" id="rooms">
                                                    <option value=""></option>
                                                    <?php 
                                                        foreach($roomsArray as $value){?> 
                                                            <option <?= $test = $matterRoom[2] == $value['room'] ? 'selected' : '' ?> value='<?=$value['id']?>'><?=$value['room']?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label for="slots">Classe :</label>
                                                <select name="class" id="class">
                                                    <option value=""></option>
                                                    <?php 
                                                        foreach($classArray as $value){?> 
                                                            <option <?= $test = $selectClass == $value['id'] ? 'selected' : '' ?> value='<?=$value['id']?>'><?=$value['class']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Modifier le cours</button>
                                            </form>
                                            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="post">
                                                <input type="hidden" name="idRemove" value="<?=$arrayRdvId[$count]?>">
                                                <button type="submit" class="btn btn-danger">Supprimer le cours</button>
                                            </form>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            $count++;
                        }
                        echo "</td>";
                    }else{
                        echo "<td></td>";
                    }
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
        <?php for($j = 8; $j < 18; $j += 1) { 
        ?> <!-- Heure -->
            <tr>
                <?php for($i = 0; $i < 1; $i++) //Jours en lignes
                {
                    if($i == 0) {
                        $heure = str_replace(".5", ":30", $j);
                        echo "<td class=\"time\">".$heure."</td>";
                    }
                 
                    if(isset($rdv1[$jour[$currentDayNumber]][$heure])) {
                        $str = $rdv1[$jour[$currentDayNumber]][$heure];
                        $AddClass = ColorMatter($str);
                        echo "<td ".' '.'class="'.$AddClass."\">";
                        echo $rdv1[$jour[$currentDayNumber]][$heure];
                        echo "</td>";
                    }else{
                        echo '<td></td>';
                    }
                    
                }?>
            </tr>
        <?php } ?>
    </table>

    <!-- Partie Admin -->
    <?php if($_SESSION['user']->id_ranks == 4){ ?>
        <div class="col-lg-6 mt-5 resumeBloc pt-3 pb-3 text-white ">
            <h4 class="text-center">Ajouter un cours</h4>
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
                                echo "<option value='".$value['id']."'>".$value['slot']."h</option>"; 
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
