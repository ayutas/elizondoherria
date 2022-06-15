<?php namespace App\Controllers;

use App\Models\RegistroFormularioModel;

class Dashboard extends BaseController
{
	public function index()
	{
        echo view("dashboard/header");
        if(session()->get('admin')==1)
        {            
            echo view("dashboard/admin");
        }
        else
        {
            echo view("dashboard/chequeo");
        }
        echo view("dashboard/footer");
    }
    
    public function chequeo()
    {
        $ModelRegistroFormulario= new RegistroFormularioModel();
        $data['columns']= json_decode($ModelRegistroFormulario->getUltimosChequeos());		
        $data['data']= json_decode($ModelRegistroFormulario->getUltimosChequeos());		
        foreach($data['data'] as $item){
            if($item->Situacion!=1)
            {
                $buttonEdit = '<form method="get" action="'.base_url().'/ChequeoRecepcion/edit/'.$item->ID.'"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="'.$item->ID.'" style="color:white;"  >Editar</button></form>';
                $item->btnEditar=$buttonEdit;
            }
            else
            {
                $item->btnEditar="";
            }
            $buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="'.$item->ID.'" style="color:white;" class="btn btn-danger" >Eliminar</button>';
            
            $item->btnEliminar="";
		}
        
        echo view("dashboard/header");        
        echo view("dashboard/chequeo",$data);
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
