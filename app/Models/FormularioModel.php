<?php namespace App\Models;

use CodeIgniter\Model;

class FormularioModel extends Model
{
    protected $table = 'tbl_formularios';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'NOMBRE',
        'CAPTURA_ARTICULO',
        'CAPTURA_LOTE',
        'CAPTURA_CADUCIDAD',
        'CAPTURA_DOCUMENTO',
        'CAPTURA_ENTIDAD',
        'CAPTURA_MOTIVO_CHEQUEO',
        'PRECARGAR',
        'DELETED_AT'

    ];

    // protected $createdField  = 'CREATED_AT';
    //protected $updatedField  = 'UPDATED_AT';
    //protected $deletedField  = 'DELETED_AT';


    public function getAll($id=null){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TF.ID As 'ID',
                        TF.NOMBRE As 'Nombre',
                        TF.CAPTURA_ARTICULO As 'Articulo',
                        TF.CAPTURA_LOTE As 'Lote',
                        TF.CAPTURA_CADUCIDAD As 'Caducidad',
                        TF.CAPTURA_DOCUMENTO As 'Documento',
                        TF.CAPTURA_ENTIDAD As 'Entidad',
                        TF.CAPTURA_MOTIVO_CHEQUEO As 'Motivo' ,
                        TF.PRECARGAR As 'Precargar' 
                FROM tbl_formularios TF
                WHERE ISNULL(TF.DELETED_AT)";   

        if($id)
        {   
            $sql.=   " AND TF.ID=$id";
        }
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
   
    public function deleteById($id)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE tbl_formularios
                SET DELETED_AT=NOW()
                WHERE ID=$id";

		$query = $db->query($sql);
		
		return $query->getResult();
    } 
}

