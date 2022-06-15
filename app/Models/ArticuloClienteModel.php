<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloClienteModel extends Model
{
    protected $table = 'tbl_articulos_clientes';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = [
        'ARTICULO_ID',
        'CLIENTE_ID', 
        'DELETED_AT',   
    ];

    protected $beforeUpdate = ['beforeUpdate'];

    // protected $createdField  = 'CREATED_AT';
    protected $updatedField  = 'UPDATED_AT';

    protected function beforeUpdate(array $data){
        $data['data']['UPDATED_AT']=date("Y-m-d H:i:s");

        return $data;
    }


    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TAC.ID As 'ID',
                        TD.DESCRIPCION As 'Delegacion',
                        TAC.LINEA AS 'Línea',
                        TAC.DESCRIPCION AS 'Nombre'                        					
                FROM $this->table as TAC
                INNER JOIN tbl_articulos AS TA ON TAC.ARTICULO_ID=TA.ID                    
                INNER JOIN tbl_clientes TC ON TAC.CLIENTE_ID=TC.ID
                WHERE ISNULL(TAC.DELETED_AT)";   
     

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getByCliente($idCliente){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TA.NUMERO As 'Numero',
                        TA.LETRA AS 'Letra',
                        TC.NOMBRE AS 'Categoria',
                        TC.PRECIO AS 'Precio'
                FROM $this->table as TAC
                INNER JOIN tbl_articulos as TA ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias as TC ON TA.CATEGORIA_ID=TC.ID
                WHERE TAC.CLIENTE_ID=$idCliente";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getArticulosDisponibles(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TA.NUMERO as 'Número',
                        TA.LETRA as 'Letra',
                        TC.NOMBRE AS 'Categoría',
                        TC.PRECIO AS 'Precio'
                FROM tbl_articulos AS TA
                INNER JOIN tbl_categorias as TC ON TA.CATEGORIA_ID=TC.ID
                LEFT JOIN $this->table as TAC ON TA.ID=TAC.ARTICULO_ID AND ISNULL(TAC.DELETED_AT)
                WHERE ISNULL(TAC.ID)";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getClienteAsignado($idArticulo){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TC.ID As 'ID',
                        TC.NOMBRE AS 'Cliente'                        
                FROM $this->table as TAC
                INNER JOIN tbl_clientes as TC ON TAC.CLIENTE_ID=TC.ID
                WHERE TAC.ARTICULO_ID=$idArticulo";

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

