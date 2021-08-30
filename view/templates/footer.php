        <div class="row justify-content-evenly w-100 d-none d-lg-flex">
            <?php
                if($adresse == '/controller/assignmentCtrl.php'){
                        echo '
                    <div class="col-1 navBtnMob">
                        <a href="../controller/noteCtrl.php">
                            <img src="../public/img/LogoNote.webp" class="img-fluid" width="100" alt="Page des devoirs" title="Vers les devoirs..">
                        </a>
                    </div>
                    <div class="col-1 navBtnMob">
                        <a href="../controller/edtCtrl.php">
                            <img src="../public/img/Edt.webp" class="img-fluid" width="100" alt="Page emploi du temps" title="Vers l\'emploi du temps..">
                        </a>
                    </div>
                    <div class="col-1 navBtnMob">
                        <a href="absences.php">
                            <img src="../public/img/absences.webp" class="img-fluid" width="100"  alt="Page des absences" title="Vers les absences..">
                        </a>
                    </div>
                    <!-- <div class="col-1 navBtnMob ">
                        <a href="agenda.php">
                            <img src="../public/img/agenda.png" class="img-fluid" width="100" alt="Page de l\'agenda" title="Vers les agenda..">
                        </a>
                    </div> -->
                    <div class="col-1 navBtnMob">
                        <a href="tchat.php">
                            <img src="../public/img/message.png" class="img-fluid" width="100" alt="Page de la messagerie" title="Vers la messagerie..">
                        </a>
                    </div>
                    ';
                }
                elseif($adresse == '/controller/noteCtrl.php'){
                        echo '
                        <div class="col-1 navBtnMob">
                            <a href="../controller/assignmentCtrl.php">
                                <img src="../public/img/devoirs.webp" class="img-fluid" width="100" alt="Page des devoirs" title="Vers les devoirs..">
                            </a>
                        </div>
                        <div class="col-1 navBtnMob">
                            <a href="../controller/edtCtrl.php">
                                <img src="../public/img/Edt.webp" class="img-fluid" width="100" alt="Page emploi du temps" title="Vers l\'emploi du temps..">
                            </a>
                        </div>
                        <div class="col-1 navBtnMob">
                            <a href="absences.php">
                                <img src="../public/img/absences.webp" class="img-fluid" width="100"  alt="Page des absences" title="Vers les absences..">
                            </a>
                        </div>
                        <!-- <div class="col-1 navBtnMob ">
                            <a href="agenda.php">
                                <img src="../public/img/agenda.png" class="img-fluid" width="100" alt="Page de l\'agenda" title="Vers les agenda..">
                            </a>
                        </div> -->
                        <div class="col-1 navBtnMob">
                            <a href="tchat.php">
                                <img src="../public/img/message.png" class="img-fluid" width="100" alt="Page de la messagerie" title="Vers la messagerie..">
                            </a>
                        </div>
                        ';
                }
                elseif($adresse == '/controller/edtCtrl.php'){
                    echo '
                        <div class="col-1 navBtnMob">
                            <a href="../controller/assignmentCtrl.php">
                                <img src="../public/img/devoirs.webp" class="img-fluid" width="100" alt="Page des devoirs" title="Vers les devoirs..">
                            </a>
                        </div>
                        <div class="col-1 navBtnMob">
                            <a href="../controller/noteCtrl.php">
                                <img src="../public/img/LogoNote.webp" class="img-fluid" width="100" alt="Page des devoirs" title="Vers les devoirs..">
                            </a>
                        </div>
                        <div class="col-1 navBtnMob">
                            <a href="../controller/absencesCtrl.php">
                                <img src="../public/img/absences.webp" class="img-fluid" width="100"  alt="Page des absences" title="Vers les absences..">
                            </a>
                        </div>
                        <!-- <div class="col-1 navBtnMob ">
                            <a href="agenda.php">
                                <img src="../public/img/agenda.png" class="img-fluid" width="100" alt="Page de l\'agenda" title="Vers les agenda..">
                            </a>
                        </div> -->
                        <div class="col-1 navBtnMob">
                            <a href="tchat.php">
                                <img src="../public/img/message.png" class="img-fluid" width="100" alt="Page de la messagerie" title="Vers la messagerie..">
                            </a>
                        </div>
                    ';
                }
                elseif($adresse == '/controller/absencesCtrl.php'){
                    echo '
                        <div class="col-1 navBtnMob">
                            <a href="../controller/assignmentCtrl.php">
                                <img src="../public/img/devoirs.webp" class="img-fluid" width="100" alt="Page des devoirs" title="Vers les devoirs..">
                            </a>
                        </div>
                        <div class="col-1 navBtnMob">
                            <a href="../controller/noteCtrl.php">
                                <img src="../public/img/LogoNote.webp" class="img-fluid" width="100" alt="Page des devoirs" title="Vers les devoirs..">
                            </a>
                        </div>
                        <div class="col-1 navBtnMob">
                            <a href="edt.php">
                                <img src="../public/img/Edt.webp" class="img-fluid" width="100" alt="Page emploi du temps" title="Vers l\'emploi du temps..">
                            </a>
                        </div>
                        <!-- <div class="col-1 navBtnMob ">
                            <a href="agenda.php">
                                <img src="../public/img/agenda.png" class="img-fluid" width="100" alt="Page de l\'agenda" title="Vers les agenda..">
                            </a>
                        </div> -->
                        <div class="col-1 navBtnMob">
                            <a href="tchat.php">
                                <img src="../public/img/message.png" class="img-fluid" width="100" alt="Page de la messagerie" title="Vers la messagerie..">
                            </a>
                        </div>
                    ';
                }
            ?>
        </div>
        
        <footer class="d-flex flex-column justify-content-center align-items-center">

            <a href="#" class="text-white " data-bs-toggle="modal" data-bs-target="#exampleModal">
                Un problème ?
            </a>
            <a href="/view/mention.php" class="text-white">Mentions légales</a>
        </footer>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Un problème ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body d-flex flex-column">
                        <label for="object" class="mb-2">Titre de votre demande</label>
                        <input type="text" name="object" id="object" class="mb-3">
                        <label for="prob">Décrivez votre problème</label>
                        <textarea name="prob" id="prob" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info text-white">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="../public/js/main.js"></script>
    <script src="/public/js/bootstrap/bootstrap.js"></script>
</body>

</html>