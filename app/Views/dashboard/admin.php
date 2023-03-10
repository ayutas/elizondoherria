<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.panel'); ?></h1>
                <div class="row col-12 mt-4">
                    <div class="col-6"><a href="<?= base_url()?>/recibos" class="btn btn-primary tablasbtn"><?php echo lang('Translate.RECIBOS'); ?></a></div>
                    <!-- <div class="col-4"><a href="<?= base_url()?>/consultas" class="btn btn-primary tablasbtn">CONSULTAS</a></div> -->
                    <div class="col-6"><a href="<?= base_url()?>/tablas" class="btn btn-primary tablasbtn"><?php echo lang('Translate.TABLAS'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

