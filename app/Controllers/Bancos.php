<?php

namespace App\Controllers;

use App\Models\BancoModel;

class Bancos extends BaseController
{
	protected $redireccion = "bancos";
	protected $redireccionView = "mantenimiento/bancos/";

	// Ver
	public function show()
	{

		helper(['form']);
		$uri = service('uri');

		$data = [];
		$Model = new BancoModel();

		
		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>'Código');
		$column3= array ('Field'=>'Nombre');
		$column4= array ('Field'=>'País');
		
		$columnasDatatable = array($column1,$column2,$column3,$column4);
		$data['columns'] = $columnasDatatable;
		$data['data'] = json_decode($Model->getAll());


		foreach ($data['data'] as $item) {
			$buttonEdit = '<form method="get" action="' . base_url() . '/' . $this->redireccion . '/edit/' . $item->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $item->ID . '" style="color:white;"  >Editar</button></form>';
			$buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $item->ID . '" style="color:white;" class="btn btn-danger" >Eliminar</button>';
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

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$Model = new BancoModel();


		$data['id'] = $id;


		if ($id == "") {

			if ($id == "") {
				// Creamos una session para mostrar el mensaje de denegación por permiso
				$session = session();
				$session->setFlashdata('error', 'No se ha seleccionado ningun banco para editar');

				// Redireccionamos a la pagina de login
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {
			// reglas de validación
			$rules = [

				'codigo' =>  'required|min_length[3]|max_length[6]',
				'nombre' =>  'required|min_length[3]|max_length[250]',
				'pais' =>  'required|min_length[2]|max_length[4]',
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'CODIGO' =>  $this->request->getVar('codigo'),
					'NOMBRE' => $this->request->getVar('nombre'),
					'COD_PAIS' => $this->request->getVar('pais')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;

			} else {

				// Actualizar banco
				$newData = [
					'ID' => $id,
					'CODIGO' => $this->request->getVar('codigo'),
					'NOMBRE' => $this->request->getVar('nombre'),
					'COD_PAIS' => $this->request->getVar('pais')
				];

				//Guardamos
				$Model->save($newData);


				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Actualizado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$data['data'] = json_decode($Model->getAll($id));


		$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;
		$data['slug'] = $this->redireccion;
		$data['migapan']=lang('Translate.'.$this->redireccion);
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

		$Model = new BancoModel();


		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			$rules = [
				'codigo' =>  'required|min_length[3]|max_length[6]|is_unique[tbl_bancos.CODIGO]',
				'nombre' =>  'required|min_length[3]|max_length[250]',
				'pais' =>  'required|min_length[2]|max_length[4]',
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'CODIGO' => $this->request->getVar('codigo'),
					'NOMBRE' => $this->request->getVar('nombre'),
					'COD_PAIS' => $this->request->getVar('pais')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
				//return var_dump($data);

			} else {

				// Crear banco
				$newData = [
					'CODIGO' => $this->request->getVar('codigo'),
					'NOMBRE' => $this->request->getVar('nombre'),
					'COD_PAIS' => $this->request->getVar('pais')
				];

				//Guardamos
				$Model->save($newData);

				//return var_dump($delegacionModel);


				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Creado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

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

		$Model = new BancoModel();

		$answer = $Model->deleteById($id);

		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', 'Eliminado correctamente');

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}
}