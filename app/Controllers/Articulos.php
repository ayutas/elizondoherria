<?php

namespace App\Controllers;

use App\Models\ArticuloModel;
use App\Models\ArticuloClienteModel;
use App\Models\CategoriaModel;

class Articulos extends BaseController
{
	protected $redireccion = "articulos";
	protected $redireccionView = "mantenimiento/articulos";

	// Ver
	public function show()
	{
		helper(['form']);
		$uri = service('uri');

		$data = [];
		$idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;
		$model = new ArticuloModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.descripcion'));
		$column3= array ('Field'=>lang('Translate.numero'));
		$column4= array ('Field'=>lang('Translate.letra'));
		$column5= array ('Field'=>lang('Translate.categoria'));
		$column6= array ('Field'=>lang('Translate.precio'));
		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6);
		$data['columns'] = $columnasDatatable;
		$seccion=session()->get('seccion');
		$data['data'] = json_decode($model->getAll($seccion));
		foreach ($data['data'] as $item) {
			$buttonEdit = '<form method="get" action="' . base_url() . '/' . $this->redireccion . '/edit/' . $item->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $item->ID . '" style="color:white;"  >'.lang('Translate.editar').'</button></form>';
			$buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $item->ID . '" style="color:white;" class="btn btn-danger" >'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEdit;
			$item->btnEliminar = $buttonDelete;
		}
		// Cargamos las vistas en orden
		$data['action'] =  base_url() . '/' . $this->redireccion . '/new';
		$data['migapan']=lang('Translate.'.$this->redireccion);
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/show', $data);
		echo view('dashboard/footer', $data);
	}

	public function edit($id = "")
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];
        $idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');
		// $modelPerm = new PermsModel();
		// $roleModel = new RoleModel();
		$model = new ArticuloModel();

		//$perm = $modelPerm->getPerms(session()->get('role'),$uri->getSegment(1));
		$data['id'] = $id;



		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {


			if ($id != "") {
				// reglas de validación
				$rules = [
					'descripcion' =>  'required',
					// 'numero' =>  'required',
					'categoria' => 'required|numeric|greater_than[0]'
				];
			} else {
				// reglas de validación
				$rules = [
					'descripcion' =>  'required',
					// 'numero' =>  'required',
					'categoria' => 'required|numeric|greater_than[0]'
				];
			}

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'DESCRIPCION' => $this->request->getVar('descripcion'),
					'NUMERO' => $this->request->getVar('numero'),
					'LETRA' => $this->request->getVar('letra'),
					'CATEGORIA_ID' => $this->request->getVar('categoria')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;

			} else {

				$seccion=session()->get('seccion');
				if ($id != "") {
					
					// Acutlizar articulo
					$newData = [
						'ID' => $id,
						'NUMERO' => $this->request->getVar('numero'),
						'DESCRIPCION' => $this->request->getVar('descripcion'),
						'LETRA' => $this->request->getVar('letra'),
						'CATEGORIA_ID' => $this->request->getVar('categoria'),						
						'SECCION_ID' => $seccion,
						'DISPONIBLE' => $this->request->getVar('disponible')
					];
					
					//Guardamos
					$model->save($newData);
					$mensaje=lang('Translate.actualizado');
				} else {
					$newData = [						
						'DESCRIPCION' => $this->request->getVar('descripcion'),
						'NUMERO' => $this->request->getVar('numero'),
						'LETRA' => $this->request->getVar('letra'),
						'CATEGORIA_ID' => $this->request->getVar('categoria'),
						'SECCION_ID' => $seccion,
						'DISPONIBLE' => $this->request->getVar('disponible')
					];
					$id = $model->insert($newData);
					$mensaje=lang('Translate.creado');
				}

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', $mensaje);

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . '/' . $this->redireccion . '/show');
			}
		}

		$categoriaModel = new CategoriaModel();
		$seccion=session()->get('seccion');
		$data['categorias'] = json_decode($categoriaModel->getAll($seccion));

		if ($id != "") {
			$articuloClienteModel=new ArticuloClienteModel();
			// $clienteAsignado=json_decode($articuloClienteModel->getClienteAsignado($id));
			// return var_dump($clienteAsignado);

			$data['clienteAsignado']=json_decode($articuloClienteModel->getClienteAsignado($id));
			// $data['clienteAsignado'][0]=array_push(json_encode($data['clienteAsignado'][0]), ['link'=>'prueba']);

			// return var_dump($data['clienteAsignado'][0]);
			// if (isset($data['clienteAsignado'][0])){
			// 	$data['clienteAsignado']=['link'=>base_url() . "/clientes/edit/".$data['clienteAsignado'][0]->ID];
				// return var_dump($data['clienteAsignado'][0]);
			// }
			// return var_dump($data);
			$data['data'] = json_decode($model->getById($id));
			$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;
		} else {
			$data['action'] = base_url() . '/' . $this->redireccion . '/edit';
		}
		$data['slug'] = $this->redireccion;
		$data['migapan']=lang('Translate.'.$this->redireccion);
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
		echo view('dashboard/footer', $data);
	}

	// Borrar
	public function delete($id)
	{

		$model = new ArticuloModel();
		$answer = $model->deleteById($id);
		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', lang('Translate.eliminado'));

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . '/' . $this->redireccion . '/show');
	}

}