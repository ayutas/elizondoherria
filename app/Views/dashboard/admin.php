<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.panel'); ?></h1>
                <div class="row col-12">
                    <div class="col-md-4"><a class="btn btn-primary tablasbtn mt-4" href="<?= base_url()?>/recibos"><?php echo lang('Translate.recibos'); ?></a></div>
                    <div class="col-md-4"><a class="btn btn-primary tablasbtn mt-4" href="<?= base_url()?>/clientes"><?php echo lang('Translate.clientes'); ?></a></div>
                    <div class="col-md-4"><a href="<?= base_url()?>/articulos" class="btn btn-primary tablasbtn mt-4"><?php echo lang('Translate.articulos'); ?></a></div>
                    
                </div>

                <div class="row col-md-12 mt-4">
                    <div class="col-md-4"><a href="<?= base_url()?>/categorias" class="btn btn-primary tablasbtn mt-4"><?php echo lang('Translate.categorias'); ?></a></div>
                    <div class="col-md-4"><a href="<?= base_url()?>/zonas" class="btn btn-primary tablasbtn mt-4"><?php echo lang('Translate.zonas'); ?></a></div>
                </div>
                <?php if($admin==1){ ?>
                    <div class="row col-md-12 mt-4">
                        <div class="col-md-4"><a class="btn btn-primary tablasbtn mt-4" href="<?= base_url()?>/usuarios"><?php echo lang('Translate.usuarios'); ?></a></div>
                        <div class="col-md-4"><a class="btn btn-primary tablasbtn mt-4" href="<?= base_url()?>/secciones"><?php echo lang('Translate.secciones'); ?></a></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
</div>

