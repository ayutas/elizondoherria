<?= 
    helper('html');
    ?>
<div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <!-- titulo -->
                    <h1>Clientes</h1>
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
                            <div class="col-md-4">                        
                                <!-- Campo Nombre -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="nombre">Nombre</label>
                                    <input class="form-control py-2" id="nombre" name="nombre" type="text"
                                        placeholder="Introduce descripción" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Nombre;
                                        }  
                                        else{
                                            echo set_value('nombre');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo Apellidos -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="apellidos">Apellidos</label>
                                    <input class="form-control py-2" id="apellidos" name="apellidos" type="text"
                                        placeholder="Introduce apellido" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Apellidos;
                                        }  
                                        else{
                                            echo set_value('apellidos');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo DNI -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="dni">DNI</label>
                                    <input class="form-control py-2" id="dni" name="dni" type="text"
                                        placeholder="Introduce DNI" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->DNI;
                                        }  
                                        else{
                                            echo set_value('dni');
                                        }
                                        ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">                        
                                <!-- Campo Domicilio -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="domicilio">Domicilio</label>
                                    <input class="form-control py-2" id="domicilio" name="domicilio" type="text"
                                        placeholder="Introduce descripción" value="<?php if(isset($data[0]))
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
                                    <label class="medium mb-1" for="poblacion">Población</label>
                                    <input class="form-control py-2" id="poblacion" name="poblacion" type="text"
                                        placeholder="Introduce población" value="<?php if(isset($data[0]))
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
                                    <label class="medium mb-1" for="cpostal">Código postal</label>
                                    <input class="form-control py-2" id="cpostal" name="cpostal" type="text"
                                        placeholder="Introduce código postal" value="<?php if(isset($data[0]))
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
                                <!-- Campo Contacto -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="contacto">Contacto</label>
                                    <input class="form-control py-2" id="contacto" name="contacto" type="text"
                                        placeholder="Introduce nombre contacto" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->contacto;
                                        }  
                                        else{
                                            echo set_value('contacto');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo Telefono -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="telefono">Teléfono</label>
                                    <input class="form-control py-2" id="telefono" name="telefono" type="text"
                                        placeholder="Introduce telefono contacto" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->telefono;
                                        }  
                                        else{
                                            echo set_value('telefono');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo Email -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="email">Email</label>
                                    <input class="form-control py-2" id="email" name="email" type="text"
                                        placeholder="Introduce email contacto" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Email;
                                        }  
                                        else{
                                            echo set_value('email');
                                        }
                                        ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <!-- Campo Banco -->
                                <div id="comboBancos" class="form-group">
                                    <label class="medium mb-1" for="banco">Banco</label>
                                    <select class="form-control py-2" id="banco" name="banco">
                                        <option value="0">-</option>
                                        <?php if (isset($bancos)) {
                                            foreach ($bancos as $banco) { ?>
                                                <option class="" value="<?php echo $banco->ID; ?>">
                                                <?php echo $banco->Nombre; ?></option><?php
                                                }
                                            }
                                        ?>
                                    </select>    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo Agencia -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="agencia">Agencia</label>
                                    <input class="form-control py-2" id="agencia" name="agencia" type="text"
                                        placeholder="Introduce agencia" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Agencia;
                                        }  
                                        else{
                                            echo set_value('agencia');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo Cuenta -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="cuenta">Cuenta</label>
                                    <input class="form-control py-2" id="cuenta" name="cuenta" type="text"
                                        placeholder="Introduce resto de la cuenta" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Cuenta;
                                        }  
                                        else{
                                            echo set_value('cuenta');
                                        }
                                        ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <!-- Campo Notas -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="notas">Notas</label>
                                    <input class="form-control py-2" id="notas" name="notas" type="text"
                                        placeholder="Introduce notas" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Notas;
                                        }  
                                        else{
                                            echo set_value('notas');
                                        }
                                        ?>" />
                                </div>
                            </div>                            
                        </div>

                        <hr>                        
                        <!-- TABS -->
                        <div class="nav-tabs-boxed" name="tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <!-- TAB ARTICULOS -->
                                    <a class="nav-link" data-toggle="tab" href="#home-1" role="tab"
                                        aria-controls="home" aria-selected="true">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Artículos</font>
                                        </font>
                                    </a>
                                </li>                                
                                <li class="nav-item">
                                    <!-- TAB RECIBOS -->
                                    <a class="nav-link " data-toggle="tab" href="#profile-1"
                                        role="tab" aria-controls="profile" aria-selected="false">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Recibos</font>
                                        </font>
                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="home-1" role="tabpanel">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="Button" onclick="AsignarArticulo()" id="btnAsignarArticulo" class="btn btn-primary mb-2 ml-2" >Asignar articulo</button>
                                        </div>
                                    </div>
                                        <?php if(isset($columnsArticulos[0]))
                                            {
                                            dataTable("Articulos", $columnsArticulos, $dataArticulos, 'Articulos', '4', 'text-center', "0", 4, false, 0, 'tablaArticulos');
                                            }
                                        ?>
                                    <div id="tablaGrupos">
                                        <table class="table table-responsive-sm table-sm mt-4"
                                            style="color:black;">
                                            <thead>
                                                <tr>
                                                    <th>Número</th>
                                                    <th>Letra</th>
                                                    <th>Categoría</th>
                                                    <th>Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody id="articulosCliente">
                                                <?php if (isset($dataArticulos) && $dataArticulos != null) {
                                                    foreach ($dataArticulos as $articulo) { ?>
                                                <tr>
                                                    <td><?= $articulo->Numero ?></td>
                                                    <td><?= $articulo->Letra ?></td>
                                                    <td><?= $articulo->Categoría ?></td>
                                                    <td><?= $articulo->Precio ?></td>   
                                                </tr>
                                                <?php }
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane active" id="profile-1" role="tabpanel">
                                    <!--Tabla recibos -->
                                    <?php if(isset($columnsRecibos[0]))
                                    {
                                    dataTable("Recibos cliente", $columnsRecibos, $dataRecibos, 'Recibos', '2,3', 'text-center', "0", 4, false, 0, 'tablaRecibos');
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                        
                        <!--Modal para busqueda de articulos disponibles -->
                        <div class="modal fade" id="modalSeleccionArticulos" tabindex="-1" role="dialog" aria-labelledby="modalSeleccionArticulos" aria-hidden="true">
                            <div class="modal-dialog" role="document"  style="max-width: 1350px!important;">
                                <div class="modal-content">
                                    <div style="background-color:white;" class="modal-header">
                                        <h5 class="modal-title" id="modalSeleccionArticulosLabel">Artículos disponibles</h5>
                                        <button id="btnCloseModalSeleccionArticulos" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span style="background-color:black;" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div style="background-color:white;" class="modal-body" id="divModal">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <?php if(isset($columnsArticulosDisponibles[0]))
                                                dataTablePersonalizadaSeleccion($columnsArticulosDisponibles,$articulosDisponibles,$slug,'','text-center','', "Artículos (". count($articulosDisponibles).")",12,true,0,'datatableArticulosDisponibles',false,0,"AñadirArticuloALinea(this)");
                                                ?>   
                                            </div>
                                        </div>
                                    </div>
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
<script>

function AsignarArticulo(input)
   {
        var idCliente =0;
        <?php if (isset($data[0])){?> idCliente=<?php echo json_encode($data[0]); } 
        ?>;
        console.log(idCliente);
        if(idCliente!=0){
            $('#modalSeleccionArticulos').data('idCliente',idCliente); 
            $("#modalSeleccionArticulos").modal('show');
        } else{
            if (confirm("Para poder asignar es necesario guardar el cliente. ¿Continuar guardando?")) {
                CrearCliente();
            }
        }
   }

function CrearCliente()
   {
        if ($('#id_formulario').val() != 0) {
            var idFormulario = $('#id_formulario').val();
            var itemsSel = "";
            var hayItems = 0;

            itemsSel = "[";
            $("#tablaItems input").each(function(e, x) {
                if (x.checked) {
                    itemsSel += '{"ID":' + x.value + '},';
                    hayItems = 1;
                }
            });

            if (hayItems) {
                itemsSel = itemsSel.slice(0, -1);
            }

            itemsSel += "]";

            console.log(itemsSel);

            var idArticulo = 0;
            <?php if (isset($data[0])) { ?>
            idArticulo =
                <?php echo $data[0]->ID;
                } ?>

            var referenciaArt = $('#referencia').val();
            var nombreArt = $('#descripcion').val();
            var marcaArt = $('#marca').val();
            var parametros = JSON.stringify({
                idArticulo: idArticulo,
                referenciaArt: referenciaArt,
                nombreArt: nombreArt,
                marcaArt: marcaArt,
                idFormulario: idFormulario,
                items: itemsSel
            });


            $.ajax({
                data: {
                    'data': parametros
                },
                dataType: "json",
                //data: formData,
                url: '<?= base_url() ?>/articulos/grabararticuloitemsformulario',
                type: 'post',
                beforeSend: function() {
                    $("#resultado").html("Procesando, espere por favor...");
                },
                success: function(response) {
                    if (response['redirect'] == true) {
                        // similar behavior as an HTTP redirect
                        window.location.replace("<?= base_url() ?>/articulos/edit/" +
                            response['id']);

                        // similar behavior as clicking on a link
                        // window.location.href = "http://stackoverflow.com";
                    } else {
                        GruposArt = response[0];
                        CargarComboGrupos();
                        arrayItemsArt = response[1];
                        $(".alert").html(
                            "Se han grabado los items <strong>Correctamente!</strong>");
                        if ($('.alert').hasClass('alert-warning')) {
                            $('.alert').removeClass('alert-warning');
                            $('.alert').addClass('alert-success');
                        };
                        if ($('.alert').hasClass('alert-danger')) {
                            $('.alert').removeClass('alert-danger');
                            $('.alert').addClass('alert-success');
                        };
                        $('.alert').show();
                        setInterval(function() {
                            $('.alert').hide();
                        }, 5000)

                    }
                }
            });

        } else {
            $(".alert").html("Debe elegir un chekclist para poder guardar sus items!");
            if ($('.alert').hasClass('alert-success')) {
                $('.alert').removeClass('alert-success');
                $('.alert').addClass('alert-danger');
            };
            if ($('.alert').hasClass('alert-warning')) {
                $('.alert').removeClass('alert-warning');
                $('.alert').addClass('alert-danger');
            };
            $('.alert').show();
            setInterval(function() {
                $('.alert').hide();
            }, 5000)
        }

    };

</script>