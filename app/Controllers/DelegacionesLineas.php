<?php

namespace App\Controllers;

use App\Models\DelegacionLineaModel;
use App\Models\DelegacionModel;

class DelegacionesLineas extends BaseController
{
	protected $redireccion = "delegacionesLineas";
	protected $redireccionView = "mantenimiento/delegacionesLineas";

	public function edit($id = "")
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$delegacionLineasModel = new DelegacionLineaModel();


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
				'id_delegacion' =>  'required',
				'linea' =>  'required',
				'nombre' =>  'required|min_length[3]|max_length[100]'
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'ID_DELEGACION' => $this->request->getVar('id_delegacion'),
					'LINEA' => $this->request->getVar('linea'),
					'DESCRIPCION' => $this->request->getVar('nombre')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
				//return var_dump($data);

			} else {

				// Acutlizar delegacion
				$newData = [
					'ID' => $id,
					'ID_DELEGACION' => $this->request->getVar('id_delegacion'),
					'LINEA' => $this->request->getVar('linea'),
					'DESCRIPCION' => $this->request->getVar('nombre')
				];

				//Guardamos
				$delegacionLineasModel->save($newData);


				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Actualizado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}
		$delegacionModel = new DelegacionModel();
		$data['delegaciones'] = json_decode($delegacionModel->getAll());

		$data['data'] = json_decode($delegacionLineasModel->getData($id));

		$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;
		$data['slug'] = $this->redireccion;
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
		//return var_dump('por lineas');
		$delegacionLineasModel = new delegacionLineaModel();


		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			$rules = [
				'id_delegacion' =>  'required',
				'linea' =>  'required',
				'nombre' =>  'required|min_length[3]|max_length[150]'
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'ID_DELEGACION' => $this->request->getVar('id_delegacion'),
					'LINEA' => $this->request->getVar('linea'),
					'DESCRIPCION' => $this->request->getVar('nombre')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
				//return var_dump($data);

			} else {

				// Acutlizar delegacion
				$newData = [
					'ID_DELEGACION' => $this->request->getVar('id_delegacion'),
					'LINEA' => $this->request->getVar('linea'),
					'DESCRIPCION' => $this->request->getVar('nombre')
				];

				//return var_dump($newData);
				//Guardamos
				$delegacionLineasModel->save($newData);

				//return var_dump($delegacionModel);


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

		$delegacionLineasModel = new DelegacionLineaModel();

		$answer = $delegacionLineasModel->deleteById($id);

		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', 'Eliminado correctamente');

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}
}