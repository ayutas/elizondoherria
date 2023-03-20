<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.recibos'); ?></h1>
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
                                <!-- Campo Fecha -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="fecha"><?php echo lang('Translate.recibos'); ?></label>
                                    <input class="form-control fecha" id="fecha" name="fecha" type="date" value="<?= date('Y-m-d'); ?>">
                                </div>
                                <!-- Campo Referencia -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="referencia"><?php echo lang('Translate.referencia'); ?></label>
                                    <input class="form-control body-form-light" id="referencia" name="referencia" type="text" placeholder="<?php echo lang('Translate.introduzcaReferencia'); ?>" />
                                </div>                                
                                <!-- Campo Concepto -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="concepto"><?php echo lang('Translate.concepto'); ?></label>
                                    <input class="form-control body-form-light" id="concepto" name="concepto" type="text" placeholder="<?php echo lang('Translate.introduzcaConcepto'); ?>" />
                                </div>
                            </div>
                        </div>
                        <?php 
                            dataTableConsultas(lang('Translate.recibos'),$columns,$data,'recibos','','text-center','0,2',7,true,0,'datatableRecibos');
                        ?>

                        <!-- Errores de formulario -->
                        <?php if (isset($validation)){ ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="col-12 form-group mt-4 mb-0">
                            <button class="btn btn-primary btn-block" type="button" onclick="CrearRecibos()">
                                <?php echo lang('Translate.crear'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script>


function CrearRecibos()
{
    var referencia=$("#referencia").val();
    if(referencia=="")
    {
        alert('<?php echo lang('Translate.introduzcaReferencia'); ?>');
        return;
    }
    var concepto=$("#concepto").val();
    if(concepto=="")
    {
        alert('<?php echo lang('Translate.introduzcaConcepto'); ?>');
        return;
    }

    var table = $('#datatableRecibos').DataTable();
    var count = table.rows({
        selected: true
    }).count();
    var rows;
    if (count == 0) {
        //si no hay ninguna fila seleccionada, cojo todas
        rows = table.rows().data();
    } else {
        rows = table.rows({
            selected: true
        }).data();
    }

    var arrayIds = [];
    $.each(rows, function(key, value) {
        arrayIds.push(value.ID);
    });
    console.log(arrayIds);

    var fecha=$("#fecha").val();
    var concepto=$("#concepto").val();

    var parametros = JSON.stringify({
        fecha:fecha,
        ref:referencia,
        concepto:concepto,
        arrayIds:arrayIds,
    });

    $.ajax({
        data: {
            'data': parametros
        },
        dataType: "json",
        //data: formData,
        url: '<?= base_url() ?>/Recibos/CrearRecibos',
        type: 'post',
        beforeSend: function() {

        },
        success: function(response) {
            if (response[0]==true){
                window.open('<?= base_url() ?>/Recibos/DescargarXML/'+referencia,
                                "_blank");
                window.location.replace(response[1]);
            } else{
                alert(response[0]);
            }
        }

    });
}

</script>