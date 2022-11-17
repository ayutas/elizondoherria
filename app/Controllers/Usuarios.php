<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\DelegacionModel;

class Usuarios extends BaseController
{
	protected $redireccion = "usuarios";
	protected $redireccionView = "mantenimiento/usuarios";

	// Ver
	public function show()
	{

		helper(['form']);
		$uri = service('uri');

		$data = [];
		$model = new UsuarioModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>'Nombre');
		$column3= array ('Field'=>'Apellido1');
		$column4= array ('Field'=>'Apellido2');
		$column5= array ('Field'=>'Admin');
		$column6= array ('Field'=>'Usuario');
		$column7= array ('Field'=>'Creado');
		$column8= array ('Field'=>'Actualizado');
		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8);
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

		$model = new UsuarioModel();

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			$rules = [
				'nombre' =>  'required|min_length[3]|max_length[100]',
				'usuario' =>  'required|min_length[3]|max_length[100]|is_unique[tbl_usuarios.USUARIO]',
				'contrasena' =>  'required|min_length[3]|max_length[100]',
				'id_delegacion' =>  'required' //|nonzero',
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
				//return var_dump($data);

			} else {
				if ($this->request->getVar('admin') == null) {
					$admin = 0;
				} else {
					$admin = 1;
				}
				// Acutlizar usuario
				$newData = [
					'NOMBRE' => $this->request->getVar('nombre'),
					'AP1' => $this->request->getVar('apellido1'),
					'AP2' => $this->request->getVar('apellido2'),
					'ID_DELEGACION' => $this->request->getVar('id_delegacion'),
					'ADMINISTRADOR' => $admin,
					'USUARIO' => $this->request->getVar('usuario'),
					'CONTRASENA' => $this->request->getVar('contrasena')
				];

				//return var_dump($newData);
				//Guardamos
				$model->save($newData);
				//return var_dump($model);

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Creado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$delegacionModel = new DelegacionModel();
		$data['delegaciones'] = json_decode($delegacionModel->getAll());

		$data['action'] = base_url() . '/' . $this->redireccion . '/new';
		$data['slug'] = $this->redireccion;

		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
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
}