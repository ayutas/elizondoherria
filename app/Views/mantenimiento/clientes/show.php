<?= // Miga de pan 
helper('html');
?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1><?php echo lang('Translate.clientes'); ?></h1>
                <div clas="row">
                    <div class="container mt-4">
                        <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                        <?php endif;
                        if (session()->get('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->get('error') ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <form action="<?php echo $action ?>" method="get">
                        <button type="submit" class="btn btn-primary mb-2 ml-2"><?php echo lang('Translate.newcliente'); ?></button>
                    </form>

                    <?php
                    dataTable(lang('Translate.clientes'), $columnsclientes, $dataclientes, 'Clientes', '5,6', 'text-center', "0", 4, false, 0, 'tablaClientes');
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>
<script>

</script>