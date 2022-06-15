<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArticuloModel;
// use App\Models\RoleModel;
// use App\Models\MotivesiteModel;
// use App\Models\SituacionesModel;
// use App\Models\MotsitaccModel;
// use App\Models\SitaccModel;
// use App\Models\TipocontactoModel;
// use App\Models\TipodocumentoModel;
// use App\Models\GrupopertenenciaModel;
// use App\Models\RecursossocialesModel;
// use App\Models\AutonomiapersonalModel;
// use App\Models\ServiciosModel;
// use App\Models\TareasModel;
// use App\Models\ComunicacionModel;

class Api extends ResourceController
{
	use ResponseTrait;
    protected $format    = 'json';
    
    // API Usuarios
        // Coger todos 
        public function getArticulos()
        {
            $model = new ArticuloModel();
            $results = json_decode($model->getAll());
           
            //personalizamos cada elemento para añadir los botones de Editar y Eliminar
            foreach($results as $user){ 
                $buttonEdit = '<form method="get" action="'.base_url().'/user/edit/'.$user->ID.'"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="'.$user->ID.'" style="color:white;"  >Editar</button></form>';
                $buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="'.$user->ID.'" style="color:white;" class="btn btn-danger" >Eliminar</button>';
                
                $user->btnEditar = $buttonEdit;
                $user->btnEliminar = $buttonDelete;
            }
            $final = ["data" => $results];
            return $this->respond($final);
        }
    
        // Uno por id
        public function userById($id = null)
        {
            $model = new ArticuloModel();
            $data = $model->getWhere(['id' => $id])->getResult();
            if($data){
                return $this->respond($data);
            }else{
                return $this->failNotFound('No se ha encontrado ningun artículo con el id '.$id);
            }
        }

    // // API Roles
    //     // Coger todos 
    //     public function getRoles()
    //     {
    //         $model = new RoleModel();
    //         $results = json_decode($model->getAll());
           
    //         //personalizamos cada elemento para añadir los botones de Editar y Eliminar
    //         foreach($results as $item){ 
    //             $buttonEdit = '<form method="get" action="'.base_url().'/role/edit/'.$item->ID.'"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="'.$item->ID.'" style="color:white;"  >Editar</button></form>';
    //             $buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="'.$item->ID.'" style="color:white;" class="btn btn-danger" >Eliminar</button>';
                
    //             $item->btnEditar = $buttonEdit;
    //             $item->btnEliminar = $buttonDelete;
    //         }
    //         $final = ["data" => $results];
    //         return $this->respond($final);
    //     }
    
    //     // Uno por id
    //     public function roleById($id = null)
    //     {
    //         $model = new RoleModel();
    //         $data = $model->getWhere(['id' => $id])->getResult();
    //         if($data){
    //             return $this->respond($data);
    //         }else{
    //             return $this->failNotFound('No se ha encontrado ningun usuario con el id '.$id);
    //         }
    //     }


    }