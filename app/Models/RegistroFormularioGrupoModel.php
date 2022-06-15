<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistroFormularioGrupoModel extends Model
{
    protected $table = 'tbl_registros_formularios_grupos';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'ID_REGISTRO',
        'ID_GRUPO',
        'IMAGEN_EJEMPLO',
        'IMAGEN_REAL',
    ];



    public function getAll()
    {
        $db = \Config\Database::connect();

        $sql = "SELECT  TRFG.ID_GRUPO AS 'Id grupo',
                        TRFG.ID_REGISTRO AS 'Id registro',
                        TRFG.IMAGEN_ETIQUETA AS 'Imagen etiqueta',
                        TG.NOMBRE AS 'Nombre grupo',
                        TG.CAPTURA_IMAGEN AS 'Capturar imagen',
                        TRF.ID_USUARIO AS 'Id usuario',
                        TU.NOMBRE AS 'Nombre usuario',
                        TU.AP1 AS 'Apellido1 usuario',
                        TU.AP2 AS 'Apellido2 usuario',
                        TU.ID_DELEGACION AS 'Id delegación',
                        TD.DESCRIPCION AS 'Nombre delegación',
                        TRF.ID_ARTICULO As 'Id articulo',                        
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción',
                        TRF.ID_FORMULARIO AS 'Id formulario',
                        TF.NOMBRE AS 'Nombre formulario',
                        TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        TF.CAPTURA_LOTE AS 'Captura lote',
                        TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                        TRF.ID_MOTIVO AS 'Id motivo',
                        TM.NOMBRE AS 'Nombre motivo',
                        TRF.FECHA AS 'Fecha',
                        TRF.LOTE AS 'Lote',
                        TRF.CADUCIDAD AS 'Caducidad',
                        TRF.DOCUMENTO AS 'Documento',
                        TRF.ENTIDAD AS 'Entidad',
                        TRF.OBSERVACIONES AS 'Observaciones'
                FROM tbl_registros_formularios_grupos TRFG
                    INNER JOIN tbl_grupos TG ON TRFG.ID_GRUPO=TG.ID
                    INNER JOIN tbl_registros_formularios TRF ON TRFG.ID_REGISTRO=TRF.ID
                    INNER JOIN tbl_usuarios TU ON TRF.ID_USUARIO=TU.ID   
                    INNER JOIN tbl_delegaciones TD ON TU.ID_DELEGACION=TD.ID
                    INNER JOIN tbl_articulos TA ON TRF.ID_ARTICULO=TA.ID                    
                    INNER JOIN tbl_formularios TF ON TRF.ID_FORMULARIO=TF.ID
                    INNER JOIN tbl_motivos TM ON TRF.ID_MOTIVO=TM.ID";


        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }

    public function getByIdRegistro($idRegistro)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT  TRFG.IMAGEN_REAL AS 'ImagenReal',
                        TRFG.ID_GRUPO AS 'IdGrupo'
                FROM tbl_registros_formularios_grupos TRFG
                WHERE TRFG.ID_REGISTRO=$idRegistro";

        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }

    public function cambiarExtensionPngToJpg()
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE tbl_registros_formularios_grupos 
        SET IMAGEN_EJEMPLO=CONCAT(LEFT(IMAGEN_EJEMPLO,INSTR(IMAGEN_EJEMPLO,'png')-1),'jpg')
        WHERE INSTR(IMAGEN_EJEMPLO,'png')<>0";

        $query = $db->query($sql);

        $query->getResult();

        $sql = "UPDATE tbl_registros_formularios_grupos 
        SET IMAGEN_REAL=CONCAT(LEFT(IMAGEN_REAL,INSTR(IMAGEN_REAL,'png')-1),'jpg')
        WHERE INSTR(IMAGEN_REAL,'png')<>0";

        $query = $db->query($sql);

        $query->getResult();

        
    }

}
