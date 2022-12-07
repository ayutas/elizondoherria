<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Articulos</h1>
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
                                        <label class="medium mb-1" for="descripcion">Descripción</label>
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
                                        <label class="medium mb-1" for="numero">Número</label>
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
                                        <label class="medium mb-1" for="precio">Letra</label>
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
                                        <label class="medium mb-1" for="categoria">Categoría</label>
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
                                    <div class="form-group">
                                        <label class="medium mb-1" for="precio">Precio</label>
                                        <input class="form-control py-2" id="precio" name="precio" type="text"
                                            placeholder="0.00"
                                            value="<?php if (isset($data[0])) {
                                                        echo $data[0]->Precio;
                                                    } else {
                                                        echo set_value('precio');
                                                    }
                                                    ?>" />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- Link Cliente asignado -->
                            <div class="form-group">
                            <?php if (isset($clienteAsignado[0])) {?>
                                <label class="medium mb-1" for="cliente">Asignado a cliente: </label>
                                <a href="<?php echo $clienteAsignado[0]->Link;?> "><?php echo $clienteAsignado[0]->Cliente;?></a>                                
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
                                        echo 'Actualizar';
                                    } else {
                                        echo 'Crear';
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