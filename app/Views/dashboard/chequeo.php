<?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <!-- titulo -->
                <h1>Chequeo</h1>
                <div class="row justify-content-center">
                    <?php // Miga de pan      
                        if(isset($data))
                        {                        
                            dataTable("Ultimos Chequeos",$columns,$data,'chequeos','9','text-center',"0,8,10");                         
                        }
                    ?>   
                </div>
                <div class="row justify-content-center mt-2">
                        <a href="<?= base_url()?>/chequeoRecepcion" class="btn btn-primary tablasbtn">Nuevo<br>Chequeo</a>
                </div>
            </div>
        </div>
    </main>
</div>