    <?= // Miga de pan 
    helper('html');
    ?>
<div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <!-- titulo -->
                    <h1><?php echo lang('Translate.articulos'); ?></h1>
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
                        </div>
                    
                        <form  action="<?php echo $action ?>" method="get">
                            <button type="submit" class="btn btn-primary mb-2 ml-2" ><?php echo lang('Translate.newarticulo'); ?></button>                                                        
                        </form>
                        

                        <?php // Miga de pan
                        
                        dataTable(lang('Translate.articulos'),$columns,$data, 'articulos','6,7','text-center',"0"); 
                        
                        ?>          
                    </div>
                </div>
            </div>
        </main>
    </div>
