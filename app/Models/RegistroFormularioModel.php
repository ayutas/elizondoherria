<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistroFormularioModel extends Model
{
    protected $table = 'tbl_registros_formularios';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'FECHA',
        'ID_USUARIO',
        'ID_ARTICULO',
        'ID_FORMULARIO',
        'ID_DELEGACION_LINEA',
        'ID_MOTIVO',
        'LOTE',
        'CADUCIDAD',
        'DOCUMENTO',
        'ENTIDAD',
        'OBSERVACIONES',
        'SITUACION'
    ];


    public function getAll($idRegistro = null)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT  TRF.ID AS 'Id',                        
                        TRF.ID_USUARIO AS 'Id usuario',
                        TU.NOMBRE AS 'Usuario',
                        TU.AP1 AS 'Apellido1',
                        TU.AP2 AS 'Apellido2',
                        TDL.ID_DELEGACION AS 'Id delegación',
                        TDL.LINEA AS 'Linea',
                        TDL.DESCRIPCION AS 'NombreLinea',
                        TD.DESCRIPCION AS 'Delegacion',
                        TRF.ID_ARTICULO As 'Id articulo',
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripcion',
                        TA.MARCA AS 'Marca',
                        TRF.ID_FORMULARIO AS 'Id formulario',
                        TF.NOMBRE AS 'Formulario',
                        TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        TF.CAPTURA_LOTE AS 'Captura lote',
                        TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                        TRF.ID_MOTIVO AS 'Id motivo',
                        TM.NOMBRE AS 'NombreMotivo',
                        TRF.FECHA AS 'Fecha',
                        TRF.LOTE AS 'Lote',
                        TRF.CADUCIDAD AS 'Caducidad',
                        TRF.DOCUMENTO AS 'Documento',
                        TRF.ENTIDAD AS 'Entidad',
                        TRF.OBSERVACIONES AS 'Observaciones'
                FROM tbl_registros_formularios TRF                    
                    LEFT JOIN tbl_usuarios TU ON TRF.ID_USUARIO=TU.ID   
                    LEFT JOIN tbl_delegaciones_lineas TDL ON TRF.ID_DELEGACION_LINEA=TDL.ID
                    LEFT JOIN tbl_delegaciones TD ON TDL.ID_DELEGACION=TD.ID
                    LEFT JOIN tbl_articulos TA ON TRF.ID_ARTICULO=TA.ID                    
                    LEFT JOIN tbl_formularios TF ON TRF.ID_FORMULARIO=TF.ID
                    LEFT JOIN tbl_motivos TM ON TRF.ID_MOTIVO=TM.ID";
        if ($idRegistro) {
            $sql .= " WHERE TRF.ID=$idRegistro";
        }

        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }


    public function getUltimosChequeos()
    {
        $idUsuario = session()->get('id');
        $admin = session()->get('admin');
        $db = \Config\Database::connect();

        $sql = "SELECT  TRF.ID AS 'ID',                        
                        -- TRF.ID_USUARIO AS 'Id usuario',
                        CONCAT_WS(' ',TU.NOMBRE, TU.AP1, TU.AP2)  AS 'Nombre usuario',
                        -- TU.ID_DELEGACION AS 'Id delegación',
                        -- TD.DESCRIPCION AS 'Nombre delegación',
                        -- TRF.ID_ARTICULO As 'Id articulo',                        
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción',
                        -- TRF.ID_FORMULARIO AS 'Id formulario',
                        TF.NOMBRE AS 'Checklist',
                        -- TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        -- TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        -- TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        -- TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        -- TF.CAPTURA_LOTE AS 'Captura lote',
                        -- TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                        -- TRF.ID_MOTIVO AS 'Id motivo',
                        TM.NOMBRE AS 'Motivo',
                        TRF.FECHA AS 'Fecha',
                        -- TRF.LOTE AS 'Lote',
                        -- TRF.CADUCIDAD AS 'Caducidad',
                        -- TRF.DOCUMENTO AS 'Documento',
                        -- TRF.ENTIDAD AS 'Entidad',
                        TRF.OBSERVACIONES AS 'Observaciones',
                        TRF.SITUACION AS 'Situacion'
                FROM tbl_registros_formularios TRF                    
                    INNER JOIN tbl_usuarios TU ON TRF.ID_USUARIO=TU.ID   
                    INNER JOIN tbl_delegaciones TD ON TU.ID_DELEGACION=TD.ID
                    INNER JOIN tbl_articulos TA ON TRF.ID_ARTICULO=TA.ID                    
                    INNER JOIN tbl_formularios TF ON TRF.ID_FORMULARIO=TF.ID
                    LEFT JOIN tbl_motivos TM ON TRF.ID_MOTIVO=TM.ID
                    WHERE TRF.FECHA>=DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
        if ($admin == 0) {
            $sql .=   " AND TRF.ID_USUARIO=$idUsuario";
        }
        // return var_dump('es admin');
        $sql .=   " ORDER BY TRF.FECHA DESC";


        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }

    public function getUltimoChequeoFormularioDelegacionLinea($idFormulario, $idLinea)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT TRF.ID_ARTICULO AS IdArticulo,
                        TRF.LOTE AS 'Lote',
                        TRF.CADUCIDAD AS 'Caducidad',
                        TRF.DOCUMENTO AS 'Documento',
                        TRF.ENTIDAD AS 'Entidad'
                FROM tbl_registros_formularios TRF                                        
                WHERE TRF.ID_FORMULARIO=$idFormulario
                AND TRF.ID_DELEGACION_LINEA=$idLinea
                AND DATE(TRF.FECHA)=DATE(NOW())
                ORDER BY ID DESC
                LIMIT 1";

        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }

    public function getDatosChequeo($idRegistro)
    {
        $db = \Config\Database::connect();

        $sql = "SELECT TRF.ID,
                        TRF.ID_ARTICULO AS IdArticulo,
                        TRF.ID_FORMULARIO AS IdFormulario,
                        TRF.ID_DELEGACION_LINEA AS IdLineaDelegacion,
                        TRF.FECHA AS Fecha,
                        TRF.ID_MOTIVO AS IdMotivo,
                        TRF.LOTE AS 'Lote',
                        TRF.CADUCIDAD AS 'Caducidad',
                        TRF.DOCUMENTO AS 'Documento',
                        TRF.ENTIDAD AS 'Entidad',
                        TRF.OBSERVACIONES AS 'Observaciones'
                FROM tbl_registros_formularios TRF                                        
                WHERE TRF.ID=$idRegistro";

        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }
    public function finalizarChequeo($idRegistro)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE tbl_registros_formularios 
            SET SITUACION=1
            WHERE ID=$idRegistro";

        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }

    public function actualizarObservaciones($idRegistro, $observaciones)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE tbl_registros_formularios";
        if ($observaciones != "") {
            $sql .= " SET OBSERVACIONES='$observaciones'";
        } else {
            $sql .= " SET OBSERVACIONES=NULL";
        }
        $sql .= " WHERE ID=$idRegistro";

        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }

    public function getChequeosUltimoMes()
    {
        $idUsuario = session()->get('id');
        $admin = session()->get('admin');
        $db = \Config\Database::connect();

        $sql = "SELECT  TRF.ID AS 'ID',                        
                        -- TRF.ID_USUARIO AS 'Id usuario',
                        CONCAT_WS(' ',TU.NOMBRE, TU.AP1, TU.AP2)  AS 'Nombre usuario',
                        -- TU.ID_DELEGACION AS 'Id delegación',
                        -- TD.DESCRIPCION AS 'Nombre delegación',
                        -- TRF.ID_ARTICULO As 'Id articulo',                        
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción',
                        -- TRF.ID_FORMULARIO AS 'Id formulario',
                        TF.NOMBRE AS 'Checklist',
                        -- TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        -- TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        -- TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        -- TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        -- TF.CAPTURA_LOTE AS 'Captura lote',
                        -- TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                        -- TRF.ID_MOTIVO AS 'Id motivo',
                        TM.NOMBRE AS 'Motivo',
                        TRF.FECHA AS 'Fecha',
                        -- TRF.LOTE AS 'Lote',
                        -- TRF.CADUCIDAD AS 'Caducidad',
                        -- TRF.DOCUMENTO AS 'Documento',
                        -- TRF.ENTIDAD AS 'Entidad',
                        TRF.OBSERVACIONES AS 'Observaciones',
                        TRF.SITUACION AS 'Situacion'
                FROM tbl_registros_formularios TRF                    
                    INNER JOIN tbl_usuarios TU ON TRF.ID_USUARIO=TU.ID   
                    INNER JOIN tbl_delegaciones TD ON TU.ID_DELEGACION=TD.ID
                    INNER JOIN tbl_articulos TA ON TRF.ID_ARTICULO=TA.ID                    
                    INNER JOIN tbl_formularios TF ON TRF.ID_FORMULARIO=TF.ID
                    LEFT JOIN tbl_motivos TM ON TRF.ID_MOTIVO=TM.ID
                    WHERE TRF.FECHA>=DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
        if ($admin == 0) {
            $sql .=   " AND TRF.ID_USUARIO=$idUsuario";
        }
        // return var_dump('es admin');
        $sql .=   " ORDER BY TRF.FECHA DESC";


        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }

    public function chequeosRevisados($data)
    {
        $db = \Config\Database::connect();

        $sql = "UPDATE tbl_registros_formularios 
            SET SITUACION=2
            WHERE ID in ($data)";

        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }
}