<div class="row h-25 justify-content-center">
    <?php if($_SESSION['user']->id_ranks == 4 || $_SESSION['user']->id_ranks == 3){ ?>
        <div class="col-12 d-flex justify-content-center">
            <h3>Selectionner une classe</h3>
            <select name="idClass" id="idClass">
                <option value="0"></option>
                <?php foreach ($allClasses as  $class) { ?>
                    <option value="<?= $class['id'] ?>"><?= $class['class'] ?></option>
                <?php } ?>
            </select>
        </div>
    <?php } ?>
    <div class="col-10 col-md-6 h-100 p-0 resumeBloc" id="chatBloc">
        <div id="topChat" class="d-flex">
            <div id="chatContact" class="d-flex flex-column align-items-center pt-1 p-2">
                <strong class="text-center">En ligne :</strong> 
                <div id="connected" class="rounded-circle bg-light text-success mt-2 d-flex justify-content-center align-items-center"
                    style="width: 50px; height: 50px;">
                    <!-- Code js ICI -->
                </div>
            </div>
            <div id="chatMessage" class="text-white overflow-scroll d-flex flex-column w-100" data-id="<?= $_SESSION['user']->id ?>">

            </div>
        </div>
        <div id="chatBar" class="d-flex">
            <div id="chatBtnBloc">
                <button id="chatBtnSend" class="btn btn-primary">
                    <i class="fas fa-paper-plane fa-lg"></i>
                </button>
            </div>
            <textarea type="text" name="" id="chatInput"></textarea>
        </div>
    </div>
</div>

<script src="/public/js/chat.js"></script>