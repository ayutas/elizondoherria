<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Crear XML Recibos</h1>
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
                            <div class="col-md-12">
                                <!-- Campo Referencia -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="referencia">Referencia</label>
                                    <input class="form-control body-form-light" id="referencia" name="referencia" type="text" placeholder="Referencia" />
                                </div>                                
                                <!-- Campo Concepto -->
                                <div class="form-group">
                                <button class="btn btn-primary btn-block" type="button" onclick="CrearXmlRecibos()">Crear XML                         
                            </button>
                                </div>
                            </div>
                        </div>
                        <?php 
                            // dataTableConsultas('Recibos seleccionados',$columns,$data,'recibos','','text-center','0,2',7,true,0,'datatableRecibos');
                        ?>

                        <!-- Errores de formulario -->
                        <?php if (isset($validation)){ ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script>

function CrearXmlRecibos()
{

    var referencia=$("#referencia").val();    
    console.log(referencia);

    var parametros = JSON.stringify({
        ref:referencia,
    });
    console.log('llamo');

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
            console.log('descargo');
            console.log(response);
            window.open('<?= base_url() ?>/Recibos/DescargarXML',
                            "_blank");
        }

    });
}

</script>