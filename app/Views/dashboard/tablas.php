<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Mantenimiento tablas</h1>              
                <div class="row col-12">
                    <div class="col-3"><a class="btn btn-primary tablasbtn" href="<?= base_url()?>/clientes">Clientes</a></div>                    
                    <div class="col-3"><a href="<?= base_url()?>/articulos" class="btn btn-primary tablasbtn">Artículos</a></div>
                    <div class="col-3"><a href="<?= base_url()?>/categorias" class="btn btn-primary tablasbtn">Categorías</a></div>
                    <div class="col-3"><a class="btn btn-primary tablasbtn" href="<?= base_url()?>/usuarios">Usuarios</a></div>
                </div>
                <div class="row col-12 mt-4">
                    <!-- <div class="col-4"><a href="<?= base_url()?>/bancos" class="btn btn-primary tablasbtn">Bancos</a></div>                     -->
                    <!-- <div class="col-4"><a class="btn btn-primary tablasbtn" href="<?= base_url()?>/usuarios">Usuarios</a></div> -->
                    <!-- <div class="col-4"><a href="<?= base_url()?>/formularios" class="btn btn-primary tablasbtn">Recibos</a></div> -->
                </div>
            </div>
        </div>
    </main>
</div>