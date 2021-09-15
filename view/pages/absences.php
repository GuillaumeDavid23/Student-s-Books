<?php if($_SESSION['user']->id_ranks == 3 || $_SESSION['user']->id_ranks == 4){ ?>
    <div class="row justify-content-center justify-content-lg-evenly mb-5">
        <div class="col-10 col-lg-6 resumeBloc overflow-visible h-100 pt-3 pb-3 d-flex flex-column align-items text-white">
            
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="post" class="d-flex flex-column h-100 align-items-center justify-content-center">
                <h3 class="mb-3 text-decoration-underline">Ajouter une absence</h3>      
                <div class="mb-3 text-center">
                    <label for="start_date">Date de début d'absence : </label>
                    <input type="date" name="start_date" id="start_date">
                </div>
                <div class="mb-3">
                    <label for="end_date">Heure de début d'absence : </label>
                    <input type="time" name="start_hour" id="start_hour">
                </div>
                <div class="mb-3 text-center">
                    <label for="end_date">Date de fin d'absence : </label>
                    <input type="date" name="end_date" id="end_date">
                </div>
                <div class="mb-3">
                    <label for="end_date">Heure de fin d'absence : </label>
                    <input type="time" name="end_hour" id="end_hour">
                </div>
                <div class="mb-3">
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
            $timestamp_start = strtotime($absencesObj->start_date.' '.$absencesObj->start_hour);
            $timestamp_end = strtotime($absencesObj->end_date.' '.$absencesObj->end_hour);

            $day_start = strftime('%d', $timestamp_start);
            $month_start = strftime('%B', $timestamp_start);

            $day_end = strftime('%d', $timestamp_end);
            $month_end = strftime('%B', $timestamp_end);

            if($_SESSION['user']->id == $absencesObj->id_users ){?>
                <div class="absentEl d-flex w-100 mb-2">
                    <div class="absentDateBloc ">
                        <div id="absentBloc" class="text-center fw-bold text-white subInfo ps-2 pe-2"><?= $day_start.' au '.$day_end.'<br>'.$month_start ?></div>
                    </div>
                    <div class="ps-1 w-100 bg-egg d-flex align-items-center">
                        <div id="reasonBloc" class="fw-bold">
                            <span id="reason"><?= $absencesObj->justification ?> - de <?= date('H:i', $timestamp_start) ?> à <?= date('H:i', $timestamp_end) ?> </span>
                        </div>
                    </div>
                </div>
        <?php }} ?>
        
    </div>
</div>
<?php } ?>