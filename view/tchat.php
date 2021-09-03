<div class="row h-100 justify-content-center">
    <div class="col-10 h-100 col-md-4 p-0" id="chatBloc">
        <div id="topChat" class="d-flex">
            <div id="chatContact" class="d-flex flex-column align-items-center pt-1">
                <strong>Connecté :</strong> 
                <div id="connected" class="rounded-circle bg-light text-success mt-2 d-flex justify-content-center align-items-center"
                    style="width: 50px; height: 50px;">
                    <!-- Code js ICI -->
                </div>
            </div>
            <div id="chatMessage" class="text-white overflow-scroll d-flex flex-column w-100" data-id="<?= $_SESSION['id'] ?>">
                
            </div>
        </div>
        <div id="chatBar" class="d-flex">
            <div id="chatBtnBloc">
                <button type="submit" id="chatBtnSend">
                    <img src="../public/img/envoie.png" alt="Bouton envoyer un message dans le tchat"
                        class="img-fluid w-50">
                </button>
            </div>
            <textarea type="text" name="message" id="chatInput"></textarea>
        </div>
    </div>
</div>
<script src="../public/js/chat.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>