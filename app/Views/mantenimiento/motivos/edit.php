<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Motivos</h1>
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
                                <!-- Campo Descripción -->
                                <div class="form-group">
                                    <label class="small mb-1" for="nombre">Motivo</label>
                                    <input class="form-control py-2" id="nombre" name="nombre" type="text"
                                        placeholder="Introduce motivo" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Motivo;
                                        }  
                                        else{
                                            echo set_value('nombre');
                                        }
                                        ?>" />
                                    <input class="form-control py-2" id="id" name="id" type="hidden"
                                        placeholder="Introduce motivo" value="" />
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
                                echo 'Actualizar';
                            }
                            else
                            {
                                echo 'Crear';
                            }
                            ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

