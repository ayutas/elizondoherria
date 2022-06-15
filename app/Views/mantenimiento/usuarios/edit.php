<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Personal</h1>
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
                                    <label class="medium mb-1" for="nombre">Nombre</label>
                                    <input class="form-control py-2" id="nombre" name="nombre" type="text"
                                        placeholder="Introduce nombre" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Nombre;
                                        }  
                                        else{
                                            echo set_value('nombre');
                                        }
                                        ?>" />
                                    <input class="form-control py-2" id="id" name="id" type="hidden"
                                        placeholder="Introduce nombre" value="" />
                                </div> 
                                <!-- Campo Apellido1 -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="apellido1">Apellido1</label>
                                    <input class="form-control py-2" id="apellido1" name="apellido1" type="text"
                                        placeholder="Introduce apellido 1" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Apellido1;
                                        }  
                                        else{
                                            echo set_value('apellido1');
                                        }
                                        ?>" />
                                    <input class="form-control py-2" id="id" name="id" type="hidden"
                                        placeholder="Introduce apellido 1" value="" />
                                </div>
                                <!-- Campo Apellido2 -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="apellido2">Apellido2</label>
                                    <input class="form-control py-2" id="apellido2" name="apellido2" type="text"
                                        placeholder="Introduce apellido 2" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Apellido2;
                                        }  
                                        else{
                                            echo set_value('apellido2');
                                        }
                                        ?>" />
                                    <input class="form-control py-2" id="id" name="id" type="hidden"
                                        placeholder="Introduce apellido 2" value="" />
                                </div>                               
                                <!-- Campo Admin -->                        
                                <div class="form-group">
                                    <label class="medium mb-1" for="admin">Administrador</label>                            
                                    <input class="" type="checkbox" id="admin" name="admin"
                                        <?php 
                                            if(isset($data[0])) 
                                            {                                         
                                                if ($data[0]->Admin)
                                                {                                                
                                                    ?> checked="checked" 
                                                <?php
                                                } 
                                                                                            
                                            }
                                        ?>
                                    >
                                </div>

                                <!-- Campo Usuario -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="usuario">Usuario</label>
                                    <input class="form-control py-2" id="usuario" name="usuario" type="text"
                                        placeholder="Introduce usuario" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Usuario;
                                        }  
                                        else{
                                            echo set_value('usuario');
                                        }
                                        ?>" />
                                    <input class="form-control py-2" id="id" name="id" type="hidden"
                                        placeholder="Introduce usuario" value="" />
                                </div>
                                <!-- Campo Contraseña -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="contrasena">Contraseña</label>
                                    <input class="form-control py-2" id="contrasena" name="contrasena" type="password"
                                        placeholder="Introduce descripción" value="<?php if(isset($data[0]))
                                        {
                                            
                                        }  
                                        else{
                                            echo set_value('contrasena');
                                        }
                                        ?>" />
                                    <input class="form-control py-2" id="id" name="id" type="hidden"
                                        placeholder="Introduce tú nombre" value="" />
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
    </main>
</div>

