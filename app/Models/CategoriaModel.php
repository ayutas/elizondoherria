<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'tbl_categorias';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'NOMBRE', 
        'PRECIO',
        'SECCION_ID',
        'DELETED_AT'
    ];

    protected $beforeUpdate = ['beforeUpdate'];

    // protected $createdField  = 'CREATED_AT';
    protected $updatedField  = 'UPDATED_AT';

    protected function beforeUpdate(array $data){
        $data['data']['UPDATED_AT']=date("Y-m-d H:i:s");

        return $data;
    }

    public function getAll($seccion){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TC.ID As 'ID',
                        TC.NOMBRE As '".lang('Translate.nombre')."',
                        TC.PRECIO As '".lang('Translate.precio')."'
                FROM $this->table TC
                WHERE ISNULL(TC.DELETED_AT) AND TC.SECCION_ID=$seccion";
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getById($id){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TC.ID As 'ID',
                        TC.NOMBRE As 'Nombre',
                        TC.PRECIO As 'Precio'
                FROM $this->table TC
                WHERE ISNULL(TC.DELETED_AT) AND TC.ID=$id";
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
       
    public function deleteById($id)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE $this->table
                SET DELETED_AT=NOW()
                WHERE ID=$id";

		$query = $db->query($sql);
		
		return $query->getResult();
    } 
}

