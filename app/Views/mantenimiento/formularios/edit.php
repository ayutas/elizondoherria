<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Checklists</h1>
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
                                        <label class="small mb-1" for="nombre">Nombre</label>
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

                                    <div class="form-group">
                                        <!-- Campo Captura Articulo -->
                                        <label class="small mb-1" for="articulo">Captura artículo</label>
                                        <input type="checkbox" aria-label="Checkbox for following text input"
                                            id="articulo" name="articulo" <?php 
                                            if(isset($data[0])) 
                                            {                                         
                                                if ($data[0]->Articulo)
                                                {                                                
                                                    ?> checked="checked" <?php
                                                } 
                                                                                            
                                            }
                                        ?>>
                                        <!-- Campo Captura Lote -->
                                        <label class="small mb-1" for="lote">Captura lote</label>
                                        <input type="checkbox" aria-label="Checkbox for following text input" id="lote"
                                            name="lote" <?php 
                                            if(isset($data[0])) 
                                            {                                         
                                                if ($data[0]->Lote)
                                                {                                                
                                                    ?> checked="checked" <?php
                                                } 
                                                                                            
                                            }
                                        ?>>
                                        <!-- Campo Captura Caducidad -->
                                        <label class="small mb-1" for="caducidad">Captura caducidad</label>
                                        <input type="checkbox" aria-label="Checkbox for following text input"
                                            id="caducidad" name="caducidad" <?php 
                                            if(isset($data[0])) 
                                            {                                         
                                                if ($data[0]->Caducidad)
                                                {                                                
                                                    ?> checked="checked" <?php
                                                } 
                                                                                            
                                            }
                                        ?>>
                                    </div>
                                    <div class="form-group">
                                        <!-- Campo Captura Documento -->
                                        <label class="small mb-1" for="documento">Captura documento</label>
                                        <input type="checkbox" aria-label="Checkbox for following text input"
                                            id="documento" name="documento" <?php 
                                            if(isset($data[0])) 
                                            {                                         
                                                if ($data[0]->Documento)
                                                {                                                
                                                    ?> checked="checked" <?php
                                                } 
                                                                                            
                                            }
                                        ?>>
                                        <!-- Campo Captura Entidad -->
                                        <label class="small mb-1" for="entidad">Captura proveedor</label>
                                        <input type="checkbox" aria-label="Checkbox for following text input"
                                            id="entidad" name="entidad" <?php 
                                            if(isset($data[0])) 
                                            {                                         
                                                if ($data[0]->Entidad)
                                                {                                                
                                                    ?> checked="checked" <?php
                                                } 
                                                                                            
                                            }
                                        ?>>
                                        <!-- Campo Captura Motivo -->
                                        <label class="small mb-1" for="motivo">Captura motivo chequeo</label>
                                        <input type="checkbox" aria-label="Checkbox for following text input"
                                            id="motivo" name="motivo" <?php 
                                            if(isset($data[0])) 
                                            {                                         
                                                if ($data[0]->Motivo)
                                                {                                                
                                                    ?> checked="checked" <?php
                                                } 
                                                                                            
                                            }
                                        ?>>
                                        <!-- Campo Precargar -->
                                        <label class="small mb-1" for="motivo">Precargar datos cabecera</label>
                                        <input type="checkbox" aria-label="Checkbox for following text input"
                                            id="precargar" name="precargar" <?php 
                                            if(isset($data[0])) 
                                            {                                         
                                                if ($data[0]->Precargar)
                                                {                                                
                                                    ?> checked="checked" <?php
                                                } 
                                                                                            
                                            }
                                        ?>>
                                    </div>

                                    <!-- Combo Grupo -->
                                    <div class="form-group">
                                        <label class="small mb-1" for="id_grupo">Elemento</label>
                                        <select class="form-control py-2" id="id_grupo" name="id_grupo">
                                            <option value="0">-</option>
                                            <?php foreach($grupos as $grupo){ ?>
                                            <option class="dropdown-item id_grupo" style="color:black;" value="<?php echo $grupo->ID; ?>">
                                                <?php echo $grupo->Nombre; ?></option><?php
                                            }?>
                                        </select>
                                    </div>

                                    <!-- Campo captura imagen etiqueta -->
                                    <!-- <div class="form-group">
                                        <label class="small mb-1" for="capturaEtiqueta">Captura de etiqueta</label>
                                        <input class="" type="checkbox" id="capturaEtiqueta" name="capturaEtiqueta">
                                    </div> -->

                                    <!-- Lista checkbox Items -->
                                    <div class="form-group col-12" id="items">
                                        <?php foreach($items as $item){ ?>
                                        <!-- <div class="row col-12 mt-4"> -->
                                        <div class="col-6">
                                            <input type="text" id="itemorden<?php echo $item->ID; ?>"
                                                name="itemsorden[]" style="width: 25px;" value="">
                                            <input type="checkbox" id="item" name="items[]"
                                                value="<?php echo $item->ID; ?>" checked="">
                                            <label for="<?php echo $item->ID; ?>"> <?php echo $item->Nombre; ?></label>
                                        </div><?php }?>
                                        <!-- </div> -->
                                        <!-- <a href="<?= base_url()?>/formularios/agregaritems/<?php if(isset($data[0])){ echo $data[0]->ID;}?>" class="btn btn-primary">Guardar Items</a>                                              
                                                            -->
                                        <div class="col text-center">
                                            <a class="btn btn-primary btn-block col-6" style="color:white"
                                                id="guardarItems"> Guardar Items</a>
                                        </div>
                                    </div>

                                    <!-- Tabla grupos - items -->
                                    <div>
                                        <h3 for="tablaItems" style="text-align:center;">Items del cheklist</h3>
                                        <table class="table table-responsive-sm table-sm mt-4" id="tablaItems"
                                            name="tablaItems" style="color:black;">
                                            <thead>
                                                <tr>
                                                    <th>Elemento</th>
                                                    <th>Posición</th>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(isset($dataItems)) {foreach($dataItems as $item){ ?>
                                                <tr>
                                                    <td><?php echo $item->Nombre_grupo ?></td>
                                                    <td><?php echo $item->Posicion ?></td>
                                                    <td><?php echo $item->Nombre_item ?></td>
                                                </tr>
                                                <?php };}?>
                                            </tbody>
                                        </table>
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

                            <div id="prueba" class="col-12 form-group mt-4 mb-0">
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
<?php //return var_dump(json_encode($dataItems));?>
<script>
$(document).ready(function() {

    $("#items input").each(function() {
        $(this).prop('checked', false);
    });
    $("#items").hide();

    $("#id_grupo").on('click', function() {
        if ($('#id_grupo').val() == 0) {
            $("#items").hide();
        } else {
            $("#items").show();
            var idGrupo = $('#id_grupo').val();
            var arrayItems = <?php echo json_encode($dataItems);?>;

            $("#items input").each(function(e, x) {
                $('#itemorden' + x.value).val("");
                x.checked = false;
                $.each(arrayItems, function(i, v) {
                    // console.log(v.Id_grupo == idGrupo,v.Id_item== x.value);           
                    if (v.Id_grupo == idGrupo && v.Id_item == x.value) {
                        x.checked = true;

                        $('#itemorden' + x.value).val(v.Posicion);
                        return false;
                    } else {
                        $('#itemorden' + x.value).val("");
                        x.checked = false;
                    }
                });
            })
        }
    });

    $('#guardarItems').on('click', function() {

        var itemsSel = "";
        var hayItems = 0;

        itemsSel = "[";
        $("#items input").each(function(e, x) {

            if (x.checked) {
                itemsSel += '{"ID":' + x.value + ', "POS":' + $('#itemorden' + x.value).val() +
                    '},';
                hayItems = 1;
            }
        })
        if (hayItems) {
            itemsSel = itemsSel.slice(0, -1);
        }
        itemsSel += "]";

        console.log(itemsSel);

        var idGrupo = $('#id_grupo').val();
        var idFormulario = 0;
        <?php if(isset($data[0])){ ?> idFormulario = <?= $data[0]->ID;}?>;
        var nombreFormulario = $('#nombre').val();
        var parametros = JSON.stringify({
            items: itemsSel,
            idGrupo: idGrupo,
            idFormulario: idFormulario,
            nomFormulario: nombreFormulario
        });
        $.ajax({
            data: {
                'data': parametros
            },
            dataType: "json",
            url: '<?= base_url()?>/formularios/agregarItems',
            type: 'post',
            beforeSend: function() {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function(response) {
                if (response['redirect'] == true) {
                    // similar behavior as an HTTP redirect
                    window.location.replace("<?=base_url()?>/formularios/edit/" + response[
                        'id']);

                    // similar behavior as clicking on a link
                    // window.location.href = "http://stackoverflow.com";
                } else {
                    $dataItems = response;
                    var html =
                        "<thead><tr><th>Elemento</th><th>Posición</th><th>Descripción</th></tr></thead><tbody>";
                    $.each(response, function(r, item) {
                        html += "<tr>";
                        html += "<td>" + item["Nombre_grupo"] + "</td>";
                        html += "<td>" + item["Posicion"] + "</td>";
                        html += "<td>" + item["Nombre_item"] + "</td>";
                        html += "</tr>";
                        // idFormulario=item["Id_formulario"];
                    });
                    html += "</tbody>"
                    $("#tablaItems").html(html);
                }
            }
        });
    });

    //Cuando hacemos click en un item, si es para checkear le ponemos la posicion que correspondiente segun el orden en el que se han checkeado
    $('[id="item"]').click(function() {

        //cargamos en un array los items checkeados para luego saber cuantos hay checkeados
        var arr = $('[id="item"]:checked').map(function() {
            return this.value;
        }).get();

        var PosicionDescheked = "";
        if ($(this).prop('checked')) {
            //si acabamos de checkear uno, le ponemos la posicion ultima
            PosicionDescheked = "";
            $('#itemorden' + $(this).val()).val(arr.length);
        } else {
            //si acabamos de descheckear uno, nos guardamos el numero de posicion para recalcular los items que tengan una posicion superior y restarles 1
            PosicionDescheked = $('#itemorden' + $(this).val()).val();
            $('#itemorden' + $(this).val()).val("");
        }

        $('#items [type=text]').each(function(r, item) {

            if ($(this).val() != "" && PosicionDescheked != "") {
                //si el valor de la poisicion es superior al que se ha descheckeado, le restamos 1
                if ($(this).val() > parseInt(PosicionDescheked)) {
                    console.log('true?', $(this).val(), PosicionDescheked);
                    $(this).val($(this).val() - 1);
                }
            }

        });
    });

});
</script>