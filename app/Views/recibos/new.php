<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Recibos</h1>
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
                                    <label class="medium mb-1" for="fecha">Fecha</label>
                                    <input class="form-control fecha" id="fecha" name="fecha" type="date" value="<?= date('Y-m-d'); ?>">
                                </div>
                                <!-- Campo Referencia -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="referencia">Referencia</label>
                                    <input class="form-control body-form-light" id="referencia" name="referencia" type="text" placeholder="Referencia" />
                                </div>                                
                                <!-- Campo Concepto -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="concepto">Concepto</label>
                                    <input class="form-control body-form-light" id="concepto" name="concepto" type="text" placeholder="Concepto" />
                                </div>
                            </div>
                        </div>
                        <?php 
                            dataTableConsultas('Recibos',$columns,$data,'recibos','','text-center','0,2',7,true,0,'datatableRecibos');
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
                                Crear                            
                            </button>
                            <button class="btn btn-primary btn-block" type="button" onclick="CrearXmlRecibos()">
                                Crear   XML                         
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
    console.log(fecha);
    var referencia=$("#referencia").val();    
    console.log(referencia);
    var concepto=$("#concepto").val();
    console.log(concepto);    

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
            window.open('<?= base_url() ?>/Recibos/DescargarXML',
                            "_blank");            
        }

    });
}

function CrearXmlRecibos()
{


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
    console.log(fecha);
    var referencia=$("#referencia").val();    
    console.log(referencia);
    var concepto=$("#concepto").val();
    console.log(concepto);    



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
        url: '<?= base_url() ?>/Recibos/crearRecibosXML',
        async:false,
        type: 'post',
        beforeSend: function() {

        },
        success: function(response) {
            console.log(response);
            window.open('<?= base_url() ?>/Recibos/DescargarXML',
                            "_blank");
                            
        }

    });
}

</script>