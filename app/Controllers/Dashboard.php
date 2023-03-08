<?php namespace App\Controllers;

use App\Models\RegistroFormularioModel;
use App\Models\SeccionUsuarioModel;

class Dashboard extends BaseController
{
	public function index()
	{
        $usuarioId=session()->get('id');
        //Cargamos las secciones a las que tiene acceso el usuario
        $modelSeccionUsuario = new SeccionUsuarioModel();
        $data['seccionesUsuario']=json_decode($modelSeccionUsuario->getSeccionesByUsuario($usuarioId));
        echo view("dashboard/header",$data);
        echo view("dashboard/admin");
        echo view("dashboard/footer");
    }
        
    public function tablas()
    {
        echo view("dashboard/header");        
        echo view("dashboard/tablas");
        echo view("dashboard/footer");
    }


    
	//--------------------------------------------------------------------

}
