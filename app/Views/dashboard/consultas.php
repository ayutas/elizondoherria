<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.consulta'); ?></h1>
                <div class="container-fluid">
                    <form action="" method="post">     
                        <div class="form-row mt-3">
                            <!-- Campo ref -->
                            <div class="form-group col-md-6">
                                <label class="medium mb-1" for="ref"><?php echo lang('Translate.referencia'); ?></label>
                                <input class="form-control py-2" id="ref" name="ref" type="text" value="" />
                            </div>                        
                            <!-- Campo concepto -->
                            <div class="form-group col-md-6">
                                <label class="medium mb-1" for="concepto"><?php echo lang('Translate.concepto'); ?></label>
                                <input class="form-control py-2" id="concepto" name="concepto" type="text" value="" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-6">
                                <label id=""><?php echo lang('Translate.fechaDesde'); ?></label>
                                <input class="form-control" type="date" name="fechaDesde" id="fechaDesde" value="<?= date("Y-m-d",strtotime("-1 year"));?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="" id=""><?php echo lang('Translate.fechaHasta'); ?></label>
                                <input class="form-control" type="date" name="fechaHasta" id="fechaHasta" value="<?= date('Y-m-d');?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-2">
                                <div class="form-check">
                                    <!-- <label class="" id=""><?php echo lang('Translate.cobrado'); ?></label> -->
                                    <input class="form-check-input" type="checkbox" value="" id="checkCobrado" checked>
                                    <label class="form-check-label" for="checkCobrado">
                                    <?php echo lang('Translate.cobrado'); ?>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkNoCobrado" checked>
                                    <label class="form-check-label" for="checkNoCobrado">
                                    <?php echo lang('Translate.noCobrado'); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div clas="row mt-4 mb-4">
                            <a id="buscar" class="btn btn-primary btn-lg btn-block mb-2" style="color:white;"><?php echo lang('Translate.buscar'); ?></a>
                        </div>

                        <div clas="row mt-4">
                            <?php // Miga de pan      
                                if(isset($data))
                                {                        
                                    dataTableConsultas(lang('Translate.recibos'),$columns,$data,'consultas','10','text-center', "0",true);
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
  <!-- Cargando datos, espere por favor... -->
</div>

<script>

    $("#buscar").on('click', function() {
        console.log('buscamos');
        //VAMOS RECOGIENDO TODOS LOS CAMPOS A FILTRAR
        var referencia=$('#ref').val();
        var concepto = $('#concepto').val();
        var fechaDesde=$('#fechaDesde').val();
        var fechaHasta=$('#fechaHasta').val();
        var cobrado= $('#checkCobrado').prop('checked');
        var noCobrado= $('#checkNoCobrado').prop('checked');
        var parametros = JSON.stringify({          
            referencia:referencia,
            concepto:concepto,                                 
            fechaDesde:fechaDesde,
            fechaHasta:fechaHasta,
            cobrado:cobrado,
            noCobrado:noCobrado
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

    function EditarRecibo(boton)
    {
        var linea = boton.parentElement.parentElement;
        var table = $("#dataTable").dataTable();
        var row = table.find("tr").eq(linea.rowIndex);
        var data = $("#dataTable").dataTable().fnGetData(row);
        
        var idRecibo=data.ID;
        
        if(idRecibo!=0){
            window.location.assign("<?= base_url() ?>/recibos/edit/"+idRecibo);
        }
    }

</script>