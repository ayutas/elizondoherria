<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloClienteModel extends Model
{
    protected $table = 'tbl_articulos_clientes';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = [
        'ARTICULO_ID',
        'CLIENTE_ID', 
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
        
        $sql = "SELECT  TA.NUMERO,TA.LETRA,TG.NOMBRE AS 'CATEGORIA',TC.NOMBRE,TC.APELLIDOS,TC.DNI,
                TC.DOMICILIO,TC.POBLACION,TC.COD_POSTAL,TC.TELEFONO,TC.EMAIL,TC.IBAN,
                TB.CODIGO AS 'COD_BANCO',TB.NOMBRE AS 'NOMBRE_BANCO',TC.AGENCIA,TC.CUENTA,TC.NOTAS,TAC.CREATED_AT
                FROM $this->table as TAC
                INNER JOIN tbl_articulos AS TA ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias AS TG ON TA.CATEGORIA_ID=TG.ID
                INNER JOIN tbl_clientes TC ON TAC.CLIENTE_ID=TC.ID
                INNER JOIN tbl_bancos TB ON TC.BANCO_ID=TB.ID
                WHERE TAC.ID=$id";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getByCliente($idCliente){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TAC.ID,
                        TA.NUMERO As 'Número',
                        TA.LETRA AS 'Letra',
                        TC.NOMBRE AS 'Categoría',
                        TC.PRECIO AS 'Precio'
                FROM $this->table as TAC
                INNER JOIN tbl_articulos as TA ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias as TC ON TA.CATEGORIA_ID=TC.ID
                WHERE TAC.CLIENTE_ID=$idCliente
                AND ISNULL(TAC.DELETED_AT)";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getArticulosDisponibles(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  '' as 'btnSeleccionar',
                        TA.ID as 'ID',
                        TA.NUMERO as 'Número',
                        TA.LETRA as 'Letra',
                        TC.NOMBRE AS 'Categoría',
                        TC.PRECIO AS 'Precio'
                FROM tbl_articulos AS TA
                INNER JOIN tbl_categorias as TC ON TA.CATEGORIA_ID=TC.ID
                LEFT JOIN $this->table as TAC ON TA.ID=TAC.ARTICULO_ID AND ISNULL(TAC.DELETED_AT)
                WHERE ISNULL(TAC.ID)";

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
   
    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  '' AS '',
                        TAC.ID,
                        CONCAT(IFNULL(TC.NOMBRE,''),IFNULL(TC.APELLIDOS,'')) AS 'Nombre',
                        TC.DNI AS 'DNI',
                        CONCAT(TA.NUMERO,TA.LETRA) AS 'Número',
                        TCA.NOMBRE AS 'Categoría',
                        TCA.PRECIO AS 'Importe',
                        CONCAT(TC.IBAN,TB.CODIGO,TC.AGENCIA,TC.CUENTA) AS 'Cuenta'                        
                FROM $this->table  as TAC
                INNER JOIN tbl_clientes AS TC
                ON TAC.CLIENTE_ID=TC.ID
                INNER JOIN tbl_bancos AS TB
                ON TC.BANCO_ID=TB.ID
                INNER JOIN tbl_articulos AS TA
                ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias AS TCA
                ON TA.CATEGORIA_ID=TCA.ID
                WHERE ISNULL(TAC.DELETED_AT)";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
}

