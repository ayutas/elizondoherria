<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.secciones'); ?></h1>
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
                            <div class="col-md-6">
                                <!-- Campo Descripcion -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="descripcion"><?php echo lang('Translate.descripcion'); ?></label>
                                    <input class="form-control py-2" id="descripcion" name="descripcion" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaDescripcion'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Descripcion;
                                        }  
                                        else{
                                            echo set_value('descripcion');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">    
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
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">                        
                                <!-- Campo Domicilio -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="domicilio"><?php echo lang('Translate.domicilio'); ?></label>
                                    <input class="form-control py-2" id="domicilio" name="domicilio" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaDomicilio'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Domicilio;
                                        }  
                                        else{
                                            echo set_value('domicilio');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo Poblacion -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="poblacion"><?php echo lang('Translate.poblacion'); ?></label>
                                    <input class="form-control py-2" id="poblacion" name="poblacion" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaPoblacion'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Poblacion;
                                        }  
                                        else{
                                            echo set_value('poblacion');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo CPostal -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="cpostal"><?php echo lang('Translate.cpostal'); ?></label>
                                    <input class="form-control py-2" id="cpostal" name="cpostal" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaCPostal'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->CPostal;
                                        }  
                                        else{
                                            echo set_value('cpostal');
                                        }
                                        ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">                        
                                <!-- Campo Cuenta -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="cuenta"><?php echo lang('Translate.cuenta'); ?></label>
                                    <input class="form-control py-2" id="cuenta" name="cuenta" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaCuenta'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Cuenta;
                                        }  
                                        else{
                                            echo set_value('cuenta');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo BIC -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="bic"><?php echo lang('Translate.bic'); ?></label>
                                    <input class="form-control py-2" id="bic" name="bic" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaBic'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->BIC;
                                        }  
                                        else{
                                            echo set_value('bic');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo Identificador -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="identificador"><?php echo lang('Translate.identificador'); ?></label>
                                    <input class="form-control py-2" id="identificador" name="identificador" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaIdentificador'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Identificador;
                                        }  
                                        else{
                                            echo set_value('identificador');
                                        }
                                        ?>" />
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

