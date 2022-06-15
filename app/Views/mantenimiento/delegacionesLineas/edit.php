<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Líneas delegaciones</h1>
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
                        <!-- Campo Delegacion -->
                        <div class="form-group">
                                    <label class="small mb-1" for="id_delegacion">Delegación</label>       
                                        <select class="form-control py-2"  id="id_delegacion" name="id_delegacion">
                                            <option value="0">-</option>
                                            <?php if(isset($delegaciones))
                                                {
                                                    foreach($delegaciones as $delegacion)
                                                    { ?>
                                                        <option <?php if(isset($data) && $delegacion->ID==$data[0]->Delegacion) {echo 'selected';} ?> class="" value="<?php echo $delegacion->ID; ?>"><?php echo $delegacion->Delegación; ?></option><?php
                                                    }                                            
                                                }                                 
                                            ?>
                                        </select>
                                                                                
                                </div>
                        <div class="form-row">
                            <div class="col-md-12">                        
                                <!-- Campo Línea -->
                                <div class="form-group">
                                    <label class="small mb-1" for="linea">Línea</label>
                                    <input class="form-control py-2" id="linea" name="linea" type="text"
                                        placeholder="Introduce línea" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Linea;
                                        }  
                                        else{
                                            echo set_value('linea');
                                        }
                                        ?>" />                            
                                </div>                        
                            </div>
                            <div class="col-md-12">  
                                <!-- Campo Descripcion -->
                                <div class="form-group">
                                    <label class="small mb-1" for="nombre">Nombre linea</label>
                                        <input class="form-control py-2" id="nombre" name="nombre" type="text"
                                            placeholder="Introduce nombre" value="<?php if(isset($data[0]))
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
    </div>
</div>