<?php
//Funcion para crear un datatable autamatizado
function dataTable($title,$columns,$data,$slug,$targets = 0,$targetClass = 'text-center',$ocultar="",$col = 12,$color = false,$colorCol = 0,$idTable='dataTable' )
{ ?>

<div class="card">
    <div class="card-header" style="color:white;">
        <i class="fas fa-table mr-1"></i>
        <?= $title ?>
    </div>
    <div class="card-body bg-white" style="color:black;">
        <!-- DEMO DATATABLE -->
        <div class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive table-striped">
            <table class="table table-bordered" style="color:black;border-color:#ced4d9;" id="<?=$idTable?>"
                width="100%" cellspacing="0">
                <thead>
                </thead>
                <tfoot>
                    </tbody>
            </table>
        </div>
    </div>
    <!-- FIN DEMO DATATABLE -->
</div>

<?php 
        $arrayData = [];
        $counter = 1;
        if($columns != NULL) {
            foreach($columns as $item){
                $last = sizeof($columns);
                switch($counter) {
                    case $last :      
                        array_push($arrayData,"{data:'".$item['Field']."',title:'".$item['Field']."'},");
                        array_push($arrayData,"{data:'btnEditar',title:''},");   
                        array_push($arrayData,"{data:'btnEliminar',title:''}");
                        break;
                    default:
                        array_push($arrayData,"{data:'".$item['Field']."',title:'".$item['Field']."'},");
                        $counter++;    
                }
    
        
            };
        } else {
            $arrayData = "";
        }
         
        //return var_dump($);
    ?>

<script>
// Generación de datatable
$(document).ready(function() {
    var table = $('#<?=$idTable?>').DataTable({
        data: <?php echo json_encode($data) ?>,
        columns: [
            <?php 
                if($arrayData != ""){
                    foreach ($arrayData as $item){
                        echo $item;
                    }
                } else {
                    $arrayData= "";
                }
                
                    ?>
        ],
        <?php if(isset($color) && $color != "") {
                    ?> "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            if (aData['Situaciones'] == 'Alta') {
                $(nRow).find('td:eq(1)').addClass('bg-warning');
                $(nRow).find('td:eq(2)').addClass('bg-warning');
            } else if (aData['Situaciones'] == "Cancelada") {
                $(nRow).find('td:eq(1)').addClass('bg-danger');
                $(nRow).find('td:eq(2)').addClass('bg-danger');
            } else if (aData['Situaciones'] == "Realizada") {
                $(nRow).find('td:eq(1)').addClass('bg-success');
                $(nRow).find('td:eq(2)').addClass('bg-success');
            }
        },
        <?php
                } ?> "columnDefs": [{
                targets: [<?= $targets ?>],
                className: '<?= $targetClass ?>'
            },
            {
                "targets": [<?= $ocultar?>],
                "visible": false,
                "searchable": true
            },
        ],
        "language": {
            url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });

    $("#<?=$idTable?> tbody").on('click', '#btnEliminar', function() {
        var response = prompt("Para eliminar el registro introduzca la contraseña 1234");
        if(response.toString() == "1234") {
            window.location.replace('<?= base_url(); ?>/<?= $slug ?>/delete/' + $(this).data('id'));
        }
    });
});
</script>
<?php
}

//Funcion para crear un datatable autamatizado
function dataTableConsultas($title, $columns, $data, $slug, $targets = 0, $targetClass = 'text-center', $ocultar = "", $color = false, $colorCol = 0, $col = 12, $idTable = 'dataTable')
{ ?>

<div class="card">
    <div class="card-header" style="color:white;">
        <i class="fas fa-table mr-1"></i>
        <?= $title ?>
    </div>
    <div class="card-body bg-white" style="color:black;">
        <!-- DEMO DATATABLE -->
        <div class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive">
            <table class="table table-bordered" style="color:black;border-color:#ced4d9;" id="<?= $idTable ?>"
                width="100%" cellspacing="0">
                <thead>
                </thead>
                <tfoot>
                    </tbody>
            </table>
        </div>
    </div>
    <!-- FIN DEMO DATATABLE -->
</div>

<?php
    $arrayData = [];
    $counter = 1;
    if($columns != NULL) {
        foreach($columns as $item){
            $last = sizeof($columns);
            switch($counter) {
                case $last :      
                    array_push($arrayData,"{data:'".$item['Field']."',title:'".$item['Field']."'},");
                    // array_push($arrayData,"{data:'btnEditar',title:''},");   
                    // array_push($arrayData,"{data:'btnEliminar',title:''}");
                    break;
                default:
                    array_push($arrayData,"{data:'".$item['Field']."',title:'".$item['Field']."'},");
                    $counter++;    
            }

    
        };
    } else {
        $arrayData = "";
    }
    //return var_dump($);
    ?>

<script>
// Generación de datatable
$(document).ready(function() {
    var table = $('#<?= $idTable ?>').DataTable({
        data: <?php echo json_encode($data) ?>,
        // dom: 'Bfrtip',
        select: {
            style: 'multi',
            selector: 'td:nth-child(1)'
        },
        order: [
            [1, 'asc']
        ],
        buttons: [
            // {
            //     text: "Revisado",
            //     action: function(e, dt, node, config) {
            //         var count = table.rows({
            //             selected: true
            //         }).count();
            //         var rows;
            //         if (count == 0) {
            //             //si no hay ninguna fila seleccionada, cojo todas
            //             rows = table.rows().data();
            //         } else {
            //             rows = table.rows({
            //                 selected: true
            //             }).data();
            //         }

            //         var arrayIds = [];
            //         $.each(rows, function(key, value) {
            //             arrayIds.push(value.ID);
            //         });
            //         console.log(arrayIds);
            //         $.ajax({
            //             data: {
            //                 'data': arrayIds
            //             },
            //             dataType: "json",
            //             //data: formData,
            //             url: '<?= base_url() ?>/Consultas/MarcarRevisados',
            //             type: 'post',
            //             beforeSend: function() {

            //             },
            //             success: function(response) {
            //                 window.location.replace(
            //                     "<?= base_url() ?>/Consultas/show");
            //             }

            //         });
            //     }
            // },
            {
                extend: 'excelHtml5',
                text: "Excel",
                title: "<?= $title . " - " . date('d/m/Y'); ?>",
                autoFilter: true,
                //messageTop: 'La información de la tabla tiene Copyright de Elaborados Naturales.',            
                exportOptions: {
                    columns: 'th:not(.noImprimir)'
                }
            },
            {
                text: "PDF",
                action: function(e, dt, node, config) {
                    console.log('generar PDF');
                    var count = table.rows({
                        selected: true
                    }).count();

                    var rows;
                    if (count == 0) {
                        //si no hay ninguna fila seleccionada, cojo todas
                        rows = table.rows().data();

                    } else {
                        rows = table.rows({
                            selected: true
                        }).data();
                    }
                    count = rows.count();
                    console.log(count);
                    var contador = 0;
                    var arrayIds = [];
                    var idRegistro=0;
                    $.each(rows, function(key, value) {
                        if (idRegistro!=value.ID)
                        {
                            contador++;
                            arrayIds.push(value.ID);
                            idRegistro=value.ID;
                        }
                        //if (contador == 15) {
                        //    console.log(arrayIds);
                        //    window.open('<?= base_url() ?>/Consultas/UnirPdfs?data=' +
                        //        arrayIds, "_blank");
                        //    contador = 0;
                        //    arrayIds = [];
                        //}

                    });
                    //if (contador > 0) {
                        console.log(arrayIds);
                        window.open('<?= base_url() ?>/Consultas/UnirPdfs?data=' + arrayIds,
                            "_blank");
                    //}

                }
            },
            {
                extend: 'print',
                text: "Imprimir",
                title: "<?= $title . " - " . date('d/m/Y'); ?>",
                messageBottom: null,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: "Columnas Visibles"
            }
        ],
        columns: [
            <?php
                    if ($arrayData != "") {
                        foreach ($arrayData as $item) {
                            echo $item;
                        }
                    } else {
                        $arrayData = "";
                    }

                    ?>
        ],
        <?php if (isset($color) && $color != "") {
                ?> "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            if (aData['SITUACION'] == 1) {
                $(nRow).addClass('bg-warning');
                $(nRow).find('td:eq(1)').removeClass('bg-warning');
                // $(nRow).find('td:eq(2)').addClass('bg-warning');
            } else if (aData['SITUACION'] == 0) {
                $(nRow).addClass('bg-danger');
            } else if (aData['SITUACION'] == 2) {
                $(nRow).addClass('bg-success');
            }
        },
        <?php
                } ?> "columnDefs": [{
                orderable: false,
                className: 'select-checkbox',
                targets: 1
            },
            {
                targets: [<?= $targets ?>],
                className: '<?= $targetClass ?>'
            },
            {
                "targets": [<?= $ocultar ?>],
                "visible": false,
                "searchable": true
            }
        ],

        "language": {
            url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
    });

    $("#<?= $idTable ?> tbody").on('click', '#btnEliminar', function() {
        var result = confirm("¿Desea eliminar el registro?");
        if (result) {
            window.location.replace('/<?= $slug ?>/delete/' + $(this).data('id'));
        }
    });
    $("table.dataTable").css('min-width', 'max-content');
});
</script>
<?php
}

function dataTablePersonalizadaSeleccion($columns,$data,$slug,$targets = 0,$targetClass = 'text-center',$ocultar="", $totalRegistros=0,  $col = 12,$color = false,$colorCol = 0,$idTable='dataTable',$incluirBotonSeleccionar = false, $idColumnaPonerColor = 0, $metodo = "" )
{ ?>

<div class="card">
    <div class="card-body bg-white">
        <!-- DEMO DATATABLE -->
        <div class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive table-striped datatableSeleccion">
            <table class="table table" style="color:black;border-color:#ced4d9;" id="<?=$idTable?>"
                width="100%" cellspacing="0">
                <thead>
                </thead>
                <tfoot>
                </tfoot>
                    </tbody>
            </table>
        </div>
    </div>
    <!-- FIN DEMO DATATABLE -->
</div>

<?php 
        $arrayData = [];
        $counter = 1;
        if($columns != NULL) {
            foreach($columns as $item){
                $last = sizeof($columns);
                switch($counter) {
                    case $last :
                         if($incluirBotonSeleccionar)  array_push($arrayData,"{data:'btnSeleccionar',title:''},");       
                        array_push($arrayData,"{data:'".$item['Field']."',title:'".$item['Field']."'},");
                        break;
                    default:
                        array_push($arrayData,"{data:'".$item['Field']."',title:'".$item['Field']."'},");
                        $counter++;    
                }
    
        
            };
        } else {
            $arrayData = "";
        }
         
        //return var_dump($);
    ?>

<script>
// Generación de datatable
$(document).ready(function() {
    var table = $('#<?=$idTable?>').DataTable({
        "pagingType": "simple",
        "dom": '<"toolbarSeleccion"><"#input-Botones-Datatable"B><"#input-filter-Datatable"f>t<"#input-length-Datatable"l><"#input-pagination-Datatable"p><"#input-information-Datatable"i>',
        buttons: 
        [{
            extend: 'collection',
            className: "exportar",
            text: 'Exportar tabla',
            buttons:
            [{
            extend: "pdf", className: "exportar"
            }],
        }],

        
        data: <?php echo json_encode($data) ?>,
        columns: [
            <?php 
                if($arrayData != ""){
                    foreach ($arrayData as $item){
                        echo $item;
                    }
                } else {
                    $arrayData= "";
                }
                
                    ?>
        ],
        <?php if(isset($color) && $color != "") {
                    ?> "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $(nRow).find('td:eq(<?=$idColumnaPonerColor?>)').css({"color":"#0f5198"});
        },
        <?php
                } ?> "columnDefs": [{
                targets: [<?= $targets ?>],
                className: '<?= $targetClass ?>'
            },
            {
                "targets": 0,
                "searchable": false,
                "defaultContent": "<button onclick='<?= $metodo ?>' class='btn btn-success btn-sm'><i class='fa fa-plus'></i></button>",
            },
            {
                "targets": [<?= $ocultar?>],
                "visible": false,
                "searchable": true,
            },
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Líneas por página _MENU_",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "_START_-_END_ de _TOTAL_ items",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "<span class'lupa'><i class='fa fa-search'></i></span>",
            "searchPlaceholder": "Buscar",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "<span class='datatableSeleccion arrow'>></span>",
                "sPrevious": "<span class='datatableSeleccion arrow'><</span>"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        
    });

    
    table.button(0).nodes().css('background', 'white');
    $("div.toolbarSeleccion").html('<h1 style="float:left; margin-top:-5px;" class="titleGruposFormularios"><?= $totalRegistros?></h1>');

}



);
</script>
<?php
}

function dataTablePersonalizadaConCheck($columns,$data,$slug,$targets = 0,$targetClass = 'text-center',$ocultar="", $totalRegistros=0,  $col = 12,$color = false,$colorCol = 0,$idTable='dataTable',$incluirBotonSeleccionar = false, $idColumnaPonerColor = 0 )
{ ?>

<div class="card">
    <div class="card-body bg-white">
        <!-- DEMO DATATABLE -->
        <div class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive table-striped datatableSeleccion">
            <table class="table table" style="color:black;border-color:#ced4d9;" id="<?=$idTable?>"
                width="100%" cellspacing="0">
                <thead>
                </thead>
                <tfoot>
                </tfoot>
                    </tbody>
            </table>
        </div>
    </div>
    <!-- FIN DEMO DATATABLE -->
</div>

<?php 
    $arrayData = [];
    $counter = 1;
    if($columns != NULL) {
        foreach($columns as $item){
            $last = sizeof($columns);
            switch($counter) {
                case $last :      
                    array_push($arrayData,"{data:'".$item['Field']."',title:'".$item['Field']."'},");
                    // array_push($arrayData,"{data:'btnEditar',title:''},");   
                    // array_push($arrayData,"{data:'btnEliminar',title:''}");
                    break;
                default:
                    array_push($arrayData,"{data:'".$item['Field']."',title:'".$item['Field']."'},");
                    $counter++;    
            }

    
        };
    } else {
        $arrayData = "";
    }
         
        //return var_dump($);
    ?>

<script>
// Generación de datatable
$(document).ready(function() {
    var table = $('#<?=$idTable?>').DataTable({
        "order": [[1, 'asc']],
        "pagingType": "simple",
        "dom": '<"toolbar"><"#input-Botones-Datatable"B><"#input-filter-Datatable"f>t<"#input-length-Datatable"l><"#input-pagination-Datatable"p><"#input-information-Datatable"i>',
        buttons: 
        [{
            extend: 'collection',
            className: "exportar",
            text: 'Exportar tabla',
            buttons:
            [{
            extend: "pdf", className: "exportar"
            }],
        }],

        
        data: <?php echo json_encode($data) ?>,
        columns: [
            <?php 
                if($arrayData != ""){
                    foreach ($arrayData as $item){
                        echo $item;
                    }
                } else {
                    $arrayData= "";
                }
                
                    ?>
        ],
        <?php if(isset($color) && $color != "") {
                    ?> "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            $(nRow).find('td:eq(<?=$idColumnaPonerColor?>)').css({"color":"#0f5198"});
        },
        <?php
                } ?> "columnDefs": [{
                targets: [<?= $targets ?>],
                className: '<?= $targetClass ?>'
            },
            
            {
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    alert
                return '<input type="checkbox" onclick="ClickEnCheckIndividual(this)">';
            }
            },

            {
                "targets": [<?= $ocultar?>],
                "visible": false,
                "searchable": false
            },
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Líneas por página _MENU_",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "_START_-_END_ de _TOTAL_ items",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "<span class'lupa'><i class='fa fa-search'></i></span>",
            "searchPlaceholder": "Buscar",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "<span class='datatableSeleccion arrow'>></span>",
                "sPrevious": "<span class='datatableSeleccion arrow'><</span>"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        
    });

    
    table.button(0).nodes().css('background', 'white');
    $("div.toolbar").html('<h1 style="float:left; margin-top:-5px;" class="titleGruposFormularios"><?= $totalRegistros?></h1>');

}



);
</script>
<?php
}

