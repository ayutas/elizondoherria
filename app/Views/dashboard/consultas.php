<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Consultas</h1>
                <div class="container-fluid">
                    <form action="" method="post">     
                        <div class="row mt-3 ">                            
                            <div class="form-inline col-6">
                                <!-- Combo Delegaciones -->
                                <label class="mb-1 mr-2" for="id_delegacion">Delegacion:</label>
                                <select class="form-control comboSelector" id="id_delegacion" for="id_delegacion" name="id_delegacion">
                                    <option value="0"></option>
                                    <?php foreach($delegaciones as $delegacion){ ?>
                                    <option class="dropdown-item" style="color:black;"
                                        value="<?php echo $delegacion->ID; ?>">
                                        <?php echo $delegacion->ID . ' - ' . $delegacion->Delegación; ?></option><?php
                                        }?>
                                </select>
                            </div>

                            <div class="form-inline col-6">
                                <!-- Combo Lineas -->
                                <label class="mb-1 mr-2" for="id_linea">Línea:</label>
                                <select class="form-control comboSelector" multiple="multiple" id="id_linea" for="id_linea"
                                    name="id_linea">
                                    <option value="0"></option>
                                    <?php foreach($lineas as $linea){ ?>
                                    <option class="dropdown-item" style="color:black;"
                                        value="<?php echo $linea->ID; ?>">
                                        <?php echo $linea->Línea . ' - ' . $linea->Nombre; ?></option><?php
                                        }?>
                                </select>
                            </div>
                        </div>       
                        <!-- Combo Formulario -->                                                                       
                        <div class="row mt-3">  
                            <div class="form-inline col-6"> 
                                <label class="mb-1 mr-2" for="id_formulario">Cheklist:</label>
                                <select class="form-control comboSelector" multiple="multiple" id="id_formulario" for="id_formulario" name="id_formulario">        
                                    <option value="0"></option>
                                    <?php foreach($formularios as $formulario){ ?>
                                    <option class="dropdown-item id_formulario" style="color:black;" value="<?php echo $formulario->ID; ?>">
                                        <?php echo $formulario->Nombre; ?></option><?php
                                    }?>
                                </select> 
                            </div>
                            <div class="form-inline col-6">                                                                
                                <label class="mb-1 mr-2" for="id_grupo">Elemento:</label>
                                <select class="form-control comboSelector" multiple="multiple" id="id_grupo" for="id_grupo" name="id_grupo">        
                                    <option value="0"></option>
                                    <?php foreach($grupos as $grupo){ ?>
                                    <option class="dropdown-item id_grupo" style="color:black;" value="<?php echo $grupo->ID; ?>">
                                        <?php echo $grupo->Nombre; ?></option><?php
                                    }?>
                                </select>
                            </div>                             
                        </div> 

                        <div class="row mt-3">
                            <div class="form-inline col-6">
                                <label id="">Fecha desde:</label>
                                <input class="form-control ml-2" type="date" name="fechaDesde" id="fechaDesde" value="<?= date("Y-m-d",strtotime("-1 month"));?>">
                            </div>
                            <div class="form-inline col-6">
                                <label class="" id="">Fecha hasta:</label>
                                <input class="form-control ml-2" type="date" name="fechaHasta" id="fechaHasta" value="<?= date('Y-m-d');?>">
                            </div>
                        </div>   
                        <div class="row mt-3">
                            <div class="form-inline col-6">
                                <label class="" id="">Hora desde:</label>
                                <input class="form-control ml-2" type="time" name="horaDesde" id="horaDesde" value="<?= date('00:00');?>">
                            </div>
                            <div class="form-inline col-6">
                                <label class="" id=""> Hora desde:</label>
                                <input class="form-control ml-2" type="time" name="horaHasta" id="horaHasta" value="<?= date('00:00');?>">
                            </div>
                        </div>                           

                        <div class="row mt-3">
                            <!-- Combos articulo -->    
                            <div class="form-inline col-6">
                                <label  class="mb-1 mr-2" for="id_referencia">Ref: </label> 
                                <select class="form-control comboSelector" id="id_referencia" for="id_referencia" name="id_referencia" style="width: 75%">                                
                                <option value="0">-</option>
                                    <?php foreach($articulos as $articulo){ ?>
                                    <option value="<?php echo $articulo->ID; ?>">
                                        <?php echo $articulo->Referencia . ' - ' . $articulo->Descripcion . ' - ' . $articulo->Marca ;?></option><?php
                                    }?>
                                </select>
                            </div>
                            <!-- Combo Motivos -->                                                                       
                            <div class="form-inline col-6">                                                           
                                <label class="mb-1 mr-2" for="id_motivo">Motivo:</label>
                                <select class="form-control comboSelector" id="id_motivo" for="id_motivo" name="id_motivo" style="width: 75%">                                
                                    <option value="0"></option>
                                    <?php foreach($motivos as $motivo){ ?>
                                    <option class="dropdown-item id_motivo" style="color:black;" value="<?php echo $motivo->ID; ?>">
                                        <?php echo $motivo->Motivo; ?></option><?php
                                    }?>
                                </select>
                            </div> 
                        </div>                              
                            
                        <div class="row mt-3">
                            <div class="form-inline col-6">
                                <label class="mb-1 mr-2" for="lote">Lote:</label>
                                <input class="form-control" type="text" name="lote" id="loteValor">
                            </div>
                            <div class="form-inline col-6">
                                <label class="mb-1 mr-2" for="caducidad">Caducidad:</label>
                                <input class="form-control" type="text" name="caducidad" id="caducidadValor">
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="form-inline col-6">
                                <label class="mb-1 mr-2" for="documento">Albarán:</label>
                                <input class="form-control" type="text" name="documento" id="documentoValor">
                            </div>
                            <div class="form-inline col-6">
                                <label class="mb-1 mr-2" for="entidad">Proveedor:</label>
                                <input class="form-control" type="text" name="entidad" id="entidadValor">
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="form-inline col-6">
                                <label class="mb-1 mr-2" for="hayIncidencia">Hay incidencia: </label>
                                <input class="form-control" type="checkbox" name="hayIncidencia" id="hayIncidencia">
                            </div>
                            <div class="form-inline col-6">
                                <label class="mb-1 mr-2" for="sinRevisar">Pte revisar: </label>
                                <input class="form-control" type="checkbox" name="sinRevisar" id="sinRevisar">
                            </div>
                        </div>                      

                        <div clas="row mt-4">
                            <a id="buscar" class="btn btn-primary btn-lg btn-block mb-2">Buscar</a>
                        </div>

                        <div clas="row mt-2">
                            <?php // Miga de pan      
                                if(isset($data))
                                {                        
                                    dataTableConsultas("Consultas",$columns,$data,'consultas','9','text-center',"2,3,11,13",true);                         
                                }
                            ?>   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<div class="myAlert-bottom alert alert-success alertaOk text-center" style="position: fixed;bottom:30px;left:30%;width:50%;display:none">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Cargando datos, espere por favor...
</div>

<script>
    $(".comboSelector").select2();

    $("#id_delegacion").select2({
        minimumResultsForSearch: -1        
    });


    $("#buscar").on('click', function() {
        console.log('buscamos');
        //VAMOS RECOGIENDO TODOS LOS CAMPOS A FILTRAR
        var idDelegacion=$('#id_delegacion').val();
        var idDelegacionLinea = $('#id_linea').val();
        var idFormulario = $('#id_formulario').val();
        var idGrupo = $('#id_grupo').val();
        var idArticulo = $('#id_referencia').val();
        var idMotivo = $('#id_motivo').val();
        var fechaDesde=$('#fechaDesde').val();
        var horaDesde= $('#horaDesde').val(); 
        var fechaHasta=$('#fechaHasta').val();
        var horaHasta= $('#horaHasta').val();         
        var lote = $('#loteValor').val();     
        var caducidad = $('#caducidadValor').val();   
        var documento = $('#documentoValor').val();
        var entidad = $('#entidadValor').val();
        var hayIncidencia= $('#hayIncidencia').prop('checked');
        var sinRevisar= $('#sinRevisar').prop('checked');
        var parametros = JSON.stringify({          
            idDelegacion:idDelegacion,
            idDelegacionLinea:idDelegacionLinea,                                 
            idFormulario:idFormulario,
            idGrupo:idGrupo,
            idArticulo: idArticulo,   
            idMotivo:idMotivo,
            fechaDesde:fechaDesde,
            fechaHasta:fechaHasta,
            horaDesde:horaDesde,
            horaHasta:horaHasta,
            lote:lote,
            caducidad:caducidad,
            documento:documento,
            entidad:entidad,
            hayIncidencia:hayIncidencia,
            sinRevisar:sinRevisar
        });

        //paso como parametros al ajax en el JSON
        $.ajax({
            data: {
                'data': parametros
            },
            dataType: "json",
            //data: formData,
            url: '<?= base_url()?>/Consultas/buscar',
            type: 'post',
            beforeSend: function() {
                $(".alert").html(
                    "Cargando datos, por favor espere...");

                if ($('.alert').hasClass('alert-success')) {
                    $('.alert').removeClass('alert-success');
                    $('.alert').addClass('alert-warning');
                };
                if ($('.alert').hasClass('alert-danger')) {
                    $('.alert').removeClass('alert-danger');
                    $('.alert').addClass('alert-warning');
                };
                $('.alert').show();
            },
            success: function(response) {
                $('.alert').hide();
                console.log(response);
                $('#dataTable').DataTable().clear();
                if(response!=false){        
                    //$('#dataTable').remove();                  
                    
                    $.each(response, function(index, value) {
//                        console.log('ve voyyyy');
                        $('#dataTable').DataTable().row.add(value);
                    });                    
                } 
                $('#dataTable').DataTable().draw();
            }

        });
    });

</script>