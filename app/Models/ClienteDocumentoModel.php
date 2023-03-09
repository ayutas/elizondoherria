<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteDocumentoModel extends Model
{
    protected $table = 'tbl_clientes_documentos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'CLIENTE_ID',
        'TITULO',
        'RUTA',
        'CREATED_AT'
    ];

    

    public function getByCliente($clienteId){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  ID,
                        TITULO AS 'Título',
                        CREATED_AT AS 'Creado',
                        RUTA AS 'Ruta'
                FROM $this->table TCD
                WHERE TCD.CLIENTE_ID=$clienteId";
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getById($id){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  *
                FROM $this->table TCD
                WHERE TCD.ID=$id";
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }    
       
    public function deleteById($id)
    {
        $db = \Config\Database::connect();
        
        $sql = "DELETE FROM $this->table                
                WHERE ID=$id";

		$query = $db->query($sql);
		
		return $query->getResult();
    } 
}

