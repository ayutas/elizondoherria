<?php

namespace App\Controllers;

use App\Models\ReciboModel;
use App\Models\ArticuloClienteModel;

class Recibos extends BaseController
{
	protected $redireccion = "recibos";
	protected $redireccionView = "recibos";

	// Ver
	public function show()
	{

		helper(['form']);
		$uri = service('uri');

		$data = [];
		$model = new ReciboModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>'Fecha');
		$column3= array ('Field'=>'Ref');
		$column4= array ('Field'=>'Nombre');
		$column5= array ('Field'=>'DNI');
		$column6= array ('Field'=>'Número');
		$column7= array ('Field'=>'Categoría');
		$column8= array ('Field'=>'Importe');
		$column9= array ('Field'=>'Cuenta');
		$column10= array ('Field'=>'Cobrado');		
		$column11= array ('Field'=>'Creado');
		$column12= array ('Field'=>'Actualizado');
		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9,$column10,$column11,$column12);
		$data['columns'] = $columnasDatatable;
		$data['data'] = json_decode($model->getAll());

		foreach ($data['data'] as $item) {
			$buttonEdit = '<form method="get" action="' . base_url() . '/' . $this->redireccion . '/edit/' . $item->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $item->ID . '" style="color:white;"  >Editar</button></form>';
			$buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $item->ID . '" style="color:white;" class="btn btn-danger" >Eliminar</button>';
			$item->btnEditar = $buttonEdit;
			$item->btnEliminar = $buttonDelete;
		}

		// Cargamos las vistas en orden
		$data['action'] = base_url() . '/' . $this->redireccion . '/new';
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/show', $data);
		echo view('dashboard/footer', $data);
	}

	public function edit($id = "")
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$model = new UsuarioModel();

		$data['id'] = $id;


		if ($id == "") {

			if ($id == "") {
				// Creamos una session para mostrar el mensaje de denegación por permiso
				$session = session();
				$session->setFlashdata('error', 'No se ha seleccionado ningun elemento para editar');

				// Redireccionamos a la pagina de login
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			// reglas de validación
			$rules = [

				'nombre' =>  'required|min_length[3]|max_length[100]',
				'usuario' =>  'required|min_length[3]|max_length[100]',
				// 'contrasena' =>  'required|min_length[3]|max_length[100]',
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'NOMBRE' => $this->request->getVar('nombre'),
					'AP1' => $this->request->getVar('apellido1'),
					'AP2' => $this->request->getVar('apellido2'),
					'ID_DELEGACION' => $this->request->getVar('id_delegacion'),
					'ADMINISTRADOR' => $this->request->getVar('admin'),
					'USUARIO' => $this->request->getVar('usuario'),
					'CONTRASENA' => $this->request->getVar('contrasena')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;

			} else {

				if ($this->request->getVar('admin') == null) {
					$admin = 0;
				} else {
					$admin = 1;
				}
				if ($this->request->getVar('contrasena') != "") {
					// Acutlizar usuario
					$newData = [
						'ID' => $id,
						'NOMBRE' => $this->request->getVar('nombre'),
						'AP1' => $this->request->getVar('apellido1'),
						'AP2' => $this->request->getVar('apellido2'),
						'ADMINISTRADOR' => $admin,
						'USUARIO' => $this->request->getVar('usuario'),
						'CONTRASENA' => $this->request->getVar('contrasena')

					];
				} else {
					$newData = [
						'ID' => $id,
						'NOMBRE' => $this->request->getVar('nombre'),
						'AP1' => $this->request->getVar('apellido1'),
						'AP2' => $this->request->getVar('apellido2'),
						'ADMINISTRADOR' => $admin,
						'USUARIO' => $this->request->getVar('usuario'),
					];
				}

				//Guardamos
				$model->save($newData);

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Actualizado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$data['data'] = json_decode($model->getData($id));

		$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;
		$data['slug'] =  $this->redireccion;
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
		echo view('dashboard/footer', $data);
	}

	public function new()
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$model = new ArticuloClienteModel();
		
		$column1= array ('Field'=>'');
		$column2= array ('Field'=>'');
		$column3= array ('Field'=>'ID');
		$column4= array ('Field'=>'Nombre');
		$column5= array ('Field'=>'DNI');
		$column6= array ('Field'=>'Número');
		$column7= array ('Field'=>'Categoría');
		$column8= array ('Field'=>'Importe');
		$column9= array ('Field'=>'Cuenta');

		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9);
		$data['columns'] = $columnasDatatable;
		$data['data'] = json_decode($model->getAll());



		$data['action'] = base_url() . '/' . $this->redireccion . '/new';		
		$data['slug'] = $this->redireccion;

		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/new', $data);
		echo view('dashboard/footer', $data);
	}


	// Borrar
	public function delete($id)
	{

		$model = new UsuarioModel();
		$answer = $model->deleteById($id);
		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', 'Eliminado correctamente');

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}

	public function CrearRecibos()
	{		
		$response = json_decode($this->request->getPost('data'));
		$fecha = $response->fecha;
		$ref = $response->ref;
		$ids = implode(',',$response->arrayIds);
		// return var_dump($fecha,$ref,$ids);
		$model = new ReciboModel();
		return var_dump($model->insertar($fecha,$ref,$ids));
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}
}