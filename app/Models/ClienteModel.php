<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'tbl_clientes';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'NOMBRE',
        'APELLIDOS',
        'DNI',
        'DOMICILIO',
        'POBLACION',
        'COD_POSTAL',
        'CONTACTO',
        'TELEFONO',
        'EMAIL',
        'CUENTA',
        'NOTAS',
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
                        TC.APELLIDOS As '".lang('Translate.apellidos')."',
                        TC.DNI AS ".lang('Translate.dni')."
                FROM $this->table TC
                WHERE ISNULL(TC.DELETED_AT) AND TC.SECCION_ID=$seccion";   

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getById($id=null){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TC.ID As 'ID',
                        TC.NOMBRE As 'Nombre',
                        TC.APELLIDOS As 'Apellidos',
                        TC.DNI,
                        TC.DOMICILIO AS 'Domicilio',
                        TC.POBLACION AS 'Poblacion',
                        TC.COD_POSTAL AS 'CPostal',
                        TC.CONTACTO AS 'Contacto',
                        TC.TELEFONO AS 'Telefono',
                        TC.EMAIL AS 'Email',
                        TC.CUENTA AS 'Cuenta',
                        TC.NOTAS AS 'Notas'
                FROM $this->table TC
                WHERE ISNULL(TC.DELETED_AT)";   

        if($id)
        {   $sql.=   " AND TC.ID=$id";
        }
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

    public function existeDniActivoSeccion($dni,$seccion)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT  *
                FROM $this->table TC
                WHERE ISNULL(TC.DELETED_AT) 
                AND TC.DNI='$dni' 
                AND TC.SECCION_ID=$seccion";

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
        
}

