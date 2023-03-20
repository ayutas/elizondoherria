<?php

namespace App\Models;

use CodeIgniter\Model;

class ParametrosModel extends Model
{
    protected $table = 'tbl_parametros';

    public function getAll()
    {
        $db = \Config\Database::connect();

        $sql = "SELECT  TP.CARPETA_APP
                FROM tbl_parametros TP";

        $query = $db->query($sql);

        $results = $query->getResult();

        return json_encode($results);
    }
}