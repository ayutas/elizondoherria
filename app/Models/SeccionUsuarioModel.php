<?php namespace App\Models;

use CodeIgniter\Model;

class SeccionUsuarioModel extends Model
{
    protected $table = 'tbl_secciones_usuarios';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = [
        'SECCION_ID',
        'USUARIO_ID',        
    ];

    public function getSeccionesByUsuario($idUsuario){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TSU.*,TS.DESCRIPCION
                FROM $this->table AS TSU
                INNER JOIN tbl_secciones AS TS
                ON TSU.SECCION_ID=TS.ID
                WHERE USUARIO_ID=$idUsuario";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
}

