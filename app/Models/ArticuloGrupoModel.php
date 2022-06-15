<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloGrupoModel extends Model
{
    protected $table = 'tbl_articulos_grupos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [ 
        'ID_ARTICULO',
        'ID_GRUPO',   
        'IMAGEN_ETIQUETA',         
    ];

    public function getByArticulo($idArticulo){
        $db = \Config\Database::connect();
        
        $sql = "SELECT  TAG.ID_ARTICULO As 'Id_articulo',
                        TAG.ID_GRUPO AS 'Id_grupo',
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción',                        
                        TG.NOMBRE AS 'Nombre_grupo',
                        TAG.IMAGEN_ETIQUETA AS 'Imagen',
                        false AS 'redirect'
                FROM tbl_articulos_grupos TAG                    
                    INNER JOIN tbl_articulos TA ON TAG.ID_ARTICULO=TA.ID                    
                    INNER JOIN tbl_grupos TG ON TAG.ID_GRUPO=TG.ID
                WHERE TAG.ID_ARTICULO=$idArticulo";        

		$query = $db->query($sql);
		
		$results = $query->getResult();
		
        return json_encode($results);
    }

    public function getGruposArt($IdArticulo){
        $db = \Config\Database::connect();
        
        $sql = "SELECT DISTINCT TG.ID AS 'IdGrupo',
                                TG.NOMBRE AS 'NombreGrupo',
                                TAG.IMAGEN_ETIQUETA AS 'Imagen',
                                false AS 'redirect'
                FROM tbl_articulos_formularios_grupos_items TAFGI                                   
                    INNER JOIN tbl_formularios_grupos_items TFGI ON TAFGI.ID_FORMULARIO_GRUPO_ITEM =TFGI.ID                    
                    INNER JOIN tbl_grupos TG ON TFGI.ID_GRUPO=TG.ID
                    LEFT JOIN tbl_articulos_grupos TAG ON TAFGI.ID_ARTICULO=TAG.ID_ARTICULO AND TG.ID=TAG.ID_GRUPO
                    WHERE TAFGI.ID_ARTICULO=$IdArticulo AND ISNULL(TFGI.DELETED_AT)";

        $query = $db->query($sql);
        
        $results = $query->getResult();
        
        return json_encode($results);
    }
   
}

