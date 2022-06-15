<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloFormularioModel extends Model
{
    protected $table = 'tbl_articulos_formularios';
    protected $primaryKey = 'ID_ARTICULO','ID_FORMULARIO';
    protected $allowedFields = [
    //    'REFERENCIA',         
    //    'DESCRIPCION',         
    ];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];


    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TAF.ID_ARTICULO As 'Id articulo',
                        TAF.ID_FORMULARIO AS 'Id formulario',
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción',                        
                        TF.NOMBRE AS 'Nombre formulario',
                        TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        TF.CAPTURA_LOTE AS 'Captura lote',
                        TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo'
                FROM tbl_articulos_formularios TAF                    
                    INNER JOIN tbl_articulos TA ON TAF.ID_ARTICULO=TA.ID                    
                    INNER JOIN tbl_formularios TF ON TAF.ID_FORMULARIO=TF.ID";

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
   
}

