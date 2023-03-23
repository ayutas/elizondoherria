<?= 
    helper('html');
    ?>
<div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <!-- titulo -->
                    <h1><?php echo lang('Translate.recibo'); ?></h1>
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
                                <!-- Campo numero -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="numero"><?php echo lang('Translate.numero'); ?></label>
                                    <input class="form-control py-2" id="numero" name="numero" type="text" disabled
                                        value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Numero;
                                        }  
                                        else{
                                            echo set_value('numero');
                                        }
                                        ?>" />
                                </div>
                            </div>                            
                            <div class="col-md-4">                        
                                <!-- Campo fecha -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="fecha"><?php echo lang('Translate.fecha'); ?></label>
                                    <input class="form-control py-2" id="fecha" name="fecha" type="text" disabled
                                        value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Fecha;
                                        }  
                                        else{
                                            echo set_value('fecha');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo ref -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="ref"><?php echo lang('Translate.referencia'); ?></label>
                                    <input class="form-control py-2" id="ref" name="ref" type="text" disabled
                                        value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Referencia;
                                        }  
                                        else{
                                            echo set_value('ref');
                                        }
                                        ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">                        
                                <!-- Campo concepto -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="concepto"><?php echo lang('Translate.concepto'); ?></label>
                                    <input class="form-control py-2" id="concepto" name="concepto" type="text" disabled
                                        value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Concepto;
                                        }  
                                        else{
                                            echo set_value('concepto');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo cliente -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="cliente"><?php echo lang('Translate.cliente'); ?></label>
                                    <input class="form-control py-2" id="cliente" name="cliente" type="text" disabled
                                        value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Cliente;
                                        }  
                                        else{
                                            echo set_value('cliente');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo dni -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="dni"><?php echo lang('Translate.dni'); ?></label>
                                    <input class="form-control py-2" id="dni" name="dni" type="text" disabled
                                        value="<?php if(isset($data[0]))
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
                                <!-- Campo Contacto -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="contacto"><?php echo lang('Translate.contacto'); ?></label>
                                    <input class="form-control py-2" id="contacto" name="contacto" type="text" disabled
                                        value="<?php if(isset($data[0]))
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
                                    <input class="form-control py-2" id="telefono" name="telefono" type="text" disabled
                                        value="<?php if(isset($data[0]))
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
                                    <input class="form-control py-2" id="email" name="email" type="text" disabled
                                        value="<?php if(isset($data[0]))
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
                            <div class="col-md-8">
                                <!-- Campo Cuenta -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="cuenta"><?php echo lang('Translate.cuenta'); ?></label>
                                    <input class="form-control py-2" id="cuenta" name="cuenta" type="text" disabled
                                        value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Cuenta;
                                        }  
                                        else{
                                            echo set_value('cuenta');
                                        }
                                        ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Campo importe -->
                                <div class="form-group">
                                    <label class="medium mb-1" for="importe"><?php echo lang('Translate.importe'); ?></label>
                                    <input class="form-control py-2" id="importe" name="importe" type="text" disabled
                                        value="<?php if(isset($data[0]))
                                        {
                                            echo $data[0]->Importe;
                                        }  
                                        else{
                                            echo set_value('importe');
                                        }
                                        ?>" />
                                </div>
                            </div>                        
                        </div>                        
                        <div id="tablaLineasRecibo">
                            <table class="table table-responsive-sm table-sm mt-4"
                                style="color:black;">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('Translate.linea'); ?></th>
                                        <th><?php echo lang('Translate.descripcion'); ?></th>
                                        <th><?php echo lang('Translate.categoria'); ?></th>
                                        <th><?php echo lang('Translate.precio'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="lineasRecibo">
                                    <?php if (isset($lineasRecibo) && $lineasRecibo != null) {
                                        foreach ($lineasRecibo as $linea) { ?>
                                    <tr>
                                        <td><?= $linea->Linea ?></td>
                                        <td><?= $linea->Descripcion ?></td>
                                        <td><?= $linea->Categoria ?></td>
                                        <td><?= $linea->Precio ?></td>
                                    </tr>
                                    <?php }
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkCobrado"
                            <?php if(isset($data[0])){
                                    if ($data[0]->Cobrado){?>
                                        checked
                                <?php }  
                                }?>
                            >
                            <label class="form-check-label" for="flexCheckDefault">
                            <?php echo lang('Translate.cobrado'); ?>
                            </label>
                        </div>
                    </form>
                    <!-- Errores de formulario -->
                    <?php if (isset($validation)){ ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="col-12 form-group mt-4 mb-0">
                        <button class="btn btn-primary btn-block" type="button" onclick="GuardarRecibo()" id="btnGuardarRecibo" disabled><?php echo lang('Translate.guardar'); ?></button>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>

var idRecibo =0;

$( document ).ready(function() {
    <?php if (isset($data[0])){?> 
        var data=<?php echo json_encode($data[0]); ?>;
        idRecibo=data.ID;
        cobrado=data.Cobrado
    <?php }?>

});

$("#checkCobrado").change(function() {
    $("#btnGuardarRecibo").prop('disabled', false);
});

function GuardarRecibo()
{
    var continuar=false;
    var cobrado= $('#checkCobrado').prop('checked');
    if(cobrado){
        continuar=confirm('<?php echo lang('Translate.modificarReciboCobrado'); ?>');
    }else{
        continuar=confirm('<?php echo lang('Translate.modificarReciboNoCobrado'); ?>');
    }
    
    console.log('cobrado: '+cobrado);
    if (continuar){
        var parametros = JSON.stringify({
            id:idRecibo,
            cobrado:cobrado,
        });
        $.ajax({
            data: {
                'data': parametros
            },
            dataType: "json",
            //data: formData,
            url: '<?= base_url() ?>/recibos/guardarRecibo',
            type: 'post',
            beforeSend: function() {
                $("#resultado").html("<?php echo lang('Translate.procesando'); ?>");
            },
            success: function(response) {            
            }
        });
    }
}



</script>