<div class="row justify-content-center align-items-center h-100">
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="POST" id="formToCreateCalendar">
        <label for="date">Choisissez un mois et une année</label>
        <input type="month" name="month" id="date" required>
    </form>
    <h1 id="monthAndYear">
        <?php
            titleMonthAndYear();
        ?>
    </h1>
    <div class="calendar">
        <table>
            <thead>
                <tr>
                    <?php
                        CreateDays();
                    ?>
                </tr>
            </thead>
            <tbody id="calendarTable">
                <?php
                    CreateCalendar();
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
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="POST" class="text-center resumeBloc p-5 mb-3 text-white">
            <h2>Ajout d'un évenement</h2>
            <input type="hidden" name="month" value="<?= $_POST['month'] ?? '' ?>">
            <label for="dateEvent">Date de l'événement</label>
            <input type="date" name="dateEvent" id="dateEvent" class="form-control" required>
            <label for="eventName">Nom de l'événement</label>
            <input type="text" name="eventName" id="eventName" class="form-control" required>
            <button type="submit" id="addEvent" class="btn btn-info mt-3">Ajouter l'évènement</button>
        </form>
    </div>
</div>