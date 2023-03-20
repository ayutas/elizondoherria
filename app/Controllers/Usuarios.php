<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\SeccionModel;
use App\Models\SeccionUsuarioModel;

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
		$idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;
		$model = new UsuarioModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.nombre'));
		$column3= array ('Field'=>lang('Translate.apellido1'));
		$column4= array ('Field'=>lang('Translate.apellido2'));
		$column5= array ('Field'=>lang('Translate.usuario'));
		$column6= array ('Field'=>lang('Translate.created'));
		$column7= array ('Field'=>lang('Translate.updated'));
		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7);
		$data['columns'] = $columnasDatatable;
		$data['data'] = json_decode($model->getAll());

		foreach ($data['data'] as $item) {
			$buttonEdit = '<form method="get" action="' . base_url() . '/' . $this->redireccion . '/edit/' . $item->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $item->ID . '" style="color:white;"  >'.lang('Translate.editar').'</button></form>';
			$buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $item->ID . '" style="color:white;" class="btn btn-danger" >'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEdit;
			$item->btnEliminar = $buttonDelete;
		}

		// Cargamos las vistas en orden
		$data['action'] = base_url() . '/' . $this->redireccion . '/new';
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

		$model = new UsuarioModel();

		$data['id'] = $id;

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
						'USUARIO' => $this->request->getVar('usuario'),
						'CONTRASENA' => $this->request->getVar('contrasena')

					];
				} else {
					$newData = [
						'ID' => $id,
						'NOMBRE' => $this->request->getVar('nombre'),
						'AP1' => $this->request->getVar('apellido1'),
						'AP2' => $this->request->getVar('apellido2'),
						'USUARIO' => $this->request->getVar('usuario'),
					];
				}

				//Guardamos
				$model->save($newData);

				//SECCIONES USUARIO
				$seccionUsuarioModel = new SeccionUsuarioModel();
				$seccionUsuarioModel->where('USUARIO_ID', $id)->delete();
				foreach ($this->request->getVar('seccion') as $seccion) {
					$newData = [
						'USUARIO_ID' => $id,
						'SECCION_ID' => $seccion,
					];
					$seccionUsuarioModel->insert($newData);
				}				

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success',  lang('Translate.actualizado'));

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$data['data'] = json_decode($model->getById($id));

		$seccionModel = new SeccionModel();
		$data['secciones'] = json_decode($seccionModel->getAll());
		
		$seccionUsuarioModel = new SeccionUsuarioModel();
		$seccionesUsuario = json_decode($seccionUsuarioModel->getSeccionesByUsuario($id));
		$data['seccionesUsuario'] = $seccionesUsuario;

		$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;
		$data['slug'] =  $this->redireccion;
		$data['migapan']=lang('Translate.'.$this->redireccion);
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
		echo view('dashboard/footer', $data);
	}

	public function new()
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		$idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;
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
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'NOMBRE' => $this->request->getVar('nombre'),
					'AP1' => $this->request->getVar('apellido1'),
					'AP2' => $this->request->getVar('apellido2'),
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
					'USUARIO' => $this->request->getVar('usuario'),
					'CONTRASENA' => $this->request->getVar('contrasena')
				];

				//Guardamos
				$id=$model->insert($newData);

				//SECCIONES USUARIO
				$seccionUsuarioModel = new SeccionUsuarioModel();
				foreach ($this->request->getVar('seccion') as $seccion) {
					$newData = [
						'USUARIO_ID' => $id,
						'SECCION_ID' => $seccion,
					];
					$seccionUsuarioModel->insert($newData);
				}


				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success',  lang('Translate.creado'));

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$seccionModel = new SeccionModel();
		$data['secciones'] = json_decode($seccionModel->getAll());

		$data['action'] = base_url() . '/' . $this->redireccion . '/new';
		$data['slug'] = $this->redireccion;
		$data['migapan']=lang('Translate.'.$this->redireccion);
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
		$session->setFlashdata('success',  lang('Translate.eliminado'));

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}
}