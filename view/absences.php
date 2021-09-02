<?php if($_SESSION['rank'] == 3){ ?>
    <div class="row h-50 justify-content-center justify-content-lg-evenly mb-5">
        <div class="col-10 col-lg-6 resumeBloc h-100 d-flex flex-column align-items ">
            <h3 class="mb-3">Ajouter une absence</h3>  
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="">
                <div>
                    <label for="start_date">Date de début d'absence : </label>
                    <input type="date" name="start_date" id="start_date">
                </div>
                <div>
                    <label for="end_date">Heure de début d'absence : </label>
                    <input type="time" name="start_hour" id="start_hour">
                </div>
                <div>
                    <label for="end_date">Date de fin d'absence : </label>
                    <input type="date" name="end_date" id="end_date">
                </div>
                <div>
                    <label for="end_date">Heure de fin d'absence : </label>
                    <input type="time" name="end_hour" id="end_hour">
                </div>
                <div>
                    <label for="end_date">Heure de fin d'absence : </label>
                    <input type="time" name="end_hour" id="end_hour">
                </div>
                <button type="submit" class="btn btn-success">Ajouter absence</button>
            </form>
        </div>
    </div>
<?php }else{ ?>
<div class="row h-50 justify-content-center justify-content-lg-evenly mb-5">
    <div class="col-10 col-lg-6 resumeBloc h-100">
        <h2>Absences</h2>
        <?php foreach ($absencesArray as $absencesObj) { 
            $users = new User($absencesObj->id_users);
            $find = $users->SelectOne();
            $timestamp_start = strtotime($absencesObj->start_date.' '.$absencesObj->start_hour);
            $timestamp_end = strtotime($absencesObj->end_date.' '.$absencesObj->end_hour);
            $date = strftime('%d %B', $timestamp_start);
            if($_SESSION['id'] == $find->id ){?>
                <div class="absentEl d-flex w-100 mb-2">
                    <div class="absentDateBloc">
                        <div id="absentBloc" class="text-center fw-bold text-white subInfo"><?= $date ?></div>
                    </div>
                    <div class="ps-1 w-100 bg-egg d-flex align-items-center">
                        <div id="reasonBloc" class="fw-bold">
                            <span id="reason"><?= $absencesObj->justification ?> - <?= date('H:i', $timestamp_start) ?> heures à <?= date('H:i', $timestamp_end) ?> </span>
                        </div>
                    </div>
                </div>
        <?php }} ?>
        
    </div>
</div>
<?php } ?>