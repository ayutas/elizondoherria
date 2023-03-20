<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.recibos'); ?></h1>
                <div class="row col-12 mt-4">
                    <div class="col-6"><a href="<?= base_url()?>/newrecibos" class="btn btn-primary tablasbtn"><?php echo lang('Translate.crearRecibos'); ?></a></div>
                    <div class="col-6"><a href="<?= base_url()?>/consultas" class="btn btn-primary tablasbtn"><?php echo lang('Translate.consultas'); ?></a></div>
                </div>
            </div>
        </div>
    </main>
</div>

