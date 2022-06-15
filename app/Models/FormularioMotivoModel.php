<?php namespace App\Models;

use CodeIgniter\Model;

class FormularioMotivoModel extends Model
{
    protected $table = 'tbl_formularios_motivos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'ID_FORMULARIO',
        'ID_MOTIVO'
    ];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];


    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TFM.ID AS 'Id',
                        TFM.ID_FORMULARIO AS 'Id formulario',
                        TFM.ID_MOTIVO AS 'Id motivo',
                        TM.NOMBRE AS 'Nombre motivo',               
                        TF.NOMBRE AS 'Nombre formulario',
                        TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        TF.CAPTURA_LOTE AS 'Captura lote',
                        TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                        TG.NOMBRE AS 'Nombre grupo',
                        TG.CAPTURA_IMAGEN AS 'Captura imagen',
                        TI.NOMBRE AS 'Nombre Item'
                FROM tbl_formularios_motivos TFM                    
                    INNER JOIN tbl_motivos TM ON TFM.ID_MOTIVO=TM.ID
                    INNER JOIN tbl_formularios TF ON TMF.ID_FORMULARIO=TF.ID";   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
   
}

