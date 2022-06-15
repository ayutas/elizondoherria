<?php namespace App\Models;

use CodeIgniter\Model;

class MotivoModel extends Model
{
    protected $table = 'tbl_motivos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'NOMBRE',       
        'DELETED_AT' 
    ];

    // protected $createdField  = 'CREATED_AT';
    // protected $updatedField  = 'UPDATED_AT';


    public function getAll($id=null){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TM.ID As 'ID',
                        TM.NOMBRE As 'Motivo'                   
                FROM tbl_motivos TM
                WHERE ISNULL(TM.DELETED_AT)";  
                
        if($id)
        {   $sql.=   " AND TM.ID=$id";
        }                   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
   
    public function deleteById($id)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE tbl_motivos
                SET DELETED_AT=NOW()
                WHERE ID=$id";

		$query = $db->query($sql);
		
		return $query->getResult();
    } 
}

