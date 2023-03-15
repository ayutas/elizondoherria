<?php namespace App\Models;

use CodeIgniter\Model;

class ZonaModel extends Model
{
    protected $table = 'tbl_zonas';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'DESCRIPCION', 
        'SECCION_ID',
        'CREATED_AT',
        'DELETED_AT'
    ];

    public function getAll($seccion){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TZ.ID As 'ID',
                        TZ.DESCRIPCION As '".lang('Translate.descripcion')."'
                FROM $this->table TZ
                WHERE ISNULL(TZ.DELETED_AT) AND TZ.SECCION_ID=$seccion";
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getData($seccion){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TZ.ID As 'ID',
                        TZ.DESCRIPCION
                FROM $this->table TZ
                WHERE ISNULL(TZ.DELETED_AT) AND TZ.SECCION_ID=$seccion";
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getById($id){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TZ.ID As 'ID',
                        TZ.DESCRIPCION
                FROM $this->table TZ
                WHERE ISNULL(TZ.DELETED_AT) AND TZ.ID=$id";
           
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

