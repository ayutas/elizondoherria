<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <?php
                        // Comprobamos si en la sesión nos devuelve un succes cuando se han registrado 
                        if(session()->get('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                        <?php endif;
                        if(session()->get('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->get('error') ?>
                        </div>
                        <?php endif; ?>

                        <h1 class="text-center"><?php echo lang('Translate.iniciarSesion'); ?></h1>
                        <br>
                        <form action="<?= base_url()?>/" method="post">
                            <!-- <p class="text-muted">Sign In to your account</p> -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="<?= base_url()?>/assets/icons/svg/free.svg#cil-user">
                                            </use>
                                        </svg>
                                    </span>
                                </div>
                                <input class="form-control py-2" type="text" name="email" placeholder="<?php echo lang('Translate.introduzcaUsuario'); ?>"
                                    value="<?= set_value('email') ?>">
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use
                                                xlink:href="<?= base_url()?>/assets/icons/svg/free.svg#cil-lock-locked">
                                            </use>
                                        </svg>
                                    </span>
                                </div>
                                <input class="form-control py-2" type="password" id="password" name="password"
                                    placeholder="<?php echo lang('Translate.introduzcaContrasena'); ?>">
                            </div>
                            <div id="divMayus" style="visibility:hidden"><?php echo lang('Translate.mayusculasActivo'); ?></div> <br>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary px-4" type="submit"><?php echo lang('Translate.iniciarSesion'); ?></button>
                                </div>
                            </div>
                            <?php
                            // Mostramos los mensajes de error
                            if (isset($validation)){ ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                            <?php }?>

                        </form>
                    </div>
                </div>
                <div class="card text-white py-5 d-md-down-none" style="width:50%;background-color:#3c4b64;">
                    <div class="card-body h-100 text-center">
                        <div class="row  h-100 align-items-center text-center">
                            <div class="col-12 mx-auto">
                                <img class="img-fluid" src="<?= base_url()?>/assets/images/Logo.png" alt="ELIZONDOKO HILERRIA">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    document.getElementById('password').addEventListener("keyup", function(event) {
        
        if (event.getModifierState("CapsLock")) {
            console.log("entro");
            $("#password")
                .popover({
                    placement:'bottom',
                    // title: '¡¡ Atención !!',
                    content: "<?php echo lang('Translate.mayusculasActivo'); ?>"
                });                
                $("#password").popover('show');            
        }else{
            $('#password').popover('hide');
        };        
    });
});
</script>