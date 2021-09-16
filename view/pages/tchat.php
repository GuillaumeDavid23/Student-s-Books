<div class="row h-25 justify-content-center">
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
                    <img src="/public/img/envoie.png" alt="Bouton enoyer un message dans le tchat"
                        class="img-fluid w-75">
                </button>
            </div>
            <textarea type="text" name="" id="chatInput"></textarea>
        </div>
    </div>
</div>
<script src="/public/js/chat.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>