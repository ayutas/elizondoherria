<?= 
    helper('html');
    ?>
<div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <!-- titulo -->
                    <h1><?php echo lang('Translate.clientes'); ?></h1>
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
                                    <label class="medium mb-1" for="nombre"><?php echo lang('Translate.nombre'); ?></label>
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
                                    <label class="medium mb-1" for="apellidos"><?php echo lang('Translate.apellidos'); ?></label>
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
                                    <label class="medium mb-1" for="dni"><?php echo lang('Translate.dni'); ?></label>
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
                                    <label class="medium mb-1" for="domicilio"><?php echo lang('Translate.domicilio'); ?></label>
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
                                    <label class="medium mb-1" for="poblacion"><?php echo lang('Translate.poblacion'); ?></label>
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
                                    <label class="medium mb-1" for="cpostal"><?php echo lang('Translate.cpostal'); ?></label>
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
                                    <label class="medium mb-1" for="contacto"><?php echo lang('Translate.contacto'); ?></label>
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
                                    <label class="medium mb-1" for="telefono"><?php echo lang('Translate.telefono'); ?></label>
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
                                    <label class="medium mb-1" for="email"><?php echo lang('Translate.email'); ?></label>
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
                            <div class="col-md-2">
                                <!-- Campo Forma Pago -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="formaPago"><?php echo lang('Translate.formaPago'); ?></label>
                                    <select class="form-control py-2" id="formaPago" name="formaPago">
                                        <option value="0">-</option>
                                        <?php if (isset($formasPago)) {
                                            foreach ($formasPago as $formaPago) { ?>
                                                <option class="" value="<?php echo $formaPago->ID; ?>"
                                                <?php if(isset($data[0])){ if ($formaPago->ID==$data[0]->FormaPago){?> selected <?php }};?>                                                    
                                                >
                                                <?php echo $formaPago->DESCRIPCION; ?></option><?php
                                                }
                                            }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            <div class="col-md-10">
                                <!-- Campo Cuenta -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="cuenta"><?php echo lang('Translate.cuenta'); ?></label>
                                    <input class="form-control py-2" id="cuenta" name="cuenta" type="text" disabled
                                        placeholder="ES00 1111 2222 3333 4444 5555" value="<?php if(isset($data[0]))
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
                                    <label class="medium mb-1" for="notas"><?php echo lang('Translate.notas'); ?></label>
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
                                            <font style="vertical-align: inherit;"><?php echo lang('Translate.comentarios'); ?></font>
                                        </font>
                                    </a>
                                </li>                
                                <li class="nav-item">
                                    <!-- TAB ARTICULOS -->
                                    <a class="nav-link" data-toggle="tab" href="#articulos-1" role="tab"
                                        aria-controls="articulos" aria-selected="false">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"><?php echo lang('Translate.articulos'); ?></font>
                                        </font>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <!-- TAB DOCUMENTOS -->
                                    <a class="nav-link" data-toggle="tab" href="#documentos-1"
                                        role="tab" aria-controls="documentos" aria-selected="false">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"><?php echo lang('Translate.documentos'); ?></font>
                                        </font>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <!-- TAB RECIBOS -->
                                    <a class="nav-link" data-toggle="tab" href="#recibos-1"
                                        role="tab" aria-controls="recibos" aria-selected="false">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;"><?php echo lang('Translate.recibos'); ?></font>
                                        </font>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="comentarios-1" role="tabpanel">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="Button" onclick="NuevoComentario()" id="btnNuevoComentario" class="btn btn-primary mb-2 ml-2" ><?php echo lang('Translate.newcomentario'); ?></button>
                                        </div>
                                    </div>
                                    <div id="tablaComentarios" name="tablaComentarios">
                                    <!--Tabla comentarios -->
                                    <?php if(isset($columnsComentarios[0]))
                                    {                                        
                                        dataTable("", $columnsComentarios, $dataComentarios, 'Comentarios', '4,5', 'text-center', "0", 4, false, 0, 'datatableComentarios');
                                    }
                                    ?>
                                    </div>
                                </div>                                
                                <div class="tab-pane" id="articulos-1" role="tabpanel">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="Button" onclick="AsignarArticulo()" id="btnAsignarArticulo" class="btn btn-primary mb-2 ml-2" ><?php echo lang('Translate.asignarArticulo'); ?></button>
                                        </div>
                                    </div>

                                    <div id="tablaArticulosCliente">
                                        <table class="table table-responsive-sm table-sm mt-4"
                                            style="color:black;">
                                            <thead>
                                                <tr>
                                                    <th><?php echo lang('Translate.descripcion'); ?></th>
                                                    <th><?php echo lang('Translate.numero'); ?></th>
                                                    <th><?php echo lang('Translate.letra'); ?></th>
                                                    <th><?php echo lang('Translate.categoria'); ?></th>
                                                    <th><?php echo lang('Translate.cantidad'); ?></th>
                                                    <th><?php echo lang('Translate.precio'); ?></th>
                                                    <th><?php echo lang('Translate.importe'); ?></th>
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
                                                    <td><button type="Button" onclick="QuitarArticulo(<?=$articulo->ID?>)" id="btnQuitarArticulo" class="btn btn-danger mb-2 ml-2" ><?php echo lang('Translate.quitar'); ?></button></td>
                                                    <td><button type="Button" onclick="ImprimirArticulo(<?=$articulo->ID?>)" id="btnImprimirArticulo" class="btn btn-info mb-2 ml-2" ><?php echo lang('Translate.imprimir'); ?></button></td>
                                                </tr>
                                                <?php }
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="documentos-1" role="tabpanel">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="Button" onclick="NuevoDocumento()" id="btnNuevoDocumento" class="btn btn-primary mb-2 ml-2" ><?php echo lang('Translate.newdocumento'); ?></button>
                                        </div>
                                    </div>
                                    <!--Tabla documentos -->
                                    <div id="tablaDocumentos" name="tablaDocumentos">
                                        <?php if(isset($columnsDocumentos[0]))
                                        {
                                            dataTable("", $columnsDocumentos, $dataDocumentos, 'Documentos', '4,5', 'text-center', "0,3", 4, false, 0, 'datatableDocumentos');
                                        }
                                        ?>
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
                                        dataTable(lang('Translate.recibosCliente'), $columnsRecibos, $dataRecibos, 'Recibos', '6', 'text-center', "0,7",  7, false, 0, 'tablaRecibos');
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
                                                dataTablePersonalizadaSeleccion($columnsArticulosDisponibles,$articulosDisponibles,$slug,'','text-center','1', lang('Translate.articulos')."(". count($articulosDisponibles).")",12,true,0,'datatableArticulosDisponibles',false,0,"AñadirCantidad(this)");
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
                                    <button id="btnClosemodalInsertarCantidad" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span style="background-color:black;" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="background-color:white;" class="modal-body" id="divModal">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="body-form-heavy" for="cantidad"><?php echo lang('Translate.cantidad'); ?></label>
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
                                        <button onclick="AñadirArticulo()"  type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang('Translate.aceptar'); ?></button>
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
                                        <button type="Button" onclick="GuardarComentario()" id="btnGuardarComentario" class="btn btn-primary mt-2 mb-2 ml-2" ><?php echo lang('Translate.aceptar'); ?></button>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <!--Modal para los documentos-->
                    <div class="modal fade" id="modalDocumentos" tabindex="-1" role="dialog" aria-labelledby="modalDocumentos" aria-hidden="true">
                        <div class="modal-dialog" role="document"  >
                            <div class="modal-content">
                                <div style="background-color:white;" class="modal-header">
                                    <h5 class="modal-title" id="modalDocumentosLabel"></h5>
                                    <button id="btnClosemodalDocumentos" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span style="background-color:black;" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="background-color:white;" class="modal-body" id="divModal">
                                    <div class="form-group">
                                        <label class="body-form-heavy" for="titulo"><?php echo lang('Translate.tituloDocumento'); ?></label>
                                        <input class="form-control body-form-light"  id="titulo" name="titulo"
                                        type="text" placeholder="Título"
                                        />
                                    </div>
                                    <div class="custom-file mt-2 mb-2" id="div_etiqueta">
                                        <input type="file" class="custom-file-input"
                                            name="archivo" id="archivo"
                                            accept="application/*">
                                        <label class="custom-file-label" id="labelarchivo"
                                            for="archivo" data-browse="Examinar"><?php echo lang('Translate.seleccionarArchivo'); ?></label>
                                    </div>                                    
                                    <div class="row">
                                        <button type="Button" onclick="GuardarDocumento()" id="btnGuardarDocumento" class="btn btn-primary mt-2 mb-2 ml-2" ><?php echo lang('Translate.aceptar'); ?></button>
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
                                echo lang('Translate.actualizar');
                            } else {
                                echo lang('Translate.crear');
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
    if ($("#formaPago").val()==1){
        $("#cuenta").attr('disabled', false);
    }

});

$("#formaPago").on('change', async function() {
    if ($("#formaPago").val()==1){
        $("#cuenta").attr('disabled', false);
    } else {
        $("#cuenta").attr('disabled', 'disabled');
    }
});

function AsignarArticulo(input)
{
    if(idCliente!=0){            
        $("#modalSeleccionArticulos").modal('show');
    } else{
        if (confirm("<?php echo lang('Translate.necesarioGuardarCliente'); ?>")) {
            ShowAlGuardar=0;
            GuardarCliente();
            if(idCliente!=0){
                $("#modalSeleccionArticulos").modal('show');
            }
        }
    }
}

function NuevoComentario(input)
{
    if(idCliente!=0){
        $('#modalComentarios').data('id', 0);
        $("#comentario").val('');
        $("#modalComentarios").modal('show');
    } else{
        if (confirm("<?php echo lang('Translate.necesarioGuardarCliente'); ?>")) {
            ShowAlGuardar=0;
            GuardarCliente();
            if(idCliente!=0){
                $('#modalComentarios').data('id', 0);
                $("#comentario").val('');
                $("#modalComentarios").modal('show');
            }
        }
    }
}

function EditarComentario(boton)
{
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

function NuevoDocumento(input)
{
    if(idCliente!=0){
        $("#titulo").val('');
        $("#archivo").val('');
        $("#archivo").next('.custom-file-label').html('');
        $("#modalDocumentos").modal('show');
    } else{
        if (confirm("<?php echo lang('Translate.necesarioGuardarCliente'); ?>")) {
            ShowAlGuardar=0;
            GuardarCliente();
            if(idCliente!=0){
                $("#titulo").val('');
                $("#archivo").val('');
                $("#archivo").next('.custom-file-label').html('');
                $("#modalDocumentos").modal('show');
            }
        }
    }
}

$('#archivo').on('change', function(e) 
{
    var fileName = e.target.files[0].name;
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
    if($("#titulo").val()==""){
        $("#titulo").val(fileName);
    }
});

function GuardarDocumento(input)
{
    var titulo=$("#titulo").val();
    if (titulo==""){
        alert('<?php echo lang('Translate.introduzcaTitulo'); ?>');
        return;
    }
    if ($('#archivo').val() == ''){
        alert('<?php echo lang('Translate.noSeleccionadoArchivo'); ?>');
        return;
    }
    var file_data = $('#archivo').prop('files')[0];  
    var parametros = JSON.stringify({
        idCliente:idCliente,
        titulo:titulo,

    });
    var form_data = new FormData();
         form_data.append('archivo', file_data);
         form_data.append('idCliente', idCliente);
         form_data.append('titulo', titulo);
         
         $.ajax({
            url: '<?= base_url()?>/Clientes/guardarDocumentoCliente',
            dataType: 'text',  
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response) {
                //Cargamos los documentos en la tabla
                // console.log(JSON.parse(response));
                //HAGO EL JSON.parse porque al hacer la llamada tipo text en vez de json para poder grabar el archivo, la respuesta viene como texto, 
                //asi que lo convierto en JSON para poder cargar el dataTable
                var DocumentosCliente = JSON.parse(response)[0];
                CargarTablaDocumentos(DocumentosCliente);
            }
        
    });
    $("#modalDocumentos").modal('hide');
}

function EliminarDocumento(id)
{    
    if (confirm('<?php echo lang('Translate.eliminarDocumento'); ?>') == true) {
    
        var parametros = JSON.stringify({
            id:id,
            idCliente:idCliente,
        });
        // console.log(parametros);
        $.ajax({
            data: {
                'data': parametros
            },
            dataType: "json",
            //data: formData,
            url: '<?= base_url() ?>/clientes/eliminarDocumentoCliente',
            type: 'post',
            beforeSend: function() {
                $("#resultado").html("<?php echo lang('Translate.procesando'); ?>");
            },
            success: function(response) {
                //Cargamos los articulos en la tabla
                // console.log(response);
                var DocumentosCliente = response[0];
                CargarTablaDocumentos(DocumentosCliente);
            }
        });        
    }
}

function DescargarDocumento(boton)
{
    var linea = boton.parentElement.parentElement;
    var table = $("#datatableDocumentos").dataTable();
    var row = table.find("tr").eq(linea.rowIndex);
    var data = $("#datatableDocumentos").dataTable().fnGetData(row);
    var id = data.ID;
    window.open('<?= base_url() ?>/Clientes/descargarDocumento/'+id,
                                "_blank");
}


function EditarRecibo(boton)
{
    var linea = boton.parentElement.parentElement;
    var table = $("#tablaRecibos").dataTable();
    var row = table.find("tr").eq(linea.rowIndex);
    var data = $("#tablaRecibos").dataTable().fnGetData(row);       

    var idRecibo=data.ID;
    
    if(idRecibo!=0){
        window.location.assign("<?= base_url() ?>/recibos/edit/"+idRecibo);
    }
}

function GuardarCliente()
{   
    var nombre= $('#nombre').val();
    if (nombre=="")
    {
        alert('<?php echo lang('Translate.introduzcaNombre'); ?>');
        return false;
    }
    var apellidos= $('#apellidos').val();
    var dni= $('#dni').val();
    if (!validar_dni_nif_nie(dni))
    {
        alert('<?php echo lang('Translate.dniNoValido'); ?>');
        return false;
    }

    var domicilio= $('#domicilio').val();
    var poblacion= $('#poblacion').val();
    var cpostal= $('#cpostal').val();
    var contacto= $('#contacto').val();
    var telefono= $('#telefono').val();
    var email= $('#email').val();
    var formaPago= $('#formaPago').val();
    var cuenta= $('#cuenta').val();
    //SI LA FORMA DE PAGO ES 1 (RECIBO), COMPROBAMOS IBAN
    if(formaPago==1){
        if (!fn_ValidateIBAN(cuenta))
        {
            alert('<?php echo lang('Translate.ibanIncorrecto'); ?>');
            return false;
        }
    }
    var notas= $('#notas').val();
    // console.log('idCliente: '+idCliente);
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
        formaPago:formaPago,
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
        async: false,
        beforeSend: function() {
            $("#resultado").html("<?php echo lang('Translate.procesando'); ?>");
        },
        success: function(response) {
            if(response[0]==true){
                if(ShowAlGuardar==1){
                    // similar behavior as an HTTP redirect
                    window.location.assign("<?= base_url() ?>/clientes/show"); //le pongo hilerria porque no se porque no lo coge desde el base_url??
                } else {
                    idCliente = response[1];
                    ShowAlGuardar=1;
                    $(".alert").html("<?php echo lang('Translate.grabadoCliente'); ?>");
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
                };
            } else {
                alert(response[1]);
                return false;
            };
        }
    });

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
    var idArticulo = $("#modalInsertarCantidad").data('articulo');
    var disponible = $("#modalInsertarCantidad").data('disponible');
    var cantidad = $("#cantidad") .val();
    cantidad=cantidad.replace(',','.');
    if (!isNumeric(cantidad)){
        alert('<?php echo lang('Translate.cantidadNoNumerica'); ?>');
        return;
    }
    if (cantidad>disponible){
        alert('<?php echo lang('Translate.cantidadSuperaDisponible'); ?>');
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
            $("#resultado").html("<?php echo lang('Translate.procesando'); ?>");
        },
        success: function(response) {
                //Cargamos los articulos en la tabla
                // console.log(response);
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
    // console.log(parametros);
    $.ajax({
        data: {
            'data': parametros
        },
        dataType: "json",
        //data: formData,
        url: '<?= base_url() ?>/clientes/guardarComentarioCliente',
        type: 'post',
        beforeSend: function() {
            $("#resultado").html("<?php echo lang('Translate.procesando'); ?>");
        },
        success: function(response) {
                //Cargamos los articulos en la tabla
                // console.log(response);
                var ComentariosCliente = response[0];
                CargarTablaComentarios(ComentariosCliente);
            }
        
    });
    $("#modalComentarios").modal('hide');
}

function QuitarArticulo(id)
{
    if (confirm('<?php echo lang('Translate.eliminarSeguro'); ?>') == true) {
        // console.log(id);
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
                // console.log(response);
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
    if (confirm('<?php echo lang('Translate.eliminarSeguro'); ?>') == true) {
    
        var parametros = JSON.stringify({
            id:id,
            idCliente:idCliente,
        });
        // console.log(parametros);
        $.ajax({
            data: {
                'data': parametros
            },
            dataType: "json",
            //data: formData,
            url: '<?= base_url() ?>/clientes/eliminarComentarioCliente',
            type: 'post',
            beforeSend: function() {
                $("#resultado").html("<?php echo lang('Translate.procesando'); ?>");
            },
            success: function(response) {
                //Cargamos los articulos en la tabla
                var ComentariosCliente = response[0];
                CargarTablaComentarios(ComentariosCliente);
            }
        });
    }
}

function ImprimirArticulo(id)
{
    //con Window.open abrimos el pdf en una nueva pestaña
    window.open("<?= base_url() ?>/clientes/imprimirArticuloCliente/"+id,'_blank');    
}

function CargarTablaArticulosCliente(dataArticulos)
{
    var html = '<table class="table table-responsive-sm table-sm mt-4" style="color:black;">';
    html += '<thead>';
    html += '<tr>';
    html += '<th><?php echo lang('Translate.descripcion'); ?></th>';
    html += '<th><?php echo lang('Translate.numero'); ?></th>';
    html += '<th><?php echo lang('Translate.letra'); ?></th>';
    html += '<th><?php echo lang('Translate.categoria'); ?></th>';
    html += '<th><?php echo lang('Translate.cantidad'); ?></th>';
    html += '<th><?php echo lang('Translate.precio'); ?></th>';
    html += '<th><?php echo lang('Translate.importe'); ?></th>';
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
    $("#datatableComentarios").DataTable().clear();
    $("#datatableComentarios").DataTable().rows.add(comentariosCliente);
    $("#datatableComentarios").DataTable().draw();
}

function CargarTablaDocumentos(documentosCliente)
{
    $("#datatableDocumentos").DataTable().clear();
    $("#datatableDocumentos").DataTable().rows.add(documentosCliente);
    $("#datatableDocumentos").DataTable().draw();
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

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

document.getElementById("cuenta").addEventListener("keypress",ctaPress);
document.getElementById("cuenta").addEventListener("keyup",ctaUp);
document.getElementById("cuenta").addEventListener("paste",paste);
 
/**
 * Evento que se ejecuta cuando se pulsa una tecla
 */
function ctaPress(e)
{
    var a=e;
 
    var valor=e.target.value;
    var longitud=valor.length;
    if(valor.length>=29) {
        e.preventDefault();
    }
 
    // verificamos que sea introduzcan dos letras al inicio y numeros a continuacion
    var patronA=new RegExp(/^([a-zA-Z])$/);
    var patron1=new RegExp(/^([0-9])$/);
    if((longitud<2 && patronA.test(e.key)===false) || (longitud>=2 && patron1.test(e.key)===false))
    {
        e.preventDefault();
    }
 
    // una vez se haya validado el valor, lo redibujamos correctamente
    setTimeout(() => {
        a.target.value=redibujar(a.target.value);
    });
}
 
/**
 * Evento que se ejecuta cuando se suelta una tecla
 * Lo utilizamos para controlar si borra algun digito
 */
function ctaUp(e)
{
    var tecla=e.which || e.keyCode;
    // 8 - Backspace
    // 46 - Delete
    if(tecla==8 || tecla==46)
    {
        e.target.value=redibujar(e.target.value);
    }
}
 
/**
 * Función para redibujar el numero de cuenta
 * Se utiliza para cuando de borra o copia un numero de cuenta
 *
 * @param string valor
 */
function redibujar(valor)
{
    // eliminamos los espacios de la cadena
    valor=valor.replace(/\s/g, '').toUpperCase();
 
    // dibujamos nuevamente la cadena con los espacios se separacion
    var result="";
    var longitud=0;
    for(var i=0;i<valor.length;i++)
    {
 
        // añadimos los espacios de separacion
        if(longitud==4 || longitud==9 || longitud==14 || longitud==19 || longitud==24)
        {
            result+=" ";
        }
        result+=valor[i];
        longitud=result.length;
    }
    return result;
}
 
/**
 * Funcion que se ejecuta cuando se intente pegar un código
 * NOTA: Solo funciona si el campo esta vacio
 */
function paste(e)
{
    var a=e;
 
    // obtenemos el valor pegado desde la API de clipboard
    var clipboardData = e.clipboardData || window.clipboardData;
    var pastedData = clipboardData.getData('Text');
 
    var patron=new RegExp(/^([a-zA-Z]{2})([0-9]{1,22})?$/);
    if(a.target.value!="" || patron.test(pastedData)===false)
    {
        e.stopPropagation();
        e.preventDefault();
        return;
    }
 
    // Una vez pegado se ejecuta esta funcion
    window.setTimeout(() => {
        a.target.value=redibujar(a.target.value);
    });
}

</script>