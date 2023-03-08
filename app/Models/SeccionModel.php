<?php namespace App\Models;

use CodeIgniter\Model;

class SeccionModel extends Model
{
    protected $table = 'tbl_secciones';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'DESCRIPCION',
        'NOMBRE',
        'DOMICILIO',
        'CPOSTAL',
        'POBLACION',        
        'NUMCUENTA',
        'BIC',
        'IDENTIFICADOR'
    ];
   
}

