<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="container">
                    <form action="<?= $action ?>" method="post">
                        <div class="row mt-3 ">
                            <div class="col-8">
                                <h6> <?= session()->get('delegacion') ?></h6>
                            </div>

                            <div class="col-4">
                                <div class="form-inline">
                                    <!-- Combo Lineas -->
                                    <label class="small mb-1 mr-auto" for="id_linea">Línea:</label>
                                    <select class="form-control py-2 comboSelector" id="id_linea" for="id_linea"
                                        name="id_linea">
                                        <option value="0"></option>
                                        <?php foreach ($lineas as $linea) { ?>
                                        <option class="dropdown-item id_grupo" style="color:black;"
                                            value="<?php echo $linea->ID; ?>">
                                            <?php echo $linea->Linea . ' - ' . $linea->Nombre; ?></option><?php
                                                                                                            } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-9">
                                <div class="form-inline">
                                    <!-- <div class="text-right"> -->
                                    <h6>Usuario: </h6>
                                    <!-- </div> -->
                                    <div class="">
                                        <h5 class="ml-2">
                                            <?php
                                            $sessionNombre = session()->get('nombre');
                                            $sessionAp1 = session()->get('ap1');
                                            $sessionAp2 = session()->get('ap2');

                                            echo $sessionNombre . " " . $sessionAp1 . " " . $sessionAp2;
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Combo Formulario -->
                        <div class="row">
                            <div class="col-12">
                                <select class="form-control py-2 ml-2 comboSelector" id="id_formulario"
                                    for="id_formulario" name="id_formulario">
                                    <option value="0"></option>
                                    <?php foreach ($formularios as $formulario) { ?>
                                    <option class="dropdown-item id_formulario" style="color:black;"
                                        value="<?php echo $formulario->ID; ?>">
                                        <?php echo $formulario->Nombre; ?></option><?php
                                                                                    } ?>
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="row mt-3">
                            <div class="col-12 form-inline">
                                <label id="">Fecha/hora de registro:</label>
                                <input class="form-control ml-2" type="date" name="fecha" id="fecha"
                                    value="<?= date('Y-m-d'); ?>">
                                <input class="form-control ml-2" type="time" name="hora" id="hora"
                                    value="<?= date('H:i'); ?>">
                            </div>
                        </div>


                        <div id="camposCabecera">
                            <div class="row mt-3" id="articulo">
                                <!-- Combos articulo -->
                                <div class="form-inline col-12">
                                    <div class="col-4 text-right">
                                        <label for="Referencia">Referencia: </label>
                                    </div>
                                    <div class="col-8">
                                        <select class="form-control py-3 col-12 comboSelector" id="id_referencia"
                                            for="id_referencia" name="id_referencia">
                                            <option value="0">-</option>
                                            <?php foreach ($articulos as $articulo) { ?>
                                            <option value="<?php echo $articulo->Id_Articulo; ?>">
                                                <?php echo $articulo->Referencia . ' - ' . $articulo->Descripción . ' - ' . $articulo->Marca; ?>
                                            </option>
                                            <?php
                                            } ?>
                                        </select>
                                        <!-- <select class="form-control py-3 col-6 comboSelector" id="descripcion" for="descripcion" name="descripcion">                                
                                            <?php foreach ($articulos as $articulo) { ?>
                                            <option value="<?php echo $articulo->Id_Articulo; ?>">
                                                <?php echo $articulo->Descripción; ?></option><?php
                                                                                            } ?>
                                        </select> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3" id="motivo">
                                <!-- Combo Motivos -->
                                <div class="form-inline col-12">
                                    <div class="col-4 text-right">
                                        <label for="motivo">Motivo:</label>
                                    </div>
                                    <!-- </div> -->
                                    <div class="col-8">
                                        <select class="form-control py-2 comboSelector" id="id_motivo" for="id_motivo"
                                            name="id_motivo">
                                            <option value="0"></option>
                                            <?php foreach ($motivos as $motivo) { ?>
                                            <option class="dropdown-item id_motivo" style="color:black;"
                                                value="<?php echo $motivo->ID; ?>">
                                                <?php echo $motivo->Motivo; ?></option><?php
                                                                                        } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 text-center" id="lotecad">
                                <div class="form-inline col-12 ">
                                    <div class="form-inline col-6" id="lote">
                                        <div class="col-3">
                                            <label for="lote">Lote:</label>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="lote" id="loteValor">
                                        </div>
                                    </div>
                                    <div class="form-inline col-6" id="caducidad">
                                        <div class="col-3">
                                            <label for="caducidad">Caducidad:</label>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="caducidad"
                                                id="caducidadValor">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 text-center" id="albprov">
                                <div class="form-inline col-12">
                                    <div class="form-inline col-6" id="documento">
                                        <div class="col-3">
                                            <label for="documento">Albarán:</label>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="documento"
                                                id="documentoValor">
                                        </div>
                                    </div>
                                    <div class="form-inline col-6" id="entidad">
                                        <div class="col-3">
                                            <label for="entidad">Proveedor:</label>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="entidad" id="entidadValor">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="container mt-4" id="camposCuerpo" style="display:none;">
                            <div class="accordion" id="accordion" role="tablist">
                                <div class="card mb-0">
                                    <div class="card-header bg-white" id="headingOne" role="tab">
                                        <h5 class="mb-0"><a data-toggle="collapse" href="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne"
                                                class="collapsed">Lote/Caducidad</a></h5>
                                    </div>
                                    <div class="collapse" id="collapseOne" role="tabpanel" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body bg-white">
                                            <div class="row">
                                                <div class="form-inline col-12">
                                                    <div class="mt-3 col-6 text-center"> Marca comercial Hacendado
                                                        <div class="o-switch btn-group bg-white " data-toggle="buttons"
                                                            role="group">
                                                            <label class="btn btn-secondary  bg-white"
                                                                style="color:black;border-right:1px solid #000;">
                                                                <input type="radio" name="options" id="option1"
                                                                    autocomplete="off"><i
                                                                    class="far fa-check-circle mb-3"
                                                                    style="color:#20f559;font-weight:bold;font-size:1.5em;width:auto;"></i>
                                                            </label>
                                                            <label class="btn btn-secondary bg-white"
                                                                style="color:black;border-left:1px solid #000;border-right:1px solid #000;">
                                                                <input type="radio" name="options" id="option2"
                                                                    autocomplete="off" checked="">
                                                            </label>
                                                            <label class="btn btn-secondary bg-white"
                                                                style="color:black;border-left:1px solid #000;">
                                                                <input type="radio" name="options" id="option3"
                                                                    autocomplete="off"><i
                                                                    class="fas fa-times-circle mb-3"
                                                                    style="color:red;font-weight:bold;font-size:1.5em;width:auto;"></i>
                                                            </label>
                                                        </div>
                                                        <div class="mt-4 col-12">
                                                            <textarea class="col-12" name="" id="" cols="" rows="4"
                                                                width="100%"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3 col-6 text-center"> Marca
                                                        <div class="o-switch btn-group bg-white " data-toggle="buttons"
                                                            role="group">
                                                            <label class="btn btn-secondary  bg-white"
                                                                style="color:black;border-right:1px solid #000;">
                                                                <input type="radio" name="options" id="option1"
                                                                    autocomplete="off"><i
                                                                    class="far fa-check-circle  mb-3"
                                                                    style="color:#20f559;font-weight:bold;font-size:1.5em;width:auto;"></i>
                                                            </label>
                                                            <label class="btn btn-secondary bg-white"
                                                                style="color:black;border-left:1px solid #000;border-right:1px solid #000;">
                                                                <input type="radio" name="options" id="option2"
                                                                    autocomplete="off" checked="">
                                                            </label>
                                                            <label class="btn btn-secondary bg-white"
                                                                style="color:black;border-left:1px solid #000;">
                                                                <input type="radio" name="options" id="option3"
                                                                    autocomplete="off"><i
                                                                    class="fas fa-times-circle  mb-3"
                                                                    style="color:red;font-weight:bold;font-size:1.5em;width:auto;"></i>
                                                            </label>
                                                        </div>
                                                        <div class="mt-4 col-12">
                                                            <textarea class="col-12" name="" id="" cols="" rows="4"
                                                                width="100%"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="card bg-white">
                                <div class="card-header">
                                    Lote/Caducidad
                                </div>
                                <div class="card-body">
                                    <div class="form-inline col-12">
                                        <div class="mt-3 col-6 text-center"> Marca comercial Hacendado
                                            <div class="o-switch btn-group bg-white " data-toggle="buttons"
                                                role="group">
                                                <label class="btn btn-secondary  bg-white"
                                                    style="color:black;border-right:1px solid #000;">
                                                    <input type="radio" name="options" id="option1"
                                                        autocomplete="off"><i class="far fa-check-circle mb-3"
                                                        style="color:#20f559;font-weight:bold;font-size:1.5em;width:auto;"></i>
                                                </label>
                                                <label class="btn btn-secondary bg-white"
                                                    style="color:black;border-left:1px solid #000;border-right:1px solid #000;">
                                                    <input type="radio" name="options" id="option2" autocomplete="off"
                                                        checked="">
                                                </label>
                                                <label class="btn btn-secondary bg-white"
                                                    style="color:black;border-left:1px solid #000;">
                                                    <input type="radio" name="options" id="option3"
                                                        autocomplete="off"><i class="fas fa-times-circle mb-3"
                                                        style="color:red;font-weight:bold;font-size:1.5em;width:auto;"></i>
                                                </label>
                                            </div>
                                            <div class="mt-4 col-12">
                                                <textarea class="col-12" name="" id="" cols="" rows="4"
                                                    width="100%"></textarea>
                                            </div>
                                        </div>


                                        <div class="mt-3 col-6 text-center"> Marca
                                            <div class="o-switch btn-group bg-white " data-toggle="buttons"
                                                role="group">
                                                <label class="btn btn-secondary  bg-white"
                                                    style="color:black;border-right:1px solid #000;">
                                                    <input type="radio" name="options" id="option1"
                                                        autocomplete="off"><i class="far fa-check-circle  mb-3"
                                                        style="color:#20f559;font-weight:bold;font-size:1.5em;width:auto;"></i>
                                                </label>
                                                <label class="btn btn-secondary bg-white"
                                                    style="color:black;border-left:1px solid #000;border-right:1px solid #000;">
                                                    <input type="radio" name="options" id="option2" autocomplete="off"
                                                        checked="">
                                                </label>
                                                <label class="btn btn-secondary bg-white"
                                                    style="color:black;border-left:1px solid #000;">
                                                    <input type="radio" name="options" id="option3"
                                                        autocomplete="off"><i class="fas fa-times-circle  mb-3"
                                                        style="color:red;font-weight:bold;font-size:1.5em;width:auto;"></i>
                                                </label>
                                            </div>
                                            <div class="mt-4 col-12">
                                                <textarea class="col-12" name="" id="" cols="" rows="4"
                                                    width="100%"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="container " id="imagenes">

                                        <!-- AQUI TENGO QUE PONER EL TEMA DE PODER ACTIVAR LA CAMARA PARA HACER LA FOTO -->
                                        <div class="custom-file mt-2" id="div_etiqueta">
                                            <input type="file" class="custom-file-input" capture='camera'
                                                name="imagenEtiqueta" id="imagenEtiqueta"
                                                accept="image/png, image/jpeg">
                                            <label class="custom-file-label" for="imagenEtiqueta"
                                                data-browse="Examinar">Seleccionar Archivo</label>
                                        </div>
                                        <div class="imgbase64 mt-2 col-12">
                                            <img src="" class="img-fluid rounded mx-auto d-block" alt=""
                                                id="ejemploEtiqueta" style="border:1px solid #dee2e6;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-group mt-4 mb-0">>
                            <label for="mantenerDatos">
                                <input type="checkbox" class="form-check-input" id="mantenerDatos">Mantener datos
                            </label>
                        </div>
                        <div class="col-12 form-group mt-4 mb-0">
                            <label for="observaciones">Observaciones:</label>
                            <textarea class="col-12 form-control" name="" id="observaciones" cols="" rows="2"
                                width="100%"></textarea>
                        </div>
                        <div class="col-12 form-group mt-4 mb-0">
                            <a class="btn btn-primary btn-block finalizarChequeo" style="color:white;"
                                name="finalizarChequeo" id="finalizarChequeo"> Finalizar chequeo</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<div class="myAlert-bottom alert alert-success alertaOk text-center"
    style="position: fixed;bottom:30px;left:30%;width:50%;display:none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Chequeo registrado <strong>Correctamente!</strong>
</div>

<!-- <div class="myAlert-bottom alert alert-warning alertaKO text-center" style="position: fixed;bottom:30px;left:30%;width:50%;display:none">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Debe marcar todos los items para poder guardar!
</div> -->

<script>
var itemsGuardados = [];

$(document).ready(function() {

    $("#mantenerDatos").on('change', function() {
        if ($("#mantenerDatos").prop('checked')) {
            MantenerDatos();
        }
    })

    var precargado = 0;
    var editando = 0;

    $(".comboSelector").select2({
        placeholder: 'referencia',
    });
    $("#id_linea").select2({
        minimumResultsForSearch: -1
    });
    $("#id_formulario").select2({
        minimumResultsForSearch: -1
    });
    $("#id_motivo").select2({
        minimumResultsForSearch: -1
    });


    $("#camposCabecera").hide();
    $("#camposCuerpo").hide();
    $('.alert').hide();



    $("#id_formulario").on('change', function() {
        $("#camposCabecera").hide();
        $("#camposCuerpo").hide();
        if ($('#id_formulario').val() != 0) {


            cargarCabecera();

        }
        itemsGuardados = [];
    });

    function cargarCabecera(idFrmulario) {
        console.log('inicio cargarCabecera');
        //ANTES QUE NADA REVISO QUE LA LINEA SE HAN COMPLETADO PARA SEGUIR CON EL FORMULARIO
        var idDelegacionLinea = $('#id_linea').val();
        if (idDelegacionLinea == 0) {
            //LIMPIO EL COMBO DEL FORMULARIO
            $('#id_formulario').val(0);
            $('#id_formulario').trigger('change');
            //MUESTRO ALERTA
            $(".alert").html("Debe indicar la linea!");
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
            }, 2000);
        } else {
            var idFormulario = $('#id_formulario').val();
            var arrayFormularios = <?php echo json_encode($formularios); ?>;

            //BUSCO SOLO LOS FORMULARIOS POR SU ID Y ME QUEDO CON EL PRIMERO, PORQUE SOLO DEBERÍA HABER 1
            var formularios = $.grep(arrayFormularios, function(x) {
                return x.ID == idFormulario;
            });
            var formulario = formularios[0];
            // console.log(idFormulario);          
            if (formulario.Caducidad == "0" && formulario.Lote == "0" && formulario.Documento == "0" &&
                formulario.Entidad == "0" && formulario.Articulo == "0" && formulario.Motivo == "0") {
                $("#camposCabecera").hide();
            } else {
                if (formulario.Caducidad == "0" && formulario.Lote == "0") {
                    $("#lotecad").hide();
                } else {
                    $("#lotecad").show();
                    if (formulario.Caducidad == "0") {
                        $("#caducidad").hide();
                    } else {
                        $("#caducidad").show();
                    }

                    if (formulario.Lote == "0") {
                        $("#lote").hide();
                    } else {
                        $("#lote").show();
                    }
                }
                if (formulario.Documento == "0" && formulario.Entidad == "0") {
                    $("#albprov").hide();
                } else {
                    $("#albprov").show();
                    if (formulario.Documento == "0") {
                        $("#documento").hide();
                    } else {
                        $("#documento").show();
                    }

                    if (formulario.Entidad == "0") {
                        $("#entidad").hide();
                    } else {
                        $("#entidad").show();
                    }
                }
                if (formulario.Articulo == "0") {
                    $("#articulo").hide();
                } else {
                    $("#articulo").show();
                }
                if (formulario.Motivo == "0") {
                    $("#motivo").hide();
                } else {
                    $("#motivo").show();
                }
                if (formulario.Precargar == "1") {
                    console.log('editando', editando);
                    if (editando == 0) {
                        PrecargarFormulario(formulario.ID);
                    }
                }

                $("#camposCabecera").show();
            }
            console.log('fin cargarCabecera');
        }
    }

    $("#id_referencia").on('change', async function() {
        console.log('inicio cambio referencia');
        if (precargado == 1) {
            precargado = 0;
        } else {
            console.log('no he precargado por lo cargo los items del articulo');
            if ($('#id_referencia').val() == 0) {
                $("#camposCuerpo").hide();
            } else {
                await CargarItemsArticulo();

            }
        }
        idRegistro = 0;
        if ($("#mantenerDatos").prop('checked')) {
            console.log('entro MantenerDatos');
            MantenerDatos();
        }
        console.log('fin cambio referencia');
    });


    function PrecargarFormulario(idFormulario) {
        console.log('inicio PrecargarFormulario');
        var idDelegacionLinea = $('#id_linea').val();
        if (idDelegacionLinea != 0) {
            // $('document').css('cursor', 'wait');
            var parametros = JSON.stringify({
                idFormulario: idFormulario,
                idDelegacionLinea: idDelegacionLinea,
            });
            // console.log(idFormulario,idDelegacionLinea);
            $.ajax({
                data: {
                    'data': parametros
                },
                dataType: "json",
                //data: formData,
                url: '<?= base_url() ?>/ChequeoRecepcion/obtenerItemsRegistroAnterior',
                type: 'post',
                beforeSend: function() {
                    $(".alert").html("Cargando datos, espere por favor...");
                    if ($('.alert').hasClass('alert-success')) {
                        $('.alert').removeClass('alert-success');
                        $('.alert').addClass('alert-danger');
                    };
                    if ($('.alert').hasClass('alert-warning')) {
                        $('.alert').removeClass('alert-warning');
                        $('.alert').addClass('alert-danger');
                    };
                    $('.alert').show();

                },
                success: function(response) {
                    $('.alert').hide();
                    if (response['nodata'] != true) {
                        // console.log(response);
                        PrecargarDatosCabecera(response[0])
                        console.log(response[1]);
                        CargarItemsEnPantalla(response[1]);
                    } else {
                        console.log('no hay datos de chequeo anterior')
                    }
                }

            });
            // $('document').css('cursor', 'default');
        } else {
            //LIMPIO EL COMBO DEL FORMULARIO
            $('#id_formulario').val(0);
            $('#id_formulario').trigger('change');
            //MUESTRO ALERTA
            $(".alert").html("Debe indicar la linea!");
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
            }, 2000);
        }
        console.log('fin PrecargarFormulario');

    }

    function PrecargarDatosCabecera(response) {
        console.log('inicio PrecargarDatosCabecera');
        var cabecera = response[0];
        precargado = 1;
        $('#id_referencia').val(cabecera.IdArticulo);
        //CON EL CHANGE APLICAMOS EL CAMBIO PORQUE SINO NO SE REFRESCA EL CAMBIO DE ID
        $('#id_referencia').trigger('change');
        $('#loteValor').val(cabecera.Lote);
        $('#caducidadValor').val(cabecera.Caducidad);
        $('#documentoValor').val(cabecera.Documento);
        $('#entidadValor').val(cabecera.Entidad);
        $('#id_motivo').val(cabecera.IdMotivo);
        $('#id_motivo').trigger('change');
        console.log('fin PrecargarDatosCabecera');
    }

    function CargarDatosCabecera(response) {
        console.log('inicio CargarDatosCabecera');
        var cabecera = response[0];
        $('#id_linea').val(cabecera.IdLineaDelegacion);
        //CON EL CHANGE APLICAMOS EL CAMBIO PORQUE SINO NO SE REFRESCA EL CAMBIO DE ID
        $('#id_linea').trigger('change');
        $('#id_formulario').val(cabecera.IdFormulario);
        //CON EL CHANGE APLICAMOS EL CAMBIO PORQUE SINO NO SE REFRESCA EL CAMBIO DE ID
        $('#id_formulario').trigger('change');
        var fechaHora = cabecera.Fecha.split(' ');
        $('#fecha').val(fechaHora[0]);
        $('#hora').val(fechaHora[1]);
        $('#observaciones').val(cabecera.Observaciones);
        PrecargarDatosCabecera(response);
        console.log('fin CargarDatosCabecera');
    }

    async function CargarItemsArticulo() {

        var idFormulario = $('#id_formulario').val();
        var idArticulo = $('#id_referencia').val();

        var parametros = JSON.stringify({
            idRegistro: idRegistro,
            idArticulo: idArticulo,
            idFormulario: idFormulario,
        });

        await $.ajax({
            data: {
                'data': parametros
            },
            dataType: "json",
            //data: formData,
            url: '<?= base_url() ?>/ChequeoRecepcion/obtenerItemsChequeoFormArtAjax',
            type: 'post',
            beforeSend: function() {
                $(".alert").html("Cargando datos, espere por favor...");
                if ($('.alert').hasClass('alert-success')) {
                    $('.alert').removeClass('alert-success');
                    $('.alert').addClass('alert-danger');
                };
                if ($('.alert').hasClass('alert-warning')) {
                    $('.alert').removeClass('alert-warning');
                    $('.alert').addClass('alert-danger');
                };
                $('.alert').show();
            },
            success: function(response) {
                $('.alert').hide();
                CargarItemsEnPantalla(response);
            }

        });
    }

    function CargarItemsEnPantalla(response) {
        console.log('inicio CargarItemsEnPantalla');
        gruposItems = response;

        var idGrupo = 0;
        var html = "";
        var etiquetaEjemplo = "";
        var capturarImagen = 0;
        html += '<div class="accordion" id="accordion" role="tablist">'
        $.each(gruposItems, function(i, v) {
            // console.log(idGrupo,v.IdGrupo);
            if (idGrupo != v.IdGrupo) {
                // console.log('Cambio de grupo');


                //DETECTO CADA CAMBIO DE GRUPO PARA IR CREANDO LOS ITEMS EN EL GRUPO AL QUE PERTENECEN
                if (idGrupo != 0) {
                    //SI NO ES LA PRIMERA VEZ TENGO QUE CERRAR LOS DIV DEL CARD BODY ANTES QUE NADA
                    html += "</div>"; //form.inline
                    html += "</div>"; //body
                    //AQUI HAGO LA CARGA DE LA IMAGEN DE EJEMPLO SI LA HAY
                    if (capturarImagen == 1) {
                        if (!etiquetaReal) {
                            etiquetaReal = "";
                        }
                        if (!idGrupo) {
                            idGrupo = "";
                        }
                        html +=
                            "<div class='card-footer bg-white' style='border:0px;' id='imagenes'><div class='imgbase64  col-12'>";
                        html += "<embed type='image/png' ";
                        if (etiquetaEjemplo != "" && etiquetaEjemplo != null) {
                            html += "src='" + '<?= base_url() ?>' + '/' + etiquetaEjemplo + "'";
                        } else {
                            html += "src=''";
                        }
                        html += " width='100%' height='auto' id='etiquetaEjemplo" +
                            idGrupo + "' style='border:1px solid #dee2e6;'></embed>";
                        html +=
                            '<div class="custom-file " id="div_etiqueta"><input type="file" class="custom-file-input" capture="camera" name="imagenEtiqueta" id="imagenEtiqueta" data-id="' +
                            idGrupo +
                            '" accept="image/png, image/jpeg"><label class="custom-file-label" for="imagenEtiqueta" data-browse="Foto"></label> </div>';
                        html += "<img src='" + '<?= base_url() ?>' + '/' + etiquetaReal +
                            "' class='img-fluid mt-3 rounded mx-auto d-block' alt='' id='etiquetaReal" +
                            idGrupo + "' style='border:1px solid #dee2e6;'></div>";
                        html +=
                            "<!-- AQUI TENGO QUE PONER EL TEMA DE PODER ACTIVAR LA CAMARA PARA HACER LA FOTO -->";
                        html += "</div>";
                    }
                    //AÑADO EL BOTON DE GUARDAR LOS ITEMS PARA ESE GRUPO
                    html += '<div class="card-footer bg-white" style="border-top:0px;">';
                    html += '<div class="col-12 text-center">';
                    html +=
                        '<a class="btn btn-primary col-12 guardarItemsGrupo" style="color:white;" data-id="' +
                        idGrupo + '" id="guardarItemsGrupo' + idGrupo + '"> Guardar chequeo</a>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>'; //collapse
                    html += '</div>'; //card
                    // html+='</div>';//accordion        
                    // html+="</div>";//container
                }
                idGrupo = v.IdGrupo;
                etiquetaEjemplo = v.EjemploEtiqueta;
                etiquetaReal = v.EtiquetaReal
                capturarImagen = v.CapturaImagen;

                //CREO EL CARD HEADER CON EL NOMBRE DEL GRUPO
                // html+= "<div class='container mt-4' bg-white>"
                //acordeon
                // html+='<div class="accordion" id="accordion" role="tablist">'
                //card    
                html += '<div class="card mb-0">'
                //header
                //SI EL GRUPO YA ESTÁ CHEQUEADO, VIENE EL VALOR Completado a 1 POR LO QUE LO PONEMOS EN VERDE
                if (v.Completado == 1) {
                    html += '<div class="card-header bg-success" id="heading' + v.IdGrupo +
                        '" role="tab"><h5 class="mb-0"><a style="color:white"'
                } else {
                    html += '<div class="card-header bg-white" id="heading' + v.IdGrupo +
                        '" role="tab"><h5 class="mb-0"><a'
                }
                html += ' data-toggle="collapse" href="#collapse' + v.IdGrupo +
                    '" aria-expanded="false" aria-controls="collapse' + v.IdGrupo +
                    '" class="collapsed">' + v.NombreGrupo + '</a></h5>'
                html += '</div>'
                //collapse
                html += '<div class="collapse" id="collapse' + v.IdGrupo +
                    '" role="tabpanel" aria-labelledby="heading' + v.IdGrupo +
                    '" data-parent="#accordion">'
                //Y ABRO EL CARD BODY PARA IR AÑADIENDO CADA ITEM
                html += "<div class='card-body bg-white'>";
                html += "<div class='form-inline col-12'>";
            }
            html += '<div class="mt-3 col-6 form-inline"><div class="col-6 ">' + v.NombreItem +
                '</div>';
            html += '<div class="o-switch btn-group bg-white" data-toggle="buttons" role="group">';
            html += '<label class="btn btn-secondary  bg-white options ';
            if (v.Valor == 1) {
                html += 'active';
            }
            html += '" data-id="' + v.ID +
                '" data-estado="ok" style="color:black;border-right:1px solid #000;">';
            html += '<input class="form-control items" type="radio" value="ok" id="ok' + v.ID +
                '" name="' + v.ID + '" autocomplete="off"';
            if (v.Valor == 1) {
                html += ' checked ';
            }
            html +=
                '><i class="far fa-check-circle  mb-3" style="color:#20f559;font-weight:bold;font-size:1.5em;width:auto;"></i>';
            html += '</label>';
            html += '<label class="btn btn-secondary bg-white options ';
            if (v.Valor == null) {
                html += 'active';
            }
            html += '" data-id="' + v.ID +
                '" data-estado="ne" style="color:black;border-left:1px solid #000;border-right:1px solid #000;">';
            html += '<input class="form-control items" type="radio" value="ne" id="ne' + v.ID +
                '" name="' + v.ID +
                '" autocomplete="off"';
            if (v.Valor == null) {
                html += ' checked ';
            }
            html += '>';
            html += '</label>';
            html += '<label class="btn btn-secondary bg-white options ';
            if (v.Valor == 0) {
                html += 'active';
            }
            html += '" data-id="' + v.ID +
                '" data-estado="ko" style="color:black;border-left:1px solid #000;">';
            html += '<input class="form-control items" type="radio" value="ko" id="ko' + v.ID +
                '" name="' + v.ID +
                '" autocomplete="off"';
            if (v.Valor == 0) {
                html += ' checked ';
            }
            html +=
                '><i class="fas fa-times-circle  mb-3" style="color:red;font-weight:bold;font-size:1.5em;width:auto;"></i>';
            html += '</label>';
            html += '</div>';
            html += '<div class="mt-4 col-12" id="itemObservaciones' + v.ID + '" ';
            if (v.Valor != 0) {
                html += 'hidden';
            }
            html += '>';
            html +=
                '<div class="col-12 row"><label>Inicidencia:</label><textarea class="col-12 form-control" name="" id="itemProblema' +
                v.ID +
                '" cols="" rows="2" width="100%">' + v.Problema + '</textarea></div>';
            html += '<br>';
            html +=
                '<div class="col-12 row"><label>Corrección:</label><textarea class="col-12 form-control" name="" id="itemSolucion' +
                v.ID +
                '" cols="" rows="2" width="100%">' + v.Solucion + '</textarea></div>';
            html +=
                '<div class="col-12 row"><a class="btn btn-primary mt-3 botonObservaciones col-12" name="" id="GuardarObservaciones' +
                v.ID + '" data-id="' + v.ID + '" style="color:white;">Guardar Incidencia</a></div>';
            html += '</div>';
            html += '</div>';
        });
        if (idGrupo != 0) {
            //UNA VEZ RECORRIDOS TODOS LOS ITEMS, CIERRO EL ULTIMO CUADRO 
            html += "</div>"; //form.inline
            html += "</div>"; //body
            //AQUI HAGO LA CARGA DE LA IMAGEN DE EJEMPLO SI LA HAY
            if (capturarImagen == 1) {
                if (!etiquetaReal) {
                    etiquetaReal = "";
                }
                if (!idGrupo) {
                    idGrupo = "";
                }
                html +=
                    "<div class='card-footer bg-white' id='imagenes' style='border:0px;'><div class='imgbase64  col-12'>";
                html += "<embed type='image/png' ";
                if (etiquetaEjemplo != "" && etiquetaEjemplo != null) {
                    html += "src='" + '<?= base_url() ?>' + '/' + etiquetaEjemplo + "'";
                } else {
                    html += "src=''";
                }
                html += " width='100%' height='auto' id='etiquetaEjemplo" + idGrupo +
                    "' style='border:1px solid #dee2e6;'></embed>";
                html +=
                    '<div class="custom-file " id="div_etiqueta"><input type="file" class="custom-file-input" capture="camera" name="imagenEtiqueta" id="imagenEtiqueta" data-id="' +
                    idGrupo +
                    '" accept="image/png, image/jpeg"" ><label class="custom-file-label" for="imagenEtiqueta" data-browse="Foto"></label> </div>';
                html += "<img src='" + '<?= base_url() ?>' + '/' + etiquetaReal +
                    "' class='img-fluid mt-3 rounded mx-auto d-block' alt='' id='etiquetaReal" + idGrupo +
                    "' style='border:1px solid #dee2e6;'></div>";
                html += "<!-- AQUI TENGO QUE PONER EL TEMA DE PODER ACTIVAR LA CAMARA PARA HACER LA FOTO -->";
                html += "</div>";
            }

            //AÑADO EL BOTON DE GUARDAR LOS ITEMS PARA ESE GRUPO
            html += '<div class="card-footer bg-white" style="border-top:0px;">';
            html += '<div class="col-12 text-center">';
            html += '<a class="btn btn-primary col-12 guardarItemsGrupo" style="color:white;" data-id="' +
                idGrupo + '" id="guardarItemsGrupo' + idGrupo + '"> Guardar chequeo</a>';
            html += '</div>';
            html += '</div>';
            html += '</div>'; //collapse
            html += '</div>'; //card
            html += '</div>'; //accordion        
            // html+="</div>";//container

        }
        //ASIGNO EL HTML CON TODOS LOS CHECKBOX Y LUEGO MUESTRO
        html += '</div>';
        $("#camposCuerpo").html(html);
        $("#camposCuerpo").show();

        console.log('fin CargarItemsEnPantalla');
    }

    $(document).on('click', '.options', function() {
        // var id= $(this).data('estado')+$(this).data('id');
        var estado = $(this).data('estado');
        var id = $(this).data('id');
        var item = estado + id;
        $("#" + item).prop('checked', true);
        if (estado == "ko") {
            $("#itemObservaciones" + id).removeAttr('hidden');
            console.log(id, $("#" + item).val());
        } else {
            $("#itemObservaciones" + id).attr("hidden", true);
        }
    });


    $(document).on('click', '.botonObservaciones', function() {
        console.log('hola holita');
        var id = $(this).data('id');
        $("#itemObservaciones" + id).attr("hidden", true);
    });


    $(document).on('click', '.guardarItemsGrupo', function() {

        console.log('holaaaaaa');
        var idGrupo = $(this).data('id');
        console.log(idGrupo);

        if (idGrupo != 0) {
            var itemsSel = "";
            var hayItems = 0;
            var todoBienItems = 1;
            var todoBienImagen = 1;
            var todoBien = 1;
            console.log('empiezo', todoBienItems);
            items = "[";
            //RECORREMOS LOS ITEMS QUE TIENE QUE TENER CADA GRUPO PARA VER SI ESTÁN CON OK O KO, Y NOS QUEDAMOS CON EL VALOR DE CADA ITEM PARA GRABARLO, SI ES KO TENGO QUE COGER TAMBIEN LAS OBSEVACIONES
            $("#collapse" + idGrupo + " .items:radio:checked").each(function(e, x) {
                console.log(x);

                if (x.checked) {
                    if (x.value == "ko") {
                        console.log('ko');
                        items += '{"ID":' + x.name + ', "VALOR":0' + ', "PROBLEMA":"' + $(
                            "#itemProblema" + x.name).val() + '", "SOLUCION": "' + $(
                            "#itemSolucion" + x.name).val() + '"},';
                        // console.log(items);
                    } else {
                        if (x.value == "ok") {
                            console.log('ok');
                            items += '{"ID":' + x.name + ', "VALOR":1' +
                                ', "PROBLEMA":"", "SOLUCION": ""},';
                            // console.log(items);
                        } else {
                            //MAL ASUNTO PORQUE HAY ALGUN ITEM QUE NO ESTÁ EN OK NI KO.
                            // console.log('sin seleccionar');
                            //TENDRÉ QUE AVISAR QUE SE REVISEN TODOS LOS ITEMS DEL GRUPO
                            console.log('mal asunto', x);
                            todoBienItems = 0;
                            return;
                        }
                    }

                } else {
                    console.log('mal asunto sin cheked', x);
                    todoBienItems = 0;
                }
            });
            console.log('todo bien items', todoBienItems);
            //Obtengo las dos imagenes, la de ejemplo y la real
            var imagenEjemplo = "";
            var imagenReal = "";
            if ($('#etiquetaEjemplo' + idGrupo).length) {
                imagenEjemplo = $('#etiquetaEjemplo' + idGrupo).attr('src');
                // console.log(imagenEjemplo);
                imagenReal = $('#etiquetaReal' + idGrupo).attr('src');
                // console.log(imagenReal);
            }
            //si hay imagen de ejemplo pero no real no se puede guardar.
            if (imagenEjemplo != "" && imagenReal == "") {
                console.log('no hay imagen real');
                todoBienImagen = 0;
            }
            console.log('todo bien imagenes', todoBienImagen);

            //RECOJO EL RESTO DE VALORES DE LA CABECERA
            // var idRegistro=0;
            if (idRegistro == 0) {
                <?php if (isset($data[0])) { ?> idRegistro = <?= $data[0]->ID;
                                                                } ?>;
            }
            var fecha = $('#fecha').val() + ' ' + $('#hora').val();
            var idUsuario = <?php echo session()->get('id') ?>;
            var idArticulo = $('#id_referencia').val();
            var idFormulario = $('#id_formulario').val();
            var idDelegacionLinea = $('#id_linea').val();
            var observaciones = $('#observaciones').val();
            var arrayFormularios = <?php echo json_encode($formularios); ?>;

            var caducidad = $('#caducidadValor').val();
            var lote = $('#loteValor').val();
            console.log('lote:', lote, $('#loteValor').val());
            var documento = $('#documentoValor').val();
            var entidad = $('#entidadValor').val();
            var idMotivo = $('#id_motivo').val();
            //TENGO QUE REVISAR QUE LOS VALORES DE LA CABECERA SE HAN RELLENADO SI EL FORMULARIO LO PIDE, ASI QUE OBTENGO EL FORMULARIO PARA COMPROBAR CADA CAMPO
            //BUSCO SOLO LOS FORMULARIOS POR SU ID Y ME QUEDO CON EL PRIMERO, PORQUE SOLO DEBERÍA HABER 1
            var formularios = $.grep(arrayFormularios, function(x) {
                return x.ID == idFormulario;
            });
            var formulario = formularios[0];
            if (formulario.Caducidad == "1") {
                if (caducidad == "") {
                    todoBien = 0;
                }
            }
            console.log('todo bien Caducidad', caducidad, todoBien);
            // if(formulario.Lote=="1"){
            //     if(lote==""){todoBien=0;}
            // }
            console.log('todo bien Lote', lote, todoBien);
            if (formulario.Documento == "1") {
                if (documento == "") {
                    todoBien = 0;
                }
            }
            console.log('todo bien Documento', documento, todoBien);
            if (formulario.Entidad == "1") {
                if (entidad == "") {
                    todoBien = 0;
                }
            }
            console.log('todo bien Entidad', entidad, todoBien);
            if (formulario.Motivo == "1") {
                if (idMotivo == "0") {
                    todoBien = 0;
                }
            }
            console.log('todo bien Motivo', todoBien);
            console.log('todo bien', idMotivo, todoBien);

            if (todoBien == 1 && todoBienItems == 1 && todoBienImagen == 1) {
                //CON  TODOS LOS ITEMS CHEKEADOS, CIERRO EL ARRAY DE ITEMS
                items = items.slice(0, -1);
                items += "]";
                console.log(items);

                //console.log(imagenEjemplo);
                var parametros = JSON.stringify({
                    idRegistro: idRegistro,
                    fecha: fecha,
                    idUsuario: idUsuario,
                    idArticulo: idArticulo,
                    idFormulario: idFormulario,
                    idDelegacionLinea: idDelegacionLinea,
                    idMotivo: idMotivo,
                    lote: lote,
                    caducidad: caducidad,
                    documento: documento,
                    entidad: entidad,
                    observaciones: observaciones,
                    idGrupo: idGrupo,
                    imagenEjemplo: imagenEjemplo,
                    imagenReal: imagenReal,
                    items: items
                });


                // $('document').css('cursor', 'wait');
                //paso como parametros al ajax en el JSON
                $.ajax({
                    data: {
                        'data': parametros
                    },
                    dataType: "json",
                    //data: formData,
                    url: '<?= base_url() ?>/ChequeoRecepcion/registrarchequeo',
                    type: 'post',
                    beforeSend: function() {
                        $(".alert").html(
                            "Procesando, por favor espere...");

                        if ($('.alert').hasClass('alert-success')) {
                            $('.alert').removeClass('alert-success');
                            $('.alert').addClass('alert-warning');
                        };
                        if ($('.alert').hasClass('alert-danger')) {
                            $('.alert').removeClass('alert-danger');
                            $('.alert').addClass('alert-warning');
                        };
                        $('.alert').show();
                        setInterval(function() {
                            $('.alert').hide();
                        }, 5000)
                    },
                    success: function(response) {

                        //alert('jaja');

                        //console.log(itemsGuardados);
                        if (response != false) {
                            console.log(response);
                            idRegistro = response.idRegistro;
                            var itemsCreados = JSON.stringify({
                                "IdRegistro": idRegistro,
                                "Grupo": idGrupo,
                                "ImagenReal": imagenReal,
                                "items": JSON.parse(items)
                            });
                            itemsCreados = JSON.parse(itemsCreados);
                            itemsGuardados.push(itemsCreados);

                            // $('.alertaOK').val('Se ha grabado el chequeo <strong>Correctamente!</strong>');


                            $(".alert").html(
                                " Chequeo registrado <strong>Correctamente!</strong>");
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

                            if ($('#heading' + idGrupo).hasClass('bg-white')) {

                                $('#heading' + idGrupo).removeClass('bg-white');
                                $('#heading' + idGrupo).addClass('bg-success');
                                $('#heading' + idGrupo + ' a').css("color", "white");
                            };
                            $('.collapse').collapse('hide');
                        } else {
                            $(".alert").html(
                                "Ocurrió un problema al registrar el chequeo.");
                            if ($('.alert').hasClass('alert-success')) {
                                $('.alert').removeClass('alert-success');
                                $('.alert').addClass('alert-danger');
                            };
                            if ($('.alert').hasClass('alert-warning')) {
                                $('.alert').removeClass('alert-warning');
                                $('.alert').addClass('alert-danger');
                            };
                        }

                    }
                });
                // $('document').css('cursor', 'default');
            } else {

                console.log('saco alerta');
                if (todoBienItems == 0) {
                    $(".alert").html("Debe marcar todos los items para poder guardar!");
                }
                if (todoBienImagen == 0) {
                    $(".alert").html("Falta la foto real para poder guardar!");
                }
                if (todoBien == 0) {
                    $(".alert").html("Debe rellenar los datos de la cabecera para poder guardar!");
                }
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
        }

    });

    $(document).on('change', '.custom-file-input', function(e) {
        // $('#imagenEtiqueta').on('change', function(e) {
        //get the file name
        //console.log(e.target.files[0]);
        // var fileName = e.target.files[0].name;
        //replace the "Choose a file" label
        // $(this).next('.custom-file-label').html(fileName);
        var idGrupo = $(this).data('id');

        console.log('cambio foto', idGrupo);

        var img = e.target.files[0];

        var reader = new FileReader();

        reader.onloadend = function() {
            // console.log(reader.result);
            if (reader.result) {
                $("#etiquetaReal" + idGrupo).attr("src", reader.result);

            } else {
                $("#etiquetaReal" + idGrupo).attr("src", '');

            }
        }
        reader.readAsDataURL(img);

    });

    $("#finalizarChequeo").on('click', function() {
        console.log('inicio finalizarChequeo');
        //PRIMERO TENEMOS QUE COMPROBAR QUE TODOS LOS GRUPOS ESTÁN CHEQUEADOS
        var todoBien = 1;
        //SACO TODOS LOS HEADER QUE ESTÁN EN BLANCO, SI NO HAY NINGUN ES QUE ESTÁN TODOS EN VERDE Y SE PUEDE FINALIZAR
        $(".card-header").filter(".bg-white").each(function(e, x) {
            //console.log(x);      
            todoBien = 0;
        });

        //03/05/2021- NO QUIEREN CONTROLAR QUE TODOS LO ELEMENTOS ESTÉN EN VERDE, PARA PODER FINALIZAR
        // if (todoBien == 1) {
        if (idRegistro == 0) {
            <?php if (isset($data[0])) { ?> idRegistro = <?= $data[0]->ID;
                                                            } ?>;
        }
        var arrayIdRegistros = [];
        $.each(itemsGuardados, function(indexGrupo, grupo) {
            if (arrayIdRegistros.indexOf(grupo.IdRegistro) == -1) {
                arrayIdRegistros.push(grupo.IdRegistro);
            }
        })
        if (arrayIdRegistros.length === 0) {
            arrayIdRegistros[0] = idRegistro;
        }

        var observaciones = $('#observaciones').val();
        console.log(arrayIdRegistros);
        //SI ESTÁ TODO CHEQUEADO, YA SOLO NOS QUEDA LLAMAR AL AJAX PARA MARCAR EL CHEQUEO COMO FINALIZADO
        var parametros = JSON.stringify({
            idRegistro: arrayIdRegistros,
            observaciones: observaciones,
        });
        finalizarChequeo(parametros);
        window.location.replace("<?= base_url() ?>/dashboard/chequeo");
        console.log('fin finalizarChequeo');
    });


    var idRegistro = 0;
    <?php if (isset($data[0]->ID)) { ?>
    console.log('hay data');
    idRegistro = <?= $data[0]->ID ?>;
    <?php } else { ?>
    console.log('no hay data');
    <?php } ?>


    // console.log($data[0]);


    if (idRegistro != 0) {
        //SE VA A EDITAR UN CHEQUEO, ASI QUE TENGO QUE CARGAR TODOS LOS DATOS DINAMICAMENTE.
        var arrayDatosChequeo = <?php echo json_encode($data); ?>;
        var parametros = JSON.stringify({
            idRegistro: idRegistro,
        });
        // console.log(idFormulario,idDelegacionLinea);
        $.ajax({
            data: {
                'data': parametros
            },
            dataType: "json",
            //data: formData,
            url: '<?= base_url() ?>/ChequeoRecepcion/obtenerDatosChequeo',
            type: 'post',
            beforeSend: function() {
                $(".alert").html("Cargando datos, espere por favor...");
                if ($('.alert').hasClass('alert-success')) {
                    $('.alert').removeClass('alert-success');
                    $('.alert').addClass('alert-danger');
                };
                if ($('.alert').hasClass('alert-warning')) {
                    $('.alert').removeClass('alert-warning');
                    $('.alert').addClass('alert-danger');
                };
                $('.alert').show();

            },
            success: function(response) {
                $('.alert').hide();
                editando = 1;
                console.log('respuesta datos edicion', response);
                //pongo los datos de la cabecera en cada apartado            
                CargarDatosCabecera(response[0]);
                //luego segun el tipo de formulario se muestran las casillas que estén definidas y se mostraran ya con los datos rellenados previamente.
                cargarCabecera();
                //console.log(response[1]);
                //ahora ya cargamos lo items dinamicamente por cada grupo, con sus valores si los tienen e imagenes
                CargarItemsEnPantalla(response[1]);
                console.log('fin carga edicion');
            }
        });

    }
    console.log('se acabo');

});

function finalizarChequeo(parametros){
    $.ajax({
            async:true,
            data: {
                'data': parametros
            },
            dataType: "json",
            //data: formData,
            url: '<?= base_url() ?>/ChequeoRecepcion/finalizarChequeo',
            type: 'post',
            
            beforeSend: function() {
                $(".alert").html("Finalizando chequeo y creando pdf, espere por favor...");
                if ($('.alert').hasClass('alert-success')) {
                    $('.alert').removeClass('alert-success');
                    $('.alert').addClass('alert-danger');
                };
                if ($('.alert').hasClass('alert-warning')) {
                    $('.alert').removeClass('alert-warning');
                    $('.alert').addClass('alert-danger');
                };
                $('.alert').show();
            },           
            

        });    
}

function MantenerDatos() {
    $.each(itemsGuardados, function(indexGrupo, grupo) {
        $.each(grupo.items, function(index, item) {
            if (item.VALOR == 1) {
                $("#ok" + item.ID).prop('checked', true);
                $("#ko" + item.ID).prop('checked', false);
                $("#ne" + item.ID).prop('checked', false);
                $("#ko" + item.ID).parents('label').removeClass(
                    'active');
                $("#ne" + item.ID).parents('label').removeClass(
                    'active');
                $("#ok" + item.ID).parents('label').addClass(
                    'active');
            } else if (item.VALOR == 0) {
                $("#ko" + item.ID).prop('checked', true);
                $("#ok" + item.ID).prop('checked', false);
                $("#ne" + item.ID).prop('checked', false);
                $("#ok" + item.ID).parents('label').removeClass(
                    'active');
                $("#ne" + item.ID).parents('label').removeClass(
                    'active');
                $("#ko" + item.ID).parents('label').addClass(
                    'active');
                $("#itemProblema" + item.ID).text(item.PROBLEMA);
                $("#itemSolucion" + item.ID).text(item.SOLUCION);
                $("#itemObservaciones" + item.ID).removeAttr('hidden');
            }

        })
        //console.log(grupo);
        $("#etiquetaReal" + grupo.Grupo).attr('src', grupo.ImagenReal)
        //key == "ImagenReal" ? $("#etiquetaReal" + grupo.Grupo).attr('src', grupo.ImagenReal) : "";
    })
}
</script>