<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.zonas'); ?></h1>
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
                                <!-- Campo descripcion -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="descripcion"><?php echo lang('Translate.descripcion'); ?></label>
                                    <input class="form-control py-2" id="descripcion" name="descripcion" type="text"
                                        placeholder="<?php echo lang('Translate.introduzcaDescripcion'); ?>" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->DESCRIPCION;
                                        }  
                                        else{
                                            echo set_value('descripcion');
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

