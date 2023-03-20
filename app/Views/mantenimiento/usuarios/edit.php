<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.usuarios'); ?></h1>
                <div clas="row">
                    <div class="container mt-4">
                    <?php if(session()->get('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif;
                    if(session()->get('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->get('error') ?>
                        </div>
                    <?php endif; ?>   

                    <form class="" action="<?= $action ?>" method="post">
                        <div class="form-row">
                            <div class="col-md-12">                    
                                <!-- Campo Nombre -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="nombre"><?php echo lang('Translate.nombre'); ?></label>
                                    <input class="form-control py-2" id="nombre" name="nombre" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaNombre'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Nombre;
                                        }  
                                        else{
                                            echo set_value('nombre');
                                        }
                                        ?>" />                                    
                                </div> 
                                <!-- Campo Apellido1 -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="apellido1"><?php echo lang('Translate.apellido1'); ?></label>
                                    <input class="form-control py-2" id="apellido1" name="apellido1" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaApellido1'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Apellido1;
                                        }  
                                        else{
                                            echo set_value('apellido1');
                                        }
                                        ?>" />
                                </div>
                                <!-- Campo Apellido2 -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="apellido2"><?php echo lang('Translate.apellido2'); ?></label>
                                    <input class="form-control py-2" id="apellido2" name="apellido2" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaApellido2'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Apellido2;
                                        }  
                                        else{
                                            echo set_value('apellido2');
                                        }
                                        ?>" />
                                </div>                               
                                <!-- Campo Usuario -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="usuario"><?php echo lang('Translate.usuario'); ?></label>
                                    <input class="form-control py-2" id="usuario" name="usuario" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaUsuario'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Usuario;
                                        }  
                                        else{
                                            echo set_value('usuario');
                                        }
                                        ?>" />
                                </div>
                                <!-- Campo Contraseña -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="contrasena"><?php echo lang('Translate.contraseña'); ?></label>
                                    <input class="form-control py-2" id="contrasena" name="contrasena" type="password"
                                        placeholder="<?php echo lang('Translate.introduzcaContrasena'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            
                                        }  
                                        else{
                                            echo set_value('contrasena');
                                        }
                                        ?>" />
                                </div>
                                <!-- Checks secciones -->
                                <div class="form-group">
                                        <label class="medium mb-1" for="secciones"><?php echo lang('Translate.secciones'); ?>:</label>
                                        <?php if (isset($secciones)) {
                                            foreach ($secciones as $seccion) { ?>
                                                <label class="small mb-1" for="seccion"><?php echo $seccion->Descripción; ?></label>
                                                <input class="" type="checkbox" id="seccion<?php echo $seccion->ID; ?>" value="<?php echo $seccion->ID ?>"
                                                <?php if (isset($seccionesUsuario)) {
                                                        foreach ($seccionesUsuario as $seccionUsuario) {                                                
                                                        if ($seccion->ID == $seccionUsuario->SECCION_ID) {
                                                            echo 'checked';
                                                        } 
                                                    }
                                                } ?>
                                                name="seccion[]" />
                                            <?php
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>

                        <!-- Errores de formulario -->
                        <?php if (isset($validation)){ ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="col-12 form-group mt-4 mb-0">
                            <button class="btn btn-primary btn-block" type="submit"><?php if (isset($data[0]))
                            { 
                                echo lang('Translate.actualizar');
                            } else {
                                echo lang('Translate.crear');
                            }
                            ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

