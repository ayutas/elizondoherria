<?php namespace App\Controllers;

use App\Models\RegistroFormularioModel;
use App\Models\SeccionUsuarioModel;

class Dashboard extends BaseController
{
	public function index()
	{
        $idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;
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
        $idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;
        echo view("dashboard/header",$data);
        echo view("dashboard/tablas");
        echo view("dashboard/footer");
    }


    
	//--------------------------------------------------------------------

}
