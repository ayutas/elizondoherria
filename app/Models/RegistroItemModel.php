<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistroItemModel extends Model
{
    protected $table = 'tbl_registros_items';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'ID_FORMULARIO_GRUPO_ITEM',
        'ID_REGISTRO',
        'VALOR',
        'PROBLEMA',
        'SOLUCION'
    ];

    public function getItemsRegistro($id)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT  TRI.ID_REGISTRO AS 'ID',
                        TRI.ID_FORMULARIO_GRUPO_ITEM AS 'IdItem'
                FROM tbl_registros_items TRI
                WHERE TRI.ID_REGISTRO=$id";


        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }

    public function getByRegistro($idRegistro)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT  TFGI.ID AS 'ID',
                TRI.VALOR AS 'Valor',
                IFNULL(TRI.PROBLEMA,'') AS 'Problema',
                IFNULL(TRI.SOLUCION,'') AS 'Solucion',
                TAFGI.ID_ARTICULO As 'IdArticulo',
                TFGI.ID_FORMULARIO AS 'IdFormulario',
                TFGI.ID_GRUPO AS 'IdGrupo', 
                TFGI.ORDEN AS 'Orden',
                TG.NOMBRE AS 'NombreGrupo',
                TG.CAPTURA_IMAGEN AS 'CapturaImagen',
                TI.NOMBRE AS 'NombreItem',
                IFNULL(TRFG.IMAGEN_EJEMPLO,IFNULL(TAG.IMAGEN_ETIQUETA,'')) AS 'EjemploEtiqueta',
                IFNULL(TRFG.IMAGEN_REAL,'') AS 'EtiquetaReal',
                IF(ISNULL(TRI.VALOR),0,1) AS Completado
                FROM tbl_articulos_formularios_grupos_items TAFGI                    
                INNER JOIN tbl_articulos TA ON TAFGI.ID_ARTICULO=TA.ID
                INNER JOIN tbl_formularios_grupos_items TFGI ON TAFGI.ID_FORMULARIO_GRUPO_ITEM =TFGI.ID
                INNER JOIN tbl_formularios TF ON TFGI.ID_FORMULARIO=TF.ID
                INNER JOIN tbl_grupos TG ON TFGI.ID_GRUPO=TG.ID
                INNER JOIN tbl_items TI ON TFGI.ID_ITEM=TI.ID
                LEFT JOIN tbl_articulos_grupos TAG ON TAFGI.ID_ARTICULO=TAG.ID_ARTICULO AND TG.ID=TAG.ID_GRUPO
                INNER JOIN tbl_registros_formularios TRF ON TAFGI.ID_ARTICULO=TRF.ID_ARTICULO AND TFGI.ID_FORMULARIO=TRF.ID_FORMULARIO        
                LEFT JOIN tbl_registros_items as TRI
                        ON TRF.ID=TRI.ID_REGISTRO AND TAFGI.ID_FORMULARIO_GRUPO_ITEM=TRI.ID_FORMULARIO_GRUPO_ITEM
                LEFT JOIN tbl_registros_formularios_grupos AS TRFG
                        ON TRF.ID=TRFG.ID_REGISTRO AND TG.ID=TRFG.ID_GRUPO
                WHERE TRF.ID=$idRegistro
                ORDER BY TFGI.ID_FORMULARIO,TAFGI.ID_ARTICULO,TFGI.ID_GRUPO,TFGI.ORDEN";
        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }

    public function getDatosPDFByRegistro($idRegistro)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT  TRI.VALOR AS 'Valor',
            IFNULL(TRI.PROBLEMA,'') AS 'Problema',
            IFNULL(TRI.SOLUCION,'') AS 'Solucion',   
            TFGI.ID_GRUPO AS 'IdGrupo',                 
            TG.NOMBRE AS 'NombreGrupo',                
            TI.NOMBRE AS 'NombreItem',
            IFNULL(TRFG.IMAGEN_EJEMPLO,IFNULL(TAG.IMAGEN_ETIQUETA,'')) AS 'EjemploEtiqueta',
            IFNULL(TRFG.IMAGEN_REAL,'') AS 'EtiquetaReal',
            IF(ISNULL(TRI.VALOR),0,1) AS Completado              
            FROM tbl_articulos_formularios_grupos_items TAFGI   
            INNER JOIN tbl_formularios_grupos_items TFGI ON TAFGI.ID_FORMULARIO_GRUPO_ITEM =TFGI.ID
            INNER JOIN tbl_grupos TG ON TFGI.ID_GRUPO=TG.ID
            INNER JOIN tbl_items TI ON TFGI.ID_ITEM=TI.ID
            LEFT JOIN tbl_articulos_grupos TAG ON TAFGI.ID_ARTICULO=TAG.ID_ARTICULO AND TG.ID=TAG.ID_GRUPO
            INNER JOIN tbl_registros_formularios TRF ON TAFGI.ID_ARTICULO=TRF.ID_ARTICULO AND TFGI.ID_FORMULARIO=TRF.ID_FORMULARIO        
            LEFT JOIN tbl_registros_items as TRI
                    ON TRF.ID=TRI.ID_REGISTRO AND TAFGI.ID_FORMULARIO_GRUPO_ITEM=TRI.ID_FORMULARIO_GRUPO_ITEM
            LEFT JOIN tbl_registros_formularios_grupos AS TRFG
                    ON TRF.ID=TRFG.ID_REGISTRO AND TG.ID=TRFG.ID_GRUPO
                WHERE TRF.ID=$idRegistro
                ORDER BY TFGI.ID_FORMULARIO,TAFGI.ID_ARTICULO,TFGI.ID_GRUPO,TFGI.ORDEN";
        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }






    public function deleteItemsChequeoFormularioGrupo($idRegistro, $idFormulario, $idGrupo)
    {
        $db = \Config\Database::connect();

        $sql = "DELETE TRI.* FROM tbl_registros_items TRI
                INNER JOIN tbl_formularios_grupos_items TFGI
                ON TRI.ID_FORMULARIO_GRUPO_ITEM=TFGI.ID
                WHERE TRI.ID_REGISTRO=$idRegistro
                AND TFGI.ID_FORMULARIO=$idFormulario
                AND TFGI.ID_GRUPO=$idGrupo";

        $query = $db->query($sql);

        return $query->getResult();
    }
}