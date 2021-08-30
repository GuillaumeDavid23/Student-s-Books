

    <div class="container-fluid h-100 p-0">
        <header class="w-100 mb-5 d-flex align-items-center">
            <img src="../public/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            <a href="../index.php" class="h-100 d-flex align-items-center">
                <img src="../public/img/backward.png" class="img-fluid" width="50" alt="">
            </a>
            <h1 class="ms-4 align-self-center text-center m-0">Agenda</h1>
        </header>

        <div class="row justify-content-center align-items-center">
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="formToCreateCalendar">
            <label for="date">Choisissez un mois et une année</label>
            <input type="month" name="month" id="date" required>
        </form>
        <h1 id="monthAndYear">
            <?php
                if (!$empty){
                    titleMonthAndYear();
                }
            ?>
        </h1>
        <div class="calendar">
        <table>
            <thead>
                <tr>
                    <?php
                        if (!$empty) {
                            CreateDays();
                        }
                    ?>
                </tr>
            </thead>
            <tbody id="calendarTable">
                <?php
                    if (!$empty) {
                        CreateCalendar();
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="add">
    <?php if($code) :?>
        <div class="text-center h5 alert <?= $messageCode[$code]['type'] ?>">
            <?= $messageCode[$code]['msg'] ?>
        </div>
    <?php endif ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="text-center">
        <input type="hidden" name="month" value="<?= $_POST['month'] ?? '' ?>">
        <label for="dateEvent">Date de l'événement</label>
        <input type="date" name="dateEvent" id="dateEvent" class="form-control" required>
        <label for="eventName">Nom de l'événement</label>
        <input type="text" name="eventName" id="eventName" class="form-control" required>
        <button type="submit" id="addEvent" class="btn btn-info">Ajouter l'évènement</button>
    </form>
    </div>
        </div>
        <div class="row justify-content-evenly w-100 d-none d-lg-flex">
            <div class="col-1 navBtnMob">
                <a href="../controller/assignmentCtrl.php">
                    <img src="../public/img/devoirs.webp" class="img-fluid" width="100" alt="Page des devoirs" title="Vers les devoirs..">
                </a>
            </div>
            <div class="col-1 navBtnMob ">
                <a href="../controller/noteCtrl.php">
                    <img src="../public/img/LogoNote.webp" class="img-fluid" width="100" alt="Page des notes" title="Vers les notes..">
                </a>
            </div>
            <div class="col-1 navBtnMob">
                <a href="edt.php">
                    <img src="../public/img/Edt.webp" class="img-fluid" width="100" alt="Page emploi du temps" title="Vers l'emploi du temps..">
                </a>
            </div>
            <div class="col-1  navBtnMob">
                <a href="absences.php">
                    <img src="../public/img/absences.webp" class="img-fluid" width="100" alt="Page des absences" title="Vers les absences..">
                </a>
            </div>
            <div class="col-1 navBtnMob">
                <a href="tchat.php">
                    <img src="../public/img/message.png" class="img-fluid" width="100" alt="Page de la messagerie" title="Vers la messagerie..">
                </a>
            </div>
        </div>
        <footer class="d-flex flex-column justify-content-center align-items-center">
            <a href="view/mention.php" class="text-white " data-bs-toggle="modal" data-bs-target="#exampleModal">Un
                problème ?</a>
            <a href="view/mention.php" class="text-white">Mentions légales</a>
        </footer>
    </div>
    <!-- Script -->
    <script src="../public/js/agenda.js"></script>
    <!-- Bootstrap JavaScript -->

    <script src="../public/js/bootstrap/bootstrap.js"></script>
</body>

</html>