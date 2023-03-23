<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloModel extends Model
{
    protected $table = 'tbl_articulos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'DESCRIPCION',
        'NUMERO',
        'LETRA',
        'CATEGORIA_ID',
        'SECCION_ID',
        'DISPONIBLE',
        'DELETED_AT',
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
        
        $sql = "SELECT  TA.ID as 'ID',
                        TA.DESCRIPCION as '".lang('Translate.descripcion')."',
                        TA.NUMERO as '".lang('Translate.numero')."',
                        TA.LETRA as '".lang('Translate.letra')."',
                        TC.NOMBRE as '".lang('Translate.categoria')."',
                        TC.PRECIO as '".lang('Translate.precio')."'
                FROM $this->table TA
                INNER JOIN tbl_categorias AS TC ON TA.CATEGORIA_ID=TC.ID
                WHERE ISNULL(TA.DELETED_AT) AND TA.SECCION_ID=$seccion";

        
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getById($id){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TA.ID as 'ID',
                        TA.DESCRIPCION as 'Descripción',
                        TA.NUMERO as 'Número',
                        TA.LETRA as 'Letra',
                        TA.CATEGORIA_ID,
                        TC.NOMBRE as 'Categoría',
                        TC.PRECIO as 'Precio',
                        TA.DISPONIBLE as 'Disponible'
                FROM $this->table TA
                INNER JOIN tbl_categorias AS TC ON TA.CATEGORIA_ID=TC.ID
                WHERE TA.ID=$id";
        
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

    public function existeArticulo($id,$descripcion,$numero)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT *
                FROM $this->table
                WHERE DELETED_AT IS NULL AND DESCRIPCION='$descripcion'";

        if($numero!=""){
            if($id!=""){
                $sql.=" AND NUMERO=$numero AND ID<>$id";
            } else {
                $sql.=" AND NUMERO=$numero";
            }
        } else {
            if($id!=""){
                $sql.=" AND ID<>$id";
            }
        }
        
        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
}

