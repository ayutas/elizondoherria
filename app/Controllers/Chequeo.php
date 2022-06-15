<?php namespace App\Controllers;

class Chequeo extends BaseController
{

         
	public function recepcionProveedor()
    {          
        echo view('dashboard/header');   
        echo view("chequeo/recepcion");
        echo view("dashboard/footer");
    }
    
    public function verificacionIniFin()
    {
        echo view("dashboard/header");        
        echo view("chequeo/iniciofin");
        echo view("dashboard/footer");
    }
    
    public function revisionHoraria()
    {
        echo view("dashboard/header");        
        echo view("chequeo/revhoraria");
        echo view("dashboard/footer");
	}

	//--------------------------------------------------------------------

}
