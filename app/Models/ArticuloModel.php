<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloModel extends Model
{
    protected $table = 'tbl_articulos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'DESCRIPCION',
        'NUMERO',
        'LETRA',
        'CATEGORIA_ID',
        'DELETED_AT',
    ];

    protected $beforeUpdate = ['beforeUpdate'];

    // protected $createdField  = 'CREATED_AT';
    protected $updatedField  = 'UPDATED_AT';

    protected function beforeUpdate(array $data){
        $data['data']['UPDATED_AT']=date("Y-m-d H:i:s");

        return $data;
    }

    public function getAll($id=null){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TA.ID as 'ID',
                        TA.DESCRIPCION as 'Descripción',
                        TA.NUMERO as 'Número',
                        TA.LETRA as 'Letra',
                        TC.NOMBRE as 'Categoría',
                        TC.PRECIO as 'Precio'
                FROM $this->table TA
                INNER JOIN tbl_categorias AS TC ON TA.CATEGORIA_ID=TC.ID
                WHERE ISNULL(TA.DELETED_AT)";
        if($id)
        {   $sql.=   " AND TA.ID=$id";
        }
        
		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    // public function getByArticulo($IdArticulo){
    //     $db = \Config\Database::connect();
        
    //     $sql = "SELECT  TA.ID As 'ID',
    //                     --TAFGI.ID_FORMULARIO_GRUPO_ITEM AS 'Id formulario grupo item',
    //                     TA.REFERENCIA AS 'Referencia',
    //                     TA.DESCRIPCION AS 'Descripcion',
    //                     TA.MARCA AS 'Marca',
    //                     TFGI.ID_FORMULARIO AS 'IdFormulario',
    //                     TFGI.ID_GRUPO AS 'IdGrupo',
    //                     TFGI.ID_ITEM AS 'IdItem',                        
    //                     TFGI.ORDEN AS 'Orden',                        
    //                     TF.NOMBRE AS 'NombreFormulario',
    //                     TF.CAPTURA_ARTICULO AS 'CapturaArticulo',
    //                     TF.CAPTURA_CADUCIDAD AS 'CapturaCaducidad',
    //                     TF.CAPTURA_DOCUMENTO AS 'CapturaDocumento',
    //                     TF.CAPTURA_ENTIDAD AS 'CapturaEntidad',
    //                     TF.CAPTURA_LOTE AS 'CapturaLote',
    //                     TF.CAPTURA_MOTIVO_CHEQUEO AS 'CapturaMotivo',
    //                     TG.NOMBRE AS 'NombreGrupo',
    //                     TG.CAPTURA_IMAGEN AS 'CapturaImagen',
    //                     TI.NOMBRE AS 'NombreItem'
    //             FROM  tbl_articulos TA                        
    //                 LEFT JOIN tbl_articulos_formularios_grupos_items TAFGI ON TAFGI.ID_ARTICULO=TA.ID
    //                 LEFT JOIN tbl_formularios_grupos_items TFGI ON TAFGI.ID_FORMULARIO_GRUPO_ITEM =TFGI.ID
    //                 LEFT JOIN tbl_formularios TF ON TFGI.ID_FORMULARIO=TF.ID
    //                 LEFT JOIN tbl_grupos TG ON TFGI.ID_GRUPO=TG.ID
    //                 LEFT JOIN tbl_items TI ON TFGI.ID_ITEM=TI.ID
    //                 WHERE TA.ID=$IdArticulo";   

	// 	$query = $db->query($sql);
		
	// 	$results = $query->getResult();
		
    //     return json_encode($results);
    // }

 
    // public function getByIdDelegacion($IdDelegacion){
    //     $db = \Config\Database::connect();
        
    //     $sql = "SELECT  TAD.ID AS 'ID',
    //                     TAD.ID_ARTICULO As 'Id_Articulo',
    //                     TAD.ID_DELEGACION AS 'Id_Delegación',
    //                     TD.DESCRIPCION As 'Delegación',
    //                     TA.REFERENCIA AS 'Referencia',
    //                     TA.DESCRIPCION AS 'Descripción',
    //                     TA.MARCA AS 'Marca'
    //             FROM tbl_articulos_delegaciones TAD
    //                 INNER JOIN tbl_delegaciones TD ON TAD.ID_DELEGACION=TD.ID
    //                 INNER JOIN tbl_articulos TA ON TAD.ID_ARTICULO=TA.ID
    //                 WHERE TAD.ID_DELEGACION=$IdDelegacion
    //                 AND ISNULL(TA.DELETED_AT)";   

        
    //     $query = $db->query($sql);
        
		
	// 	$results = $query->getResult();
		
    //     return json_encode($results);
    // }    

    public function deleteById($id)
    {
        $db = \Config\Database::connect();
        
        $sql = "UPDATE tbl_articulos
                SET DELETED_AT=NOW()
                WHERE ID=$id";

		$query = $db->query($sql);
		
		return $query->getResult();
    } 
}

