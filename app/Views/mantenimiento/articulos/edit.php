<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.articulos'); ?></h1>
                <div clas="row">
                    <div class="container mt-4">
                        <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                        <?php endif;
                        if (session()->get('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->get('error') ?>
                        </div>
                        <?php endif; ?>

                        <form class="" action="<?= $action ?>" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <!-- Campo descripcion -->
                                    <div class="form-group">
                                        <label class="medium mb-1" for="descripcion"><?php echo lang('Translate.descripcion'); ?></label>
                                        <input class="form-control py-2" id="descripcion" name="descripcion" type="text"
                                            placeholder="Introduce descripción"
                                            value="<?php if (isset($data[0])) {
                                                        echo $data[0]->Descripción;
                                                    } else {
                                                        echo set_value('descripcion');
                                                    }
                                                    ?>" />
                                    </div>
                                    <!-- Campo Numero -->
                                    <div class="form-group">
                                        <label class="medium mb-1" for="numero"><?php echo lang('Translate.numero'); ?></label>
                                        <input class="form-control py-2" id="numero" name="numero" type="text"
                                            placeholder="Introduce número"
                                            value="<?php if (isset($data[0])) {
                                                        echo $data[0]->Número;
                                                    } else {
                                                        echo set_value('numero');
                                                    }
                                                    ?>" />
                                    </div>
                                    <!-- Campo Letra -->
                                    <div class="form-group">
                                        <label class="medium mb-1" for="letra"><?php echo lang('Translate.letra'); ?></label>
                                        <input class="form-control py-2" id="letra" name="letra" type="text"
                                            placeholder="Introduce letra"
                                            value="<?php if (isset($data[0])) {
                                                        echo $data[0]->Letra;
                                                    } else {
                                                        echo set_value('letra');
                                                    }
                                                    ?>" />
                                    </div>
                                    <!-- Campo Banco -->
                                    <div id="comboCategorias" class="form-group">
                                        <label class="medium mb-1" for="categoria"><?php echo lang('Translate.categoria'); ?></label>
                                        <select class="form-control py-2" id="categoria" name="categoria">
                                            <option value="0">-</option>
                                            <?php if (isset($categorias)) {
                                                foreach ($categorias as $categoria) { ?>
                                                    <option class="" value="<?php echo $categoria->ID; ?>">
                                                    <?php echo $categoria->Nombre; ?></option><?php
                                                    }
                                                }
                                            ?>
                                        </select>    
                                    </div>
                                    <!-- Campo Precio -->
                                    <div class="form-group" disabled>
                                        <label class="medium mb-1" for="precio"><?php echo lang('Translate.precio'); ?></label>
                                        <input class="form-control py-2" id="precio" name="precio" type="text"
                                            placeholder="0.00"
                                            value="<?php if (isset($data[0])) {
                                                        echo $data[0]->Precio;
                                                    } else {
                                                        echo set_value('precio');
                                                    }
                                                    ?>" disabled />
                                    </div>
                                    <!-- Campo Disponible -->
                                    <div class="form-group">
                                        <label class="medium mb-1" for="disponible"><?php echo lang('Translate.disponible'); ?></label>
                                        <input class="form-control py-2" id="disponible" name="disponible" type="text"
                                            placeholder="0"
                                            value="<?php if (isset($data[0])) {
                                                        echo $data[0]->Disponible;
                                                    } else {
                                                        echo set_value('disponible');
                                                    }
                                                    ?>" />
                                    </div>                                    
                                </div>
                            </div>
                            <hr>
                            <!-- Link Cliente asignado -->
                            <div class="form-group">
                            <?php if (isset($clienteAsignado)) {?>
                                <label class="medium mb-1" for="cliente"><?php echo lang('Translate.asignadoA'); ?> </label>
                                <?php foreach($clienteAsignado as $cliente){?>
                                <a href="<?php echo $cliente->Link;?> "><?php echo $cliente->Cliente;?></a>
                                <?php } ?>
                            </div>
                            <?php }?>
                            <div class="form-row">
                                <!-- Errores de formulario -->
                                <?php if (isset($validation)) { ?>
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">
                                        <?= $validation->listErrors() ?>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="col-12 form-group mt-4 mb-0">
                                    <button class="btn btn-primary btn-block" type="submit"><?php if (isset($data[0])) {
                                        echo lang('Translate.actualizar');
                                    } else {
                                        echo lang('Translate.crear');
                                    }
                                    ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </main>
</div>

<div class="myAlert-bottom alert alert-success text-center"
    style="position: fixed;bottom:30px;left:30%;width:50%;display:none;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Agregado <strong>Correctamente!</strong>
</div>
<div id="loading-overlay">
    <div class="loading-icon"></div>
</div>

<script>
    
    $("#categoria").on('change', function() 
        {

            var idCategoria = $('#categoria').val();
            var arrayCategorias = <?php echo json_encode($categorias); ?>;

            //FILTRO POR ID CATEGORIA
            var arrayCategoria = $.grep(arrayCategorias, function(x) {
                return x.ID == idCategoria;
            });
            console.log(arrayCategoria);
            if (arrayCategoria.length>0)
            {
                $('#precio').val(arrayCategoria[0].Precio);
            } else{
                $('#precio').val(0);
            }
            
        }
    );
</script>