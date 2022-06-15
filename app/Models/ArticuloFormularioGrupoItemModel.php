<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloFormularioGrupoItemModel extends Model
{
    protected $table = 'tbl_articulos_formularios_grupos_items';
    protected $primaryKey = 'ID';
    protected $allowedFields = [            
        'ID_ARTICULO',
        'ID_FORMULARIO_GRUPO_ITEM'
    ];


    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TAFGI.ID AS 'ID',
                        TAFGI.ID_ARTICULO As 'IdArticulo',
                        TAFGI.ID_FORMULARIO_GRUPO_ITEM AS 'IdFormGrupItem',
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción',
                        TFGI.ID_FORMULARIO AS 'IdFormulario',
                        TFGI.ID_GRUPO AS 'IdGrupo',
                        TFGI.ID_ITEM AS 'IdItem',                        
                        TFGI.ORDEN AS 'Orden',
                        TF.NOMBRE AS 'NombreFormulario',
                        TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        TF.CAPTURA_LOTE AS 'Captura lote',
                        TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                        TG.NOMBRE AS 'NombreGrupo',
                        TG.CAPTURA_IMAGEN AS 'CapturaImagen',
                        TI.NOMBRE AS 'NombreItem',
                        TAG.IMAGEN_ETIQUETA AS 'EjemploEtiqueta'
                FROM tbl_articulos_formularios_grupos_items TAFGI                    
                    INNER JOIN tbl_articulos TA ON TAFGI.ID_ARTICULO=TA.ID
                    INNER JOIN tbl_formularios_grupos_items TFGI ON TAFGI.ID_FORMULARIO_GRUPO_ITEM =TFGI.ID
                    INNER JOIN tbl_formularios TF ON TFGI.ID_FORMULARIO=TF.ID
                    INNER JOIN tbl_grupos TG ON TFGI.ID_GRUPO=TG.ID
                    INNER JOIN tbl_items TI ON TFGI.ID_ITEM=TI.ID
                    LEFT JOIN tbl_articulos_grupos TAG ON TAFGI.ID_ARTICULO=TAG.ID_ARTICULO AND TG.ID=TAG.ID_GRUPO
                    ORDER BY TFGI.ID_FORMULARIO,TAFGI.ID_ARTICULO,TFGI.ID_GRUPO,TFGI.ORDEN";   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
     
    public function getByArticulo($IdArticulo){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TAFGI.ID AS 'ID',
                        TAFGI.ID_ARTICULO As 'IdArticulo',
                        TAFGI.ID_FORMULARIO_GRUPO_ITEM AS 'IdFormularioGrupoItem',
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción',
                        TFGI.ID_FORMULARIO AS 'IdFormulario',
                        TFGI.ID_GRUPO AS 'IdGrupo',
                        TFGI.ID_ITEM AS 'IdItem',                        
                        TFGI.ORDEN AS 'Orden',                        
                        TF.NOMBRE AS 'NombreFormulario',
                        TF.CAPTURA_ARTICULO AS 'CapturaArticulo',
                        TF.CAPTURA_CADUCIDAD AS 'CapturaCaducidad',
                        TF.CAPTURA_DOCUMENTO AS 'CapturaDocumento',
                        TF.CAPTURA_ENTIDAD AS 'CapturaEntidad',
                        TF.CAPTURA_LOTE AS 'CapturaLote',
                        TF.CAPTURA_MOTIVO_CHEQUEO AS 'CapturaMotivo',
                        TG.NOMBRE AS 'NombreGrupo',
                        TG.CAPTURA_IMAGEN AS 'CapturaImagen',
                        TI.NOMBRE AS 'NombreItem',
                        false AS 'redirect'
                FROM tbl_articulos_formularios_grupos_items TAFGI                    
                    LEFT JOIN tbl_articulos TA ON TAFGI.ID_ARTICULO=TA.ID
                    LEFT JOIN tbl_formularios_grupos_items TFGI ON TAFGI.ID_FORMULARIO_GRUPO_ITEM =TFGI.ID
                    LEFT JOIN tbl_formularios TF ON TFGI.ID_FORMULARIO=TF.ID
                    LEFT JOIN tbl_grupos TG ON TFGI.ID_GRUPO=TG.ID
                    LEFT JOIN tbl_items TI ON TFGI.ID_ITEM=TI.ID
                    WHERE TAFGI.ID_ARTICULO=$IdArticulo";   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function deleteByArticuloFormulario($idArticulo,$idFormulario){
        $db = \Config\Database::connect();
        
        $sql = "DELETE TAFGI.* FROM tbl_articulos_formularios_grupos_items TAFGI     
                    INNER JOIN tbl_formularios_grupos_items TFGI ON TAFGI.ID_FORMULARIO_GRUPO_ITEM =TFGI.ID
                    WHERE TAFGI.ID_ARTICULO=$idArticulo
                    AND TFGI.ID_FORMULARIO=$idFormulario";   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }    

    public function getAllByFormArt($idFormulario,$idArticulo){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TFGI.ID AS 'ID',
                        null AS 'Valor',
                        '' AS 'Problema',
                        '' AS 'Solucion',
                        TAFGI.ID_ARTICULO As 'IdArticulo',
                        TAFGI.ID_FORMULARIO_GRUPO_ITEM AS 'IdFormGrupItem',
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción',
                        TFGI.ID_FORMULARIO AS 'IdFormulario',
                        TFGI.ID_GRUPO AS 'IdGrupo',
                        TFGI.ORDEN AS 'Orden',
                        TF.NOMBRE AS 'NombreFormulario',
                        TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        TF.CAPTURA_LOTE AS 'Captura lote',
                        TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                        TG.NOMBRE AS 'NombreGrupo',
                        TG.CAPTURA_IMAGEN AS 'CapturaImagen',
                        TI.NOMBRE AS 'NombreItem',
                        TAG.IMAGEN_ETIQUETA AS 'EjemploEtiqueta'
                FROM tbl_articulos_formularios_grupos_items TAFGI                    
                    INNER JOIN tbl_articulos TA ON TAFGI.ID_ARTICULO=TA.ID
                    INNER JOIN tbl_formularios_grupos_items TFGI ON TAFGI.ID_FORMULARIO_GRUPO_ITEM =TFGI.ID
                    INNER JOIN tbl_formularios TF ON TFGI.ID_FORMULARIO=TF.ID
                    INNER JOIN tbl_grupos TG ON TFGI.ID_GRUPO=TG.ID
                    INNER JOIN tbl_items TI ON TFGI.ID_ITEM=TI.ID
                    LEFT JOIN tbl_articulos_grupos TAG ON TAFGI.ID_ARTICULO=TAG.ID_ARTICULO AND TG.ID=TAG.ID_GRUPO
                    WHERE TAFGI.ID_ARTICULO=$idArticulo AND TFGI.ID_FORMULARIO=$idFormulario
                    ORDER BY TFGI.ID_FORMULARIO,TAFGI.ID_ARTICULO,TFGI.ID_GRUPO,TFGI.ORDEN";   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }


}

