<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloDelegacionModel extends Model
{
    protected $table = 'tbl_articulos_delegaciones';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
       'ID_ARTICULO',
       'ID_DELEGACION'       
    ];


    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TAD.ID AS 'ID',
                        TAD.ID_ARTICULO As 'Id_Articulo',
                        TAD.ID_DELEGACION AS 'Id_Delegación'
                        TD.DESCRIPCION As 'Delegación',
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción'
                FROM tbl_articulos_delegaciones TAD
                    INNER JOIN tbl_delegaciones TD ON TAD.ID_DELEGACION=TD.ID
                    INNER JOIN tbl_articulos TA ON TAD.ID_ARTICULO=TA.ID";   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
    
    public function getByArticulo($idArticulo){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  ID AS 'ID',
                        ID_DELEGACION AS 'delegacion'
                FROM tbl_articulos_delegaciones
                WHERE ID_ARTICULO=$idArticulo";   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
    
    public function getByArticuloDelegacion($idArticulo,$idDelegacion){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  ID AS 'ID'
                FROM tbl_articulos_delegaciones
                WHERE ID_ARTICULO=$idArticulo AND ID_DELEGACION=$idDelegacion";   

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
}

