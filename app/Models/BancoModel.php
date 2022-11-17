<?php namespace App\Models;

use CodeIgniter\Model;

class BancoModel extends Model
{
    protected $table = 'tbl_bancos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'CODIGO',
        'NOMBRE',
        'COD_PAIS'
    ];
    

    public function getAll($id=null){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TD.ID As 'ID',
                        TD.CODIGO As 'Código',
                        TD.NOMBRE As 'Nombre',
                        TD.COD_PAIS As 'País'
                FROM tbl_bancos TD";

        if($id)
        {   $sql.=   " WHERE TD.ID=$id";
        }

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function deleteByCodigo($id)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE tbl_bancos
                SET DELETED_AT=NOW()
                WHERE ID=$id";

		$query = $db->query($sql);
		
		return $query->getResult();
    } 
   
}

