<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\DelegacionModel;
use App\Models\ParametrosModel;

class Login extends BaseController
{
	// Pantalla y sistema de inicio de sesión
	public function index()
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			// reglas de validación
			$rules = [
				'email' => 'required|min_length[3]|max_length[100]',
				'password' => 'required|max_length[255]|validateUser[email,password]'
			];

			//  Errores a mostrar
			$errors = [
				'password' => [
					'validateUser' => 'Usuario y/o contraseña incorrectos'
				]
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules, $errors)) {

				// Guardamos el error para mostrar en la vista
				$data['validacion'] = $this->validator;
			} else {
				//Guardar en BBDD
				$model = new UsuarioModel();

				//Pedimos los datos de ese usuario
				$user = $model->where('USUARIO', $this->request->getVar('email'))
					->first();


				//Asignamos el usuario a la sesión
				$this->setUserSession($user);

				// Redireccionamos a la pagina de login
				return redirect()->to(base_url() . '/dashboard');
			}
		}

		// Cargamos las vistas en orden
		echo view('plantilla/login/header', $data);
		echo view('plantilla/login/login', $data);
		echo view('plantilla/login/footer', $data);
	}

	//Guardar datos de usuario en la sesión
	private function setUserSession($user)
	{
		

		$data = [
			'id' => $user['ID'],
			'admin' => $user['ADMINISTRADOR'],
			'email' => $user['USUARIO'],
			'nombre' => $user['NOMBRE'],
			'ap1' => $user['AP1'],
			'ap2' => $user['AP2'],
			'isLoggedIn' => true,
		];

		session()->set($data);
	}

	// Función para registrarse
	public function register()
	{

		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {
			// reglas de validación
			$rules = [
				'name' => 'required|min_length[3]|max_length[100]',
				'lastname' => 'required|min_length[3]|max_length[100]',
				'email' => 'required|min_length[6]|max_length[100]|is_unique[tbl_usuarios.email]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]'
			];
			// Comprobación de las validaciones
			if (!$this->validate($rules)) {
				$newData = [
					'name' => $this->request->getVar('name'),
					'lastname' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password')
				];
				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
			} else {
				//Guardar en BBDD
				$model = new UsuarioModel();

				$newData = [
					'nombre' => $this->request->getVar('name'),
					'apellido1' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email'),
					'contrasena' => $this->request->getVar('password')
				];

				//Guardamos
				$model->save($newData);

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Registrado correctamente');

				// Redireccionamos a la pagina de login
				return redirect()->to('/');
			}
		}

		// Cargamos las vistas de registro en orden
		echo view('plantilla/login/header', $data);
		echo view('plantilla/login/register', $data);
		echo view('plantilla/login/footer', $data);
	}

	// Carga y procesamiento de datos del perfil de usuario
	public function profile()
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$model = new UsuarioModel();

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {
			// reglas de validación
			$rules = [
				'name' => 'required|min_length[3]|max_length[100]',
				'lastname' => 'required|min_length[3]|max_length[100]'
			];

			if ($this->request->getPost('password') != '') {
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'name' => $this->request->getVar('name'),
					'lastname' => $this->request->getVar('lastname')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
			} else {

				$newData = [
					'id' => session()->get('id'),
					'name' => $this->request->getPost('name'),
					'lastname' => $this->request->getPost('lastname')
				];

				if ($this->request->getPost('password') != '') {
					$newData['password'] = $this->request->getPost('password');
				}

				//Guardamos
				$model->save($newData);

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Actualizado correctamente');

				// Redireccionamos a la pagina de login
				return redirect()->to('/profile');
			}
		}

		$data['user'] = $model->where('id', session()->get('id'))
			->first();

		// Cargamos las vistas de registro en orden
		echo view('plantilla/dashboard/header', $data);
		echo view('plantilla/user/profile', $data);
		echo view('plantilla/dashboard/footer', $data);
	}

	// Sistema de desconexión
	public function logout()
	{
		session()->destroy();
		return redirect()->to(base_url() . "/");
	}
}