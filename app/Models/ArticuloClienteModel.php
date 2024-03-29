<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloClienteModel extends Model
{
    protected $table = 'tbl_articulos_clientes';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = [
        'ARTICULO_ID',
        'CLIENTE_ID', 
        'CANTIDAD',
        'DELETED_AT',   
    ];

    protected $beforeUpdate = ['beforeUpdate'];

    // protected $createdField  = 'CREATED_AT';
    protected $updatedField  = 'UPDATED_AT';

    protected function beforeUpdate(array $data){
        $data['data']['UPDATED_AT']=date("Y-m-d H:i:s");

        return $data;
    }


    public function getById($id){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TA.NUMERO,TA.LETRA,TG.NOMBRE AS 'CATEGORIA', TAC.CANTIDAD*100 AS PORCENTAJE,TC.NOMBRE,TC.APELLIDOS,TC.DNI,
                TC.DOMICILIO,TC.POBLACION,TC.COD_POSTAL,TC.TELEFONO,TC.EMAIL,TC.CUENTA,TC.NOTAS,DATE_FORMAT(TAC.CREATED_AT,'%d/%m/%Y') AS CREATED_AT
                FROM $this->table as TAC
                INNER JOIN tbl_articulos AS TA ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias AS TG ON TA.CATEGORIA_ID=TG.ID
                INNER JOIN tbl_clientes TC ON TAC.CLIENTE_ID=TC.ID
                
                WHERE TAC.ID=$id";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getByCliente($idCliente){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TAC.ID,
                        TA.DESCRIPCION AS '".lang('Translate.descripcion')."',
                        TA.NUMERO AS '".lang('Translate.numero')."',
                        TA.LETRA AS '".lang('Translate.letra')."',
                        TC.NOMBRE AS '".lang('Translate.categoria')."',
                        TAC.CANTIDAD AS '".lang('Translate.cantidad')."',
                        TC.PRECIO AS '".lang('Translate.precio')."',
                        TC.PRECIO*TAC.CANTIDAD AS '".lang('Translate.importe')."'
                FROM $this->table as TAC
                INNER JOIN tbl_articulos as TA ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias as TC ON TA.CATEGORIA_ID=TC.ID
                WHERE TAC.CLIENTE_ID=$idCliente
                AND ISNULL(TAC.DELETED_AT)";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getArticulosDisponibles($seccion){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  '' as 'btnSeleccionar',
        
                        TA.ID as 'ID',
                        TA.DESCRIPCION AS '".lang('Translate.descripcion')."',
                        TA.NUMERO AS '".lang('Translate.numero')."',
                        TA.LETRA AS '".lang('Translate.letra')."',
                        TC.NOMBRE AS '".lang('Translate.categoria')."',
                        TC.PRECIO AS '".lang('Translate.precio')."',
                        TA.DISPONIBLE-IFNULL(TAC.CANTIDAD,0) AS '".lang('Translate.disponible')."'
                FROM tbl_articulos AS TA
                INNER JOIN tbl_categorias as TC ON TA.CATEGORIA_ID=TC.ID
                LEFT JOIN (SELECT ARTICULO_ID,SUM(CANTIDAD) AS CANTIDAD FROM $this->table WHERE ISNULL(DELETED_AT) GROUP BY ARTICULO_ID) as TAC 
                    ON TA.ID=TAC.ARTICULO_ID
                WHERE TA.SECCION_ID=$seccion AND TA.DISPONIBLE-IFNULL(TAC.CANTIDAD,0)>0";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getClienteAsignado($idArticulo){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TC.ID As 'ID',
                        CONCAT(IFNULL(TC.NOMBRE,''),' ',IFNULL(TC.APELLIDOS,'')) AS 'Cliente',
                        CONCAT('".base_url() . "/clientes/edit/',TC.ID) AS 'Link'
                FROM $this->table as TAC
                INNER JOIN tbl_clientes as TC ON TAC.CLIENTE_ID=TC.ID
                WHERE TAC.ARTICULO_ID=$idArticulo
                AND ISNULL(TAC.DELETED_AT)";

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
   
    public function getAll($seccion){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  '' AS '',
                        TAC.ID,
                        CONCAT(IFNULL(TC.NOMBRE,''),IFNULL(TC.APELLIDOS,'')) AS '".lang('Translate.nombre')."',
                        TC.DNI AS '".lang('Translate.dni')."',
                        CONCAT(TA.NUMERO,TA.LETRA) AS '".lang('Translate.numero')."',
                        TCA.NOMBRE AS '".lang('Translate.categoria')."',
                        TAC.CANTIDAD*TCA.PRECIO AS '".lang('Translate.importe')."',
                        TC.CUENTA AS '".lang('Translate.cuenta')."'
                FROM $this->table  as TAC
                INNER JOIN tbl_clientes AS TC
                ON TAC.CLIENTE_ID=TC.ID
                INNER JOIN tbl_articulos AS TA
                ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias AS TCA
                ON TA.CATEGORIA_ID=TCA.ID
                WHERE ISNULL(TAC.DELETED_AT) AND TC.SECCION_ID=$seccion";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
}

