<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.mantenimiento'); ?></h1>              
                <div class="row col-12">
                    <div class="col-4"><a class="btn btn-primary tablasbtn" href="<?= base_url()?>/clientes"><?php echo lang('Translate.clientes'); ?></a></div>
                    <div class="col-4"><a href="<?= base_url()?>/articulos" class="btn btn-primary tablasbtn"><?php echo lang('Translate.articulos'); ?></a></div>
                    <div class="col-4"><a href="<?= base_url()?>/categorias" class="btn btn-primary tablasbtn"><?php echo lang('Translate.categorias'); ?></a></div>
                </div>

                <div class="row col-12 mt-4">
                    <div class="col-4"><a href="<?= base_url()?>/zonas" class="btn btn-primary tablasbtn"><?php echo lang('Translate.zonas'); ?></a></div>
                    <?php if($admin==1){ ?>
                        <div class="col-4"><a class="btn btn-primary tablasbtn" href="<?= base_url()?>/usuarios"><?php echo lang('Translate.usuarios'); ?></a></div>
                        <div class="col-4"><a class="btn btn-primary tablasbtn" href="<?= base_url()?>/secciones"><?php echo lang('Translate.secciones'); ?></a></div>
                        <!-- <div class="col-4"><a href="<?= base_url()?>/bancos" class="btn btn-primary tablasbtn">Bancos</a></div>                     -->
                        <!-- <div class="col-4"><a class="btn btn-primary tablasbtn" href="<?= base_url()?>/usuarios">Usuarios</a></div> -->
                        <!-- <div class="col-4"><a href="<?= base_url()?>/formularios" class="btn btn-primary tablasbtn">Recibos</a></div> -->
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
</div>