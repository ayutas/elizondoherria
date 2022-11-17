<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteComentarioModel extends Model
{
    protected $table = 'tbl_clientes_comentarios';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'CLIENTE_ID',
        'COMENTARIO',
        'CREATED_AT',        
        'DELETED_AT'
    ];

    protected $beforeUpdate = ['beforeUpdate'];

    // protected $createdField  = 'CREATED_AT';
    protected $updatedField  = 'UPDATED_AT';

    protected function beforeUpdate(array $data){
        $data['data']['UPDATED_AT']=date("Y-m-d H:i:s");

        return $data;
    }

    public function getById($id){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TC.ID As 'ID',
                        TC.NOMBRE As 'Nombre',
                        TC.APELLIDOS As 'Apellidos',
                        TC.DNI
                FROM $this->table TC
                WHERE TC.ID=$id AND ISNULL(TC.DELETED_AT)";   

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getByCliente($idCliente){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TC.ID As 'ID',
                        TC.COMENTARIO As 'Comentario',
                        TC.CREATED_AT As 'Creado',
                        TC.UPDATED_AT As 'Modificado'
                FROM $this->table TC                
                WHERE TC.CLIENTE_ID=$idCliente AND ISNULL(TC.DELETED_AT)";   

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

