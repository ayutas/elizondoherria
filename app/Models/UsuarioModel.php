<?php namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class UsuarioModel extends Model
{
    protected $table = 'tbl_usuarios';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'NOMBRE', 
        'AP1', 
        'AP2',
        'ADMINISTRADOR',        
        'USUARIO',
        'CONTRASENA',
        'DELETED_AT',
    ];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected $createdField  = 'CREATED_AT';
    protected $updatedField  = 'UPDATED_AT';


    protected function beforeInsert(array $data){
        //$data['CREATED_AT']=date("Y-m-d H:i:s");
        $data = $this->passwordHash($data);
        return $data;
    }
    
    protected function beforeUpdate(array $data){
        $data['data']['UPDATED_AT']=date("Y-m-d H:i:s");
        $data = $this->passwordHash($data);

        return $data;
    }
    
    protected function passwordHash(array $data){
        if(isset($data['data']['CONTRASENA'])) {
            $data['data']['CONTRASENA'] = password_hash($data['data']['CONTRASENA'],PASSWORD_DEFAULT); 
        }
        return $data;
    }

    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TU.ID As 'ID',
                        TU.NOMBRE As '".lang('Translate.nombre')."',
						TU.AP1 As '".lang('Translate.apellido1')."',
                        TU.AP2 As '".lang('Translate.apellido2')."',
                        IF(TU.ADMINISTRADOR=1,'Si','No') AS 'Admin',
                        TU.USUARIO AS '".lang('Translate.usuario')."',                        
                        TU.CREATED_AT As '".lang('Translate.created')."',
                        TU.UPDATED_AT As '".lang('Translate.updated')."'
                FROM tbl_usuarios TU
                WHERE ISNULL(TU.DELETED_AT)";                  

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getById($id){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TU.ID As 'ID',
                        TU.NOMBRE As 'Nombre',
						TU.AP1 As 'Apellido1',
                        TU.AP2 As 'Apellido2',
                        TU.ADMINISTRADOR AS 'Admin',
                        TU.USUARIO AS 'Usuario',                        
                        TU.CREATED_AT As 'Creado',
                        TU.UPDATED_AT As 'Actualizado'
                FROM tbl_usuarios TU
                WHERE TU.ID=$id";

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function deleteById($id)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE tbl_usuarios
                SET DELETED_AT=NOW()
                WHERE ID=$id";

		$query = $db->query($sql);
		
		return $query->getResult();
    }   
   
}

