<?php namespace App\Models;

use CodeIgniter\Model;

class FormularioGrupoItemModel extends Model
{
    protected $table = 'tbl_formularios_grupos_items';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'ID_FORMULARIO',
        'ID_GRUPO',
        'ID_ITEM',
        'ORDEN',
        'DELETED_AT,'
    ];
    


    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TFGI.ID AS 'Id',
                        TFGI.ID_FORMULARIO AS 'Id_formulario',
                        TFGI.ID_GRUPO AS 'Id_grupo',
                        TFGI.ID_ITEM AS 'Id_item',                        
                        TFGI.ORDEN AS 'Orden',                        
                        TF.NOMBRE AS 'Nombre_formulario',
                        -- TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        -- TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        -- TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        -- TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        -- TF.CAPTURA_LOTE AS 'Captura lote',
                        -- TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                        TG.NOMBRE AS 'Nombre_grupo',
                        TG.CAPTURA_IMAGEN AS 'Captura_imagen',
                        TI.NOMBRE AS 'Nombre_item'
                FROM tbl_formularios_grupos_items TFGI                                                            
                    INNER JOIN tbl_formularios TF ON TFGI.ID_FORMULARIO=TF.ID
                    INNER JOIN tbl_grupos TG ON TFGI.ID_GRUPO=TG.ID
                    INNER JOIN tbl_items TI ON TFGI.ID_ITEM=TI.ID
                WHERE ISNULL(TFGI.DELETED_AT)";   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getFormularioById($id)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TFGI.ID_FORMULARIO AS 'id_formulario'
                FROM tbl_formularios_grupos_items TFGI                                                            
                WHERE TFGI.ID=$id";   
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);        
    }

    public function getByFormulario($idFormulario)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TFGI.ID AS 'Id',
                        TFGI.ID_FORMULARIO AS 'Id_formulario',
                        TFGI.ID_GRUPO AS 'Id_grupo',
                        TFGI.ID_ITEM AS 'Id_item',                        
                        TFGI.ORDEN AS 'Posicion',                        
                        -- TF.NOMBRE AS 'Nombre formulario',
                        -- TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        -- TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        -- TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        -- TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        -- TF.CAPTURA_LOTE AS 'Captura lote',
                        -- TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                         TG.NOMBRE AS 'Nombre_grupo',
                        -- TG.CAPTURA_IMAGEN AS 'Captura imagen',
                         TI.NOMBRE AS 'Nombre_item',
                         false AS 'redirect'
                FROM tbl_formularios_grupos_items TFGI                                                            
                    INNER JOIN tbl_formularios TF ON TFGI.ID_FORMULARIO=TF.ID
                    INNER JOIN tbl_grupos TG ON TFGI.ID_GRUPO=TG.ID
                    RIGHT JOIN tbl_items TI ON TFGI.ID_ITEM=TI.ID
                WHERE TFGI.ID_FORMULARIO=$idFormulario
                AND ISNULL(TFGI.DELETED_AT)
                ORDER BY TFGI.ID_FORMULARIO,TFGI.ID_GRUPO,TFGI.ORDEN";   


		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);        
    }

    public function deleteByFormularioGrupo($idFormulario,$idGrupo)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE tbl_formularios_grupos_items 
                SET DELETED_AT=NOW()
                WHERE ID_FORMULARIO=$idFormulario AND ID_GRUPO=$idGrupo";   

		$query = $db->query($sql);
		
		return $query->getResult();
    }

    public function deleteByFormulario($idFormulario)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE tbl_formularios_grupos_items 
                SET DELETED_AT=NOW()
                WHERE ID_FORMULARIO=$idFormulario";   

		$query = $db->query($sql);
		
		return $query->getResult();
    }
   
}

