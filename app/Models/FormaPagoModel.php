<?php namespace App\Models;

use CodeIgniter\Model;

class FormaPagoModel extends Model
{
    protected $table = 'tbl_formas_pago';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'DESCRIPCION', 
        'SECCION_ID',
    ];

    public function getAll($seccion){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TFP.ID As 'ID',
                        TFP.DESCRIPCION
                FROM $this->table TFP
                WHERE TFP.SECCION_ID=$seccion";
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
}

