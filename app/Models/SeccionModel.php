<?php namespace App\Models;

use CodeIgniter\Model;

class SeccionModel extends Model
{
    protected $table = 'tbl_secciones';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'DESCRIPCION',
        'NOMBRE',
        'DOMICILIO',
        'CPOSTAL',
        'POBLACION',        
        'NUMCUENTA',
        'BIC',
        'IDENTIFICADOR'
    ];

    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TS.ID As 'ID',
                        TS.DESCRIPCION As '".lang('Translate.descripcion')."'
                FROM $this->table TS";
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getById($id){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TS.ID As 'ID',
                        TS.DESCRIPCION As 'Descripcion',
                        TS.NOMBRE As 'Nombre',
                        TS.DOMICILIO AS 'Domicilio',
                        TS.POBLACION AS 'Poblacion',
                        TS.CPOSTAL AS 'CPostal',
                        TS.NUMCUENTA AS 'Cuenta',
                        TS.BIC AS 'BIC',
                        TS.IDENTIFICADOR AS 'Identificador'
                FROM $this->table TS
                WHERE TS.ID=$id";
           
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
   
}

