<?= 
    helper('html');
    ?>
<div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <!-- titulo -->
                    <h1>Cliente</h1>
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
            
                    <form class="" method="post">
                        <div class="form-row">
                            <div class="col-md-4">                        
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
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo Apellidos -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="apellidos">Apellidos</label>
                                    <input class="form-control py-2" id="apellidos" name="apellidos" type="text"
                                        placeholder="Introduce apellidos" value="<?php if(isset($data[0]))
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
                                        placeholder="Introduce domicilio" value="<?php if(isset($data[0]))
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
                                            echo $data[0]->Contacto;
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
                                            echo $data[0]->Telefono;
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
                            <div class="col-md-3">
                                <!-- Campo Iban -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="iban">IBAN</label>
                                    <input class="form-control py-2" id="iban" name="iban" type="text"
                                        placeholder="Introduce iban" value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Iban;
                                        }  
                                        else{
                                            echo set_value('iban');
                                        }
                                        ?>" />
                                </div>
                            </div>                           
                            <div class="col-md-3">
                                <!-- Campo Banco -->
                                <div id="comboBancos" class="form-group">
                                    <label class="medium mb-1" for="banco">Banco</label>
                                    <select class="form-control py-2" id="banco" name="banco">
                                        <option value="0">-</option>
                                        <?php if (isset($bancos)) {
                                            foreach ($bancos as $banco) { ?>
                                                <option class="" value="<?php echo $banco->ID; ?>">
                                                <?php echo $banco->Código .' - '.$banco->Nombre; ?></option><?php
                                                }
                                            }
                                        ?>
                                    </select>    
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
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
                                    <textarea class="form-control py-2" id="notas" name="notas" rows="4" cols="50"
                                        placeholder="Introduce notas"><?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Notas;
                                        }  
                                        else{
                                            echo set_value('notas');
                                        }
                                        ?></textarea>
                                </div>
                            </div>                            
                        </div>

                        <hr>                        
                        <!-- TABS -->
                        <div class="nav-tabs-boxed" name="tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <!-- TAB COMENTARIOS -->
                                    <a class="nav-link active" data-toggle="tab" href="#comentarios-1"
                                        role="tab" aria-controls="comentarios" aria-selected="true">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Comentarios</font>
                                        </font>
                                    </a>
                                </li>                
                                <li class="nav-item">
                                    <!-- TAB ARTICULOS -->
                                    <a class="nav-link" data-toggle="tab" href="#articulos-1" role="tab"
                                        aria-controls="articulos" aria-selected="false">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Artículos</font>
                                        </font>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <!-- TAB RECIBOS -->
                                    <a class="nav-link" data-toggle="tab" href="#recibos-1"
                                        role="tab" aria-controls="recibos" aria-selected="false">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Recibos</font>
                                        </font>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="comentarios-1" role="tabpanel">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="Button" onclick="NuevoComentario()" id="btnNuevoComentario" class="btn btn-primary mb-2 ml-2" >Nuevo comentario</button>
                                        </div>
                                    </div>
                                    <div id="tablaComentarios" name="tablaComentarios">
                                    <!--Tabla comentarios -->
                                    <?php if(isset($columnsComentarios))
                                    {                                        
                                        dataTable("", $columnsComentarios, $dataComentarios, 'Comentarios', '4', 'text-center', "0", 4, false, 0, 'datatableComentarios');
                                    }
                                    ?>
                                    </div>
                                </div>                                
                                <div class="tab-pane" id="articulos-1" role="tabpanel">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="Button" onclick="AsignarArticulo()" id="btnAsignarArticulo" class="btn btn-primary mb-2 ml-2" >Asignar articulo</button>
                                        </div>
                                    </div>

                                    <div id="tablaArticulosCliente">
                                        <table class="table table-responsive-sm table-sm mt-4"
                                            style="color:black;">
                                            <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                    <th>Número</th>
                                                    <th>Letra</th>
                                                    <th>Categoría</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                    <th>Importe</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="articulosCliente">
                                                <?php if (isset($dataArticulos) && $dataArticulos != null) {
                                                    foreach ($dataArticulos as $articulo) { ?>
                                                <tr>
                                                    <td><?= $articulo->Descripción ?></td>
                                                    <td><?= $articulo->Número ?></td>
                                                    <td><?= $articulo->Letra ?></td>
                                                    <td><?= $articulo->Categoría ?></td>
                                                    <td><?= $articulo->Cantidad ?></td>
                                                    <td><?= $articulo->Precio ?></td>
                                                    <td><?= $articulo->Importe ?></td>
                                                    <td><button type="Button" onclick="QuitarArticulo(<?=$articulo->ID?>)" id="btnQuitarArticulo" class="btn btn-danger mb-2 ml-2" >Quitar</button></td>
                                                    <td><button type="Button" onclick="ImprimirArticulo(<?=$articulo->ID?>)" id="btnImprimirArticulo" class="btn btn-info mb-2 ml-2" >Imprimir</button></td>
                                                </tr>
                                                <?php }
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="recibos-1" role="tabpanel">
                                    <!-- <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkDetalleRecibos" onclick="CargarDetalleRecibos()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Cargar Detalle Recibos
                                        </label>
                                    </div> -->
                                    <!--Tabla recibos -->
                                    <?php if(isset($columnsRecibos[0]))
                                    {
                                    dataTable("Recibos cliente", $columnsRecibos, $dataRecibos, 'Recibos', '6', 'text-center', "0,7",  7, false, 0, 'tablaRecibos');
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--Modal para busqueda de articulos disponibles -->
                    <div class="modal fade" id="modalSeleccionArticulos" tabindex="-1" role="dialog" aria-labelledby="modalSeleccionArticulos" aria-hidden="true">
                        <div class="modal-dialog" role="document"  style="max-width: 1350px!important;">
                            <div class="modal-content">
                                <div style="background-color:white;" class="modal-header">
                                    <h5 class="modal-title" id="modalSeleccionArticulosLabel"></h5>
                                    <button id="btnCloseModalSeleccionArticulos" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span style="background-color:black;" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="background-color:white;" class="modal-body" id="divModal">
                                    <div class="row">
                                        <!-- <div id="tablaSeleccion"> -->
                                            <div class="col-md-12">
                                            <?php if(isset($columnsArticulosDisponibles[0]))
                                                dataTablePersonalizadaSeleccion($columnsArticulosDisponibles,$articulosDisponibles,$slug,'','text-center','1', "Artículos (". count($articulosDisponibles).")",12,true,0,'datatableArticulosDisponibles',false,0,"AñadirCantidad(this)");
                                                ?>   
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalInsertarCantidad" tabindex="-1" role="dialog" aria-labelledby="modalInsertarCantidad" aria-hidden="true">
                        <div class="modal-dialog" role="document"  style="max-width: 1350px!important;">
                            <div class="modal-content">
                                <div style="background-color:white;" class="modal-header">
                                    <h5 class="modal-title" id="modalInsertarCantidadLabel"></h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="background-color:white;" class="modal-body" id="divModal">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="body-form-heavy" for="cantidad">Introduce la cantidad</label>
                                                    <input class="form-control body-form-light"  id="cantidad" name="cantidad"
                                                    type="text" placeholder="Cantidad"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <button onclick="AñadirArticulo()"  type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Modal para los comentarios-->
                    <div class="modal fade" id="modalComentarios" tabindex="-1" role="dialog" aria-labelledby="modalComentarios" aria-hidden="true">
                        <div class="modal-dialog" role="document"  >
                            <div class="modal-content">
                                <div style="background-color:white;" class="modal-header">
                                    <h5 class="modal-title" id="modalComentariosLabel"></h5>
                                    <button id="btnClosemodalComentarios" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span style="background-color:black;" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="background-color:white;" class="modal-body" id="divModal">
                                    <div class="row">
                                        <textarea name="comentario" id="comentario" rows="4" cols="50"
                                        placeholder="Introduce comentario"></textarea>
                                    </div>
                                    <div class="row">
                                        <button type="Button" onclick="GuardarComentario()" id="btnGuardarComentario" class="btn btn-primary mb-2 ml-2" >Guardar</button>
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
                        <button class="btn btn-primary btn-block" type="button" onclick="GuardarCliente()"><?php if (isset($data[0]))
                        { 
                            echo 'Actualizar';
                        }
                        else
                        {
                            echo 'Crear';
                        }
                        ?></button>
                    </div>
                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>


var ShowAlGuardar=1;
var idCliente =0;

$( document ).ready(function() {
    <?php if (isset($data[0])){?> 
        var data=<?php echo json_encode($data[0]); ?>;
        idCliente=data.ID;
    <?php }?>

});

function AsignarArticulo(input)
{
    console.log(idCliente);
    if(idCliente!=0){            
        $("#modalSeleccionArticulos").modal('show');
    } else{
        if (confirm("Para poder asignar es necesario guardar el cliente. ¿Continuar guardando?")) {
            ShowAlGuardar=0;
            GuardarCliente();
            $("#modalSeleccionArticulos").modal('show');
            ShowAlGuardar=1;
        }
    }
}

function NuevoComentario(input)
{
    console.log(idCliente);
    if(idCliente!=0){
        $('#modalComentarios').data('id', 0);
        $("#comentario").val('');
        $("#modalComentarios").modal('show');        
    }
}

function EditarComentario(boton)
{
    // var btn = boton.parentElement.parentElement;
    var linea = boton.parentElement.parentElement;
    var table = $("#datatableComentarios").dataTable();
    var row = table.find("tr").eq(linea.rowIndex);
    var data = $("#datatableComentarios").dataTable().fnGetData(row);       
   
    if(idCliente!=0){
        $("#comentario").val(data.Comentario);        
        $('#modalComentarios').data('id', data.ID);        
        $("#modalComentarios").modal('show');        
    }
}

function EditarRecibo(boton)
{
    var linea = boton.parentElement.parentElement;
    var table = $("#tablaRecibos").dataTable();
    var row = table.find("tr").eq(linea.rowIndex);
    var data = $("#tablaRecibos").dataTable().fnGetData(row);       

    var idRecibo=data.ID;
    
    if(idRecibo!=0){
        window.location.replace("<?= base_url() ?>/recibos/edit/"+idRecibo);        
    }
}

function GuardarCliente()
{   
    var nombre= $('#nombre').val();
    var apellidos= $('#apellidos').val();
    var dni= $('#dni').val();
    if (!validar_dni_nif_nie(dni))
    {
        alert('DNI no válido');
        return;
    }

    var domicilio= $('#domicilio').val();
    var poblacion= $('#poblacion').val();
    var cpostal= $('#cpostal').val();
    var contacto= $('#contacto').val();
    var telefono= $('#telefono').val();
    var email= $('#email').val();
    var iban= $('#iban').val();
    var banco= $('#banco').val();
    var agencia= $('#agencia').val();
    var cuenta= $('#cuenta').val();
    
    if (!fn_ValidateIBAN(iban+banco+agencia+cuenta))
    {
        alert('IBAN de la cuenta no válido');
        return;
    }
    var notas= $('#notas').val();
    console.log('idCliente: '+idCliente);
    var parametros = JSON.stringify({
        id:idCliente,
        nombre:nombre,
        apellidos:apellidos,
        dni:dni,
        domicilio:domicilio,
        poblacion:poblacion,
        cpostal:cpostal,
        contacto:contacto,
        telefono:telefono,
        email:email,
        iban:iban,
        banco:banco,
        agencia:agencia,
        cuenta:cuenta,
        notas:notas
    });
    $.ajax({
        data: {
            'data': parametros
        },
        dataType: "json",
        //data: formData,
        url: '<?= base_url() ?>/clientes/guardarCliente',
        type: 'post',
        beforeSend: function() {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function(response) {
            if(ShowAlGuardar){
                // similar behavior as an HTTP redirect
                window.location.replace("<?= base_url() ?>/hilerria/clientes/show/"); //le pongo hilerria porque no se porque no lo coge desde el base_url??
            } else {
                idCliente = response[0];
                $(".alert").html(
                    "Se ha grabado el cliente <strong>Correctamente!</strong>");
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

    // } else {
    //     $(".alert").html("Debe elegir un chekclist para poder guardar sus items!");
    //     if ($('.alert').hasClass('alert-success')) {
    //         $('.alert').removeClass('alert-success');
    //         $('.alert').addClass('alert-danger');
    //     };
    //     if ($('.alert').hasClass('alert-warning')) {
    //         $('.alert').removeClass('alert-warning');
    //         $('.alert').addClass('alert-danger');
    //     };
    //     $('.alert').show();
    //     setInterval(function() {
    //         $('.alert').hide();
    //     }, 5000)
    // }

}

function AñadirCantidad(boton)
{
    var linea = boton.parentElement.parentElement;
    var table = $("#datatableArticulosDisponibles").dataTable();
    var row = table.find("tr").eq(linea.rowIndex);
    var data = $("#datatableArticulosDisponibles").dataTable().fnGetData(row);

    $("#cantidad") .val("");
    $('#modalInsertarCantidad').data('articulo',data.ID);
    $('#modalInsertarCantidad').data('disponible',data.Disponible);
    $("#modalSeleccionArticulos").modal('hide');
    $("#modalInsertarCantidad").modal('show');
}

function AñadirArticulo(boton)
{
    // console.log('llego');
    // var linea = boton.parentElement.parentElement;
    // console.log('linea '+linea);
    // var table = $("#datatableArticulosDisponibles").dataTable();
    // var row = table.find("tr").eq(linea.rowIndex);
    // var data = $("#datatableArticulosDisponibles").dataTable().fnGetData(row);
    // console.log('data '+data);
    // var idArticulo=data.ID;
    // console.log('articulo '+idArticulo);
    // var numero=data.Número;
    // var letra=data.Letra;
    // var categoria=data.Categoría;
    // var precio=data.Precio;
    // console.log('articulo '+idArticulo, 'num'+numero, 'letra'+letra, 'cat'+categoria,'precio'+precio);
    var idArticulo = $("#modalInsertarCantidad").data('articulo');
    var disponible = $("#modalInsertarCantidad").data('disponible');
    var cantidad = $("#cantidad") .val();
    cantidad=cantidad.replace(',','.');
    if (!isNumeric(cantidad)){
        alert('La cantidad no es numérica, introduzca cantidad válida');
        return;
    }
    if (cantidad>disponible){
        alert('La cantidad introducida supera la disponible');
        return;
    }
    
    var parametros = JSON.stringify({
        idCliente:idCliente,
        idArticulo:idArticulo,
        cantidad:cantidad
    });
    $.ajax({
        data: {
            'data': parametros
        },
        dataType: "json",
        //data: formData,
        url: '<?= base_url() ?>/clientes/guardarArticuloCliente',
        type: 'post',
        beforeSend: function() {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function(response) {
                //Cargamos los articulos en la tabla
                console.log(response);
                var ArticulosCliente = response[0];
                var ArticulosDisponibles = response[1];
                CargarTablaArticulosCliente(ArticulosCliente);
                CargarTablaSeleccion(ArticulosDisponibles);
            }
        
    });
    $("#modalSeleccionArticulos").modal('hide');
}

function GuardarComentario()
{    
    var id=$("#modalComentarios").data('id');    
    var comentario=$("#comentario").val();
    var parametros = JSON.stringify({
        id:id,
        idCliente:idCliente,
        comentario:comentario
    });
    console.log(parametros);
    $.ajax({
        data: {
            'data': parametros
        },
        dataType: "json",
        //data: formData,
        url: '<?= base_url() ?>/clientes/guardarComentarioCliente',
        type: 'post',
        beforeSend: function() {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function(response) {
                //Cargamos los articulos en la tabla
                console.log(response);
                var ComentariosCliente = response[0];
                CargarTablaComentarios(ComentariosCliente);
            }
        
    });
    $("#modalComentarios").modal('hide');
}

function QuitarArticulo(id)
{
    if (confirm('¿Continuar eliminando el artículo del cliente?') == true) {
        console.log(id);
        var parametros = JSON.stringify({
                id:id,
                idCliente:idCliente,
        });
        $.ajax({
            data: {
                'data': parametros
            },
            dataType: "json",
            //data: formData,
            url: '<?= base_url() ?>/clientes/quitarArticuloCliente',
            type: 'post',
            success: function(response) {
                //Cargamos los articulos en la tabla
                console.log(response);
                var ArticulosCliente = response[0];
                var ArticulosDisponibles = response[1];
                CargarTablaArticulosCliente(ArticulosCliente);
                CargarTablaSeleccion(ArticulosDisponibles);        
            }    
        });
    }
}

function EliminarComentario(id)
{    
    if (confirm('¿Eliminar comentario?') == true) {
    
        var parametros = JSON.stringify({
            id:id,
            idCliente:idCliente,
        });
        console.log(parametros);
        $.ajax({
            data: {
                'data': parametros
            },
            dataType: "json",
            //data: formData,
            url: '<?= base_url() ?>/clientes/eliminarComentarioCliente',
            type: 'post',
            beforeSend: function() {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function(response) {
                    //Cargamos los articulos en la tabla
                    console.log(response);
                    var ComentariosCliente = response[0];
                    CargarTablaComentarios(ComentariosCliente);
                    // if (ComentariosCliente.length>0){
                    //     $("#tablaComentarios").show;
                    // } else{
                    //     $("#tablaComentarios").hide;
                    // }
                }
            
        });
        $("#modalComentarios").modal('hide');
    }
}

function ImprimirArticulo(id)
{
    console.log(id);

    //con Window.open abrimos el pdf en una nueva pestaña
    window.open("<?= base_url() ?>/clientes/imprimirArticuloCliente/"+id,'_blank');    
}

function CargarTablaArticulosCliente(dataArticulos)
{
    var html = '<table class="table table-responsive-sm table-sm mt-4" style="color:black;">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Descripción</th>';
    html += '<th>Número</th>';
    html += '<th>Letra</th>';
    html += '<th>Categoría</th>';
    html += '<th>Cantidad</th>';
    html += '<th>Precio</th>';
    html += '<th>Importe</th>';
    html += '<th></th>';
    html += '<th></th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody id="articulosCliente">';
    dataArticulos.forEach(function(articulo) {
        html += '<tr>';
        html += '<td>'+ articulo.Descripción+'</td>';
        html += '<td>'+ articulo.Número+'</td>';
        html += '<td>'+ articulo.Letra +'</td>';
        html += '<td>'+ articulo.Categoría +'</td>';
        html += '<td>'+ articulo.Cantidad+'</td>';
        html += '<td>'+ articulo.Precio +'</td>';
        html += '<td>'+ articulo.Importe+'</td>';
        html += '<td><button type="Button" onclick="QuitarArticulo('+articulo.ID+')" id="btnQuitarArticulo" class="btn btn-danger mb-2 ml-2" >Quitar</button></td>';
        html += '<td><button type="Button" onclick="ImprimirArticulo('+articulo.ID+')" id="btnImprimirArticulo" class="btn btn-info mb-2 ml-2" >Imprimir</button></td>';
        html += '</tr>';
    });
    html += '</tbody>';
    html += '</table>';
    $('#tablaArticulosCliente').html(html);
}

function CargarTablaSeleccion(articulosDisponibles)
{
    $("#datatableArticulosDisponibles").DataTable().clear();
    $("#datatableArticulosDisponibles").DataTable().rows.add(articulosDisponibles);
    $("#datatableArticulosDisponibles").DataTable().draw();
}

function CargarTablaComentarios(comentariosCliente)
{
    console.log($("#datatableComentarios").DataTable());
    console.log($("#datatableComentarios"));
    $("#datatableComentarios").DataTable().clear();
    $("#datatableComentarios").DataTable().rows.add(comentariosCliente);
    $("#datatableComentarios").DataTable().draw();
}

function CargarDetalleRecibos()
{
    
    var detalle=$('#checkDetalleRecibos').prop('checked');
    if (detalle)
    {
        console.log('Cargo detalle');
    } else{
        console.log('Cargo sin detalle');
    }

}

function validar_dni_nif_nie(value){
 
    var validChars = 'TRWAGMYFPDXBNJZSQVHLCKET';
    var nifRexp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
    var nieRexp = /^[XYZ]{1}[0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
    var str = value.toString().toUpperCase();

    if (!nifRexp.test(str) && !nieRexp.test(str)) return false;

    var nie = str
        .replace(/^[X]/, '0')
        .replace(/^[Y]/, '1')
        .replace(/^[Z]/, '2');

    var letter = str.substr(-1);
    var charIndex = parseInt(nie.substr(0, 8)) % 23;

    if (validChars.charAt(charIndex) === letter) return true;

    return false;
}

function fn_ValidateIBAN(IBAN) {

    //Se pasa a Mayusculas
    IBAN = IBAN.toUpperCase();
    //Se quita los blancos de principio y final.
    IBAN = IBAN.trim();
    IBAN = IBAN.replace(/\s/g, ""); //Y se quita los espacios en blanco dentro de la cadena

    var letra1,letra2,num1,num2;
    var isbanaux;
    //La longitud debe ser siempre de 24 caracteres
    if (IBAN.length != 24) {
        return false;
    }

    // Se coge las primeras dos letras y se pasan a números
    letra1 = IBAN.substring(0, 1);
    letra2 = IBAN.substring(1, 2);
    num1 = getnumIBAN(letra1);
    num2 = getnumIBAN(letra2);
    //Se sustituye las letras por números.
    isbanaux = String(num1) + String(num2) + IBAN.substring(2);
    // Se mueve los 6 primeros caracteres al final de la cadena.
    isbanaux = isbanaux.substring(6) + isbanaux.substring(0,6);

    //Se calcula el resto, llamando a la función modulo97, definida más abajo
    resto = modulo97(isbanaux);
    if (resto == 1){
        return true;
    }else{
        return false;
    }
}

function modulo97(iban) {
    var parts = Math.ceil(iban.length/7);
    var remainer = "";

    for (var i = 1; i <= parts; i++) {
        remainer = String(parseFloat(remainer+iban.substr((i-1)*7, 7))%97);
    }

    return remainer;
}

function getnumIBAN(letra) {
    ls_letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return ls_letras.search(letra) + 10;
}

$("#banco").on('change', function() {
    if ($("#iban").val()==''){
        if ($('#banco').val() == 0) {
            $("#iban").val('');
        } else {
            
            var banco = $('#banco').val();
            var arrayBancos = <?php echo json_encode($bancos); ?>;
            var arrayBanco = $.grep(arrayBancos, function(x) {
                return x.ID == banco;
            });
            console.log(arrayBanco,banco,arrayBancos);
            $("#iban").val(arrayBanco[0].País);
        }
    }
});

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

</script>