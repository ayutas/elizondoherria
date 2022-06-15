<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'tbl_categorias';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'NOMBRE', 
        'PRECIO',               
        'DELETED_AT'
    ];

    protected $beforeUpdate = ['beforeUpdate'];

    // protected $createdField  = 'CREATED_AT';
    protected $updatedField  = 'UPDATED_AT';

    protected function beforeUpdate(array $data){
        $data['data']['UPDATED_AT']=date("Y-m-d H:i:s");

        return $data;
    }

    public function getAll($id=null){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TI.ID As 'ID',
                        TI.NOMBRE As 'Nombre',
                        TI.PRECIO As 'Precio'
                FROM tbl_categorias TI
                WHERE ISNULL(TI.DELETED_AT)";   

        if($id)
        {   $sql.=   " AND TI.ID=$id";
        }       
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
       
    public function deleteById($id)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE tbl_categorias
                SET DELETED_AT=NOW()
                WHERE ID=$id";

		$query = $db->query($sql);
		
		return $query->getResult();
    } 
}

