<?php

namespace App\Controllers;

use App\Models\ArticuloClienteModel;
use App\Models\ClienteModel;
use App\Models\BancoModel;

class Clientes extends BaseController
{
	protected $redireccion = "clientes";
	protected $redireccionView = "mantenimiento/clientes";

	// Ver
	public function show()
	{

		helper(['form']);
		$uri = service('uri');

		$data = [];
		$ClienteModel = new ClienteModel();
		$articulosClientesModel = new ArticuloClienteModel();

		// $data['columnsArticulos'] = json_decode($articulosClientesModel->getAll());
		// $data['dataArticulos'] = json_decode($articulosClientesModel->getAll());

		$data['columnsclientes'] = json_decode($ClienteModel->getAll());
		$data['dataclientes'] = json_decode($ClienteModel->getAll());

		foreach ($data['dataclientes'] as $item) {
			$buttonEditCliente = '<form method="get" action="' . base_url() . '/' . $this->redireccion . '/edit/' . $item->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $item->ID . '" style="color:white;"  >Editar</button></form>';
			$buttonDeleteCliente = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $item->ID . '" style="color:white;" class="btn btn-danger" >Eliminar</button>';
			$item->btnEditar = $buttonEditCliente;
			$item->btnEliminar = $buttonDeleteCliente;
		}

		// foreach ($data['dataArticulos'] as $itemLinea) {
		// 	$buttonEdit = '<form method="get" action="' . base_url() . '/clientesLineas/edit/' . $itemLinea->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $itemLinea->ID . '" style="color:white;"  >Editar</button></form>';
		// 	$buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $itemLinea->ID . '" style="color:white;" class="btn btn-danger" >Eliminar</button>';
		// 	$itemLinea->btnEditar = $buttonEdit;
		// 	$itemLinea->btnEliminar = $buttonDelete;
		// }

		// Cargamos las vistas en orden
		$data['action'] = base_url() . '/' . $this->redireccion . '/new';
		// $data['actionLineas'] = base_url() . '/clientesLineas/new';
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

		$ClienteModel = new ClienteModel();


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

				'descripcion' =>  'required|min_length[3]|max_length[150]'
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'DESCRIPCION' => $this->request->getVar('descripcion')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
				//return var_dump($data);

			} else {

				// Acutlizar delegacion
				$newData = [
					'ID' => $id,
					'DESCRIPCION' => $this->request->getVar('descripcion')
				];

				//Guardamos
				$ClienteModel->save($newData);


				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Actualizado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$data['data'] = json_decode($ClienteModel->getAll($id));
		$articulosClientesModel = new ArticuloClienteModel();

		$data['columnsArticulos'] = json_decode($articulosClientesModel->getByCliente($id));
		$data['dataArticulos'] = json_decode($articulosClientesModel->getByCliente($id));

		$data['columnsArticulosDisponibles'] = json_decode($articulosClientesModel->getArticulosDisponibles());
		$data['dataArticulosDisponibles'] = json_decode($articulosClientesModel->getArticulosDisponibles());

		$BancoModel = new BancoModel();
		$data['bancos']=json_decode($BancoModel->getAll());

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

		$ClienteModel = new ClienteModel();

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			$rules = [
				'descripcion' =>  'required|min_length[3]|max_length[150]|is_unique[tbl_clientes.DESCRIPCION]'
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'DESCRIPCION' => $this->request->getVar('descripcion')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
				//return var_dump($data);

			} else {

				// Acutlizar delegacion
				$newData = [
					'DESCRIPCION' => $this->request->getVar('descripcion')
				];

				//return var_dump($newData);
				//Guardamos
				$ClienteModel->save($newData);

				//return var_dump($ClienteModel);


				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Creado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}
		$BancoModel = new BancoModel();
		$data['bancos']=json_decode($BancoModel->getAll());

		
		$column1= array ('Field'=>'Número');
        $column2= array ('Field'=>'Letra');
        $column3= array ('Field'=>'Categoría');
        $column4= array ('Field'=>'Precio');

        $columnasDatatable = array($column1,$column2,$column3,$column4);
		$data['columnsArticulosDisponibles'] = $columnasDatatable;
		$articulosClientesModel = new ArticuloClienteModel();
		$data['articulosDisponibles'] = json_decode($articulosClientesModel->getArticulosDisponibles());


		$data['action'] = base_url() . '/' . $this->redireccion . '/new';		
		$data['slug'] = $this->redireccion;

		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
		echo view('dashboard/footer', $data);
	}

	// Borrar
	public function delete($id)
	{

		$ClienteModel = new ClienteModel();

		$answer = $ClienteModel->deleteById($id);

		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', 'Eliminado correctamente');

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" .  $this->redireccion . '/show');
	}
}