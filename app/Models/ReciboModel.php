<?php namespace App\Models;

use CodeIgniter\Model;

class ReciboModel extends Model
{
    protected $table = 'tbl_recibos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'FECHA',
        'NUMERO',
        'REF',
        'CONCEPTO',
        'CLIENTE_ID',
        'NOMBRE',
        'DNI',
        'DOMICILIO',        
        'POBLACION',
        'COD_POSTAL',
        'CONTACTO',
        'TELEFONO',
        'EMAIL',
        'IMPORTE',
        'CUENTA',
        'COBRADO',
        'SECCION_ID',
        'CUENTA_RECEPTORA',
        'CREATED_AT'
    ];

    protected $beforeUpdate = ['beforeUpdate'];

    // protected $createdField  = 'CREATED_AT';
    protected $updatedField  = 'UPDATED_AT';

    protected function beforeUpdate(array $data){
        $data['data']['UPDATED_AT']=date("Y-m-d H:i:s");

        return $data;
    }

    public function getAll($idSeccion){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TR.ID,
                        TR.FECHA AS '".lang('Translate.fecha')."',
                        TR.NUMERO AS '".lang('Translate.numero')."',
                        TR.REF AS '".lang('Translate.referencia')."',
                        TR.CONCEPTO AS '".lang('Translate.concepto')."',
                        TR.NOMBRE AS '".lang('Translate.nombre')."',
                        TR.DNI AS '".lang('Translate.dni')."',                        
                        TR.IMPORTE AS '".lang('Translate.importe')."',
                        TR.CUENTA AS '".lang('Translate.cuenta')."',
                        TR.CREATED_AT AS '".lang('Translate.created')."'
                FROM $this->table TR
                WHERE TR.SECCION_ID=$idSeccion";

        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getById($id){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TR.ID,
                        DATE_FORMAT(TR.FECHA,'%d/%m/%Y') AS 'Fecha',
                        TR.NUMERO AS 'Numero',
                        TR.REF AS 'Referencia',
                        TR.CONCEPTO AS 'Concepto',
                        TR.NOMBRE AS 'Cliente',
                        TR.DNI AS 'DNI',
                        TR.CONTACTO AS 'Contacto',
                        TR.TELEFONO AS 'Telefono',
                        TR.EMAIL AS 'Email',
                        TR.CUENTA AS 'Cuenta',
                        TR.IMPORTE AS 'Importe',
                        CASE WHEN ISNULL(TR.COBRADO) THEN false ELSE true END AS 'Cobrado'
                FROM $this->table TR
                WHERE TR.ID=$id";
        
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getByIdCliente($idCliente){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TR.ID,
                        TR.NUMERO AS '".lang('Translate.numero')."', 
                        DATE_FORMAT(TR.FECHA,'%d/%m/%Y') AS '".lang('Translate.fecha')."',
                        TR.REF AS '".lang('Translate.referencia')."',
                        TR.CONCEPTO AS '".lang('Translate.concepto')."',
                        TR.IMPORTE AS '".lang('Translate.importe')."'
                FROM $this->table TR
                WHERE TR.CLIENTE_ID=$idCliente";
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function insertar($fecha,$ref,$concepto,$ids){
        $db = \Config\Database::connect();

        $sql = "SELECT IFNULL(MAX(NUMERO),0) AS NUMERO FROM $this->table WHERE YEAR(FECHA)=".date('Y', strtotime($fecha));
        
        $query = $db->query($sql);
		
		$results = $query->getResult();
        $numero =$results[0]->NUMERO;
        
        $sql = "INSERT INTO $this->table (FECHA, NUMERO, REF, CONCEPTO, CLIENTE_ID, NOMBRE, DNI, DOMICILIO, POBLACION, COD_POSTAL, CONTACTO, TELEFONO, EMAIL, IMPORTE, CUENTA, COBRADO, SECCION_ID,CUENTA_RECEPTORA)
                SELECT  '$fecha' AS FECHA,(@row_number:=@row_number + 1) AS NUMERO,'$ref' AS REF, '$concepto' AS CONCEPTO,
                        TC.ID,CONCAT(IFNULL(TC.NOMBRE,''),' ', IFNULL(TC.APELLIDOS,'')) AS NOMBRE,
                        TC.DNI, TC.DOMICILIO, TC.POBLACION, TC.COD_POSTAL, TC.CONTACTO, TC.TELEFONO, TC.EMAIL,
                        SUM(TCA.PRECIO) AS IMPORTE, TC.CUENTA, NOW(),TC.SECCION_ID,TS.NUMCUENTA AS CUENTA_RECEPTORA
                FROM tbl_articulos_clientes  as TAC
                INNER JOIN tbl_clientes AS TC
                ON TAC.CLIENTE_ID=TC.ID                
                INNER JOIN tbl_articulos AS TA
                ON TAC.ARTICULO_ID=TA.ID
                INNER JOIN tbl_categorias AS TCA
                ON TA.CATEGORIA_ID=TCA.ID
                INNER JOIN tbl_secciones AS TS
                ON TC.SECCION_ID=TS.ID
                CROSS JOIN (SELECT @row_number:=$numero) AS temp
                WHERE TAC.ID IN ($ids)
                GROUP BY TC.ID";
            
        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function existeRef($ref)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(ID) AS CUANTOS
                FROM  $this->table as TR
                WHERE TR.REF='$ref'";
            
        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function modificarCobrado($id,$cobrado)
    {
        $db = \Config\Database::connect();

        if($cobrado){
            $sql = "UPDATE COBRADO=$cobrado,UPDATED_AT=NOW()
                    FROM $this->table 
                    WHERE ID = $id";
        } else{
            $sql = "UPDATE 
            FROM $this->table 
            WHERE ID = $id";
        }
        $query = $db->query($sql);
		
		$results = $query->getResult();
        
        $sql = "DELETE FROM tbl_recibos WHERE ID= $id";
                
        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function deleteById($id,$usuarioId)
    {
        $db = \Config\Database::connect();

        $sql = "INSERT INTO tbl_recibos_eliminados (FECHA, NUMERO, REF, CONCEPTO, CLIENTE, DNI, DOMICILIO, POBLACION, COD_POSTAL, CONTACTO,
                TELEFONO, EMAIL, IMPORTE, CUENTA, COBRADO, SECCION_ID, CUENTA_RECEPTORA, USUARIO_ID)
                SELECT FECHA, NUMERO, REF, CONCEPTO, CLIENTE, DNI, DOMICILIO, POBLACION, COD_POSTAL, CONTACTO,
                TELEFONO, EMAIL, IMPORTE, CUENTA, COBRADO, SECCION_ID, CUENTA_RECEPTORA, $usuarioId
                FROM $this->table WHERE ID = $id";
        
        $query = $db->query($sql);
		
		$results = $query->getResult();
        
        $sql = "DELETE FROM tbl_recibos WHERE ID= $id";
                
        $query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function ObtenerDatosCabeceraRemesa($referencia)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT COUNT(ID) AS CUANTOS,SUM(IMPORTE) AS TOTAL, MAX(FECHA) AS FECHA
                FROM $this->table WHERE REF = '$referencia'
                GROUP BY REF";
        
        $query = $db->query($sql);
		
		$results = $query->getResult();
        
        return json_encode($results);
    }

    public function ObtenerDatosLineasRemesa($referencia)
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT CONCAT(YEAR(TR.FECHA),'/',TR.NUMERO) AS NUMRECIBO, TR.CONCEPTO, TR.IMPORTE, TR.DNI, TR.FECHA,
                TR.NOMBRE,REPLACE(TR.CUENTA,' ','') AS CUENTA, TR.DOMICILIO,TR.POBLACION,TR.COD_POSTAL
                FROM $this->table AS TR
                WHERE TR.REF = '$referencia'";
        
        $query = $db->query($sql);
		
		$results = $query->getResult();
        
       
        return json_encode($results);
    }
}

