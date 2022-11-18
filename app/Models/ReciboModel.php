<?php namespace App\Models;

use CodeIgniter\Model;

class ReciboModel extends Model
{
    protected $table = 'tbl_recibos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'FECHA',
        'REF',
        'ARTICULO_CLIENTE_ID',
        'IMPORTE',
        'CUENTA',
        'COBRADO',        
        'CREATED_AT'
    ];

    protected $beforeUpdate = ['beforeUpdate'];

    // protected $createdField  = 'CREATED_AT';
    protected $updatedField  = 'UPDATED_AT';

    protected function beforeUpdate(array $data){
        $data['data']['UPDATED_AT']=date("Y-m-d H:i:s");

        return $data;
    }

    public function getAll(){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TR.ID,
                        TR.FECHA AS 'Fecha',
                        TR.REF AS 'Ref',
                        CONCAT(IFNULL(TC.NOMBRE,''),IFNULL(TC.APELLIDOS,'')) AS 'Nombre',
                        TC.DNI AS 'DNI',
                        CONCAT(TA.NUMERO,TA.LETRA) AS 'Número',
                        TCA.NOMBRE AS 'Categoría',
                        TR.IMPORTE AS 'Importe',
                        TR.CUENTA AS 'Cuenta',
                        TR.CREATED_AT AS 'Creado',
                        TR.UPDATED_AT AS 'Actualizado'
                FROM $this->table TR
                INNER JOIN tbl_articulos_clientes as TAC
                ON TR.ARTICULO_CLIENTE_ID=TAC.ID
                INNER JOIN tbl_clientes AS TC
                ON TAC.CLIENTE_ID=TC.ID
                INNER JOIN tbl_articulos as TA
                ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias as TCA
                ON TA.CATEGORIA_ID=TCA.ID";

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
                        TC.IBAN AS 'Iban',
                        TC.BANCO_ID AS 'Banco',
                        TC.AGENCIA AS 'Agencia',
                        TC.CUENTA AS 'Cuenta',
                        TC.NOTAS AS 'Notas'
                FROM $this->table TC";   

        if($id)
        {   $sql.=   " WHERE TC.ID=$id";
        }
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function insertar($fecha,$ref,$ids){
        $db = \Config\Database::connect();
        
        $sql = "INSERT INTO tbl_recibos (FECHA, REF, ARTICULO_CLIENTE_ID, CLIENTE, DNI, ARTICULO, CATEGORIA, IMPORTE, CUENTA)
                SELECT  '$fecha','$ref', TAC.ID,
                        CONCAT(IFNULL(TC.NOMBRE,''),IFNULL(TC.APELLIDOS,'')) AS 'Nombre',
                        TC.DNI AS 'DNI',
                        CONCAT(TA.NUMERO,TA.LETRA) AS 'Número',
                        TCA.NOMBRE AS 'Categoría',
                        TCA.PRECIO AS 'Importe',
                        CONCAT(TC.IBAN,TB.CODIGO,TC.AGENCIA,TC.CUENTA) AS 'Cuenta'                        
                FROM tbl_articulos_clientes  as TAC
                INNER JOIN tbl_clientes AS TC
                ON TAC.CLIENTE_ID=TC.ID
                INNER JOIN tbl_bancos AS TB
                ON TC.BANCO_ID=TB.ID
                INNER JOIN tbl_articulos AS TA
                ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias AS TCA
                ON TA.CATEGORIA_ID=TCA.ID
                WHERE TAC.ID IN ($ids)";
        return $sql;
        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }
}

