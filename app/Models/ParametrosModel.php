<?php

namespace App\Models;

use CodeIgniter\Model;

class ParametrosModel extends Model
{
    protected $table = 'tbl_parametros';

    public function getAll()
    {
        $db = \Config\Database::connect();

        $sql = "SELECT  TP.HOST_MULTI As 'multiApp',
                        TP.RUTA_IMAGICK As 'rutaImagick',
                        TP.RUTA_BAT As 'rutaBat'
                FROM tbl_parametros TP";

        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }
}