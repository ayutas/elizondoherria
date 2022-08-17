<?= // Miga de pan 
helper('html');
?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Clientes</h1>
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
                        <button type="submit" class="btn btn-primary mb-2 ml-2">Nuevo Cliente</button>
                    </form>

                    <?php
                    dataTable("Clientes", $columnsclientes, $dataclientes, 'Clientes', '4,5', 'text-center', "0", 4, false, 0, 'tablaClientes');
                    ?>
                </div>
                <!-- <div clas="row">
                    <form action="<?php echo $action ?>" method="get">
                        <a href="<?= base_url() ?>/delegacionesLineas/new" class="btn btn-primary mb-2 ml-2">Nueva
                            Línea</a>
                    </form>

                    <?php
                    // dataTable("Lineas delegación", $columnsLineas, $dataLineas, 'DelegacionesLineas', '4,5', 'text-center', "0", 6, false, 0, 'tablaLineasDelegaciones');
                    ?>
                </div> -->
                <div>
                </div>
    </main>
</div>
<script>

</script>