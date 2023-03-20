<?php

namespace App\Controllers;

use App\Models\SeccionModel;

class Secciones extends BaseController
{
	protected $redireccion = "secciones";
	protected $redireccionView = "mantenimiento/secciones/";

	// Ver
	public function show()
	{

		helper(['form']);
		$uri = service('uri');

		$data = [];
		$idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;
		$Model = new SeccionModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.descripcion'));
		
		$columnasDatatable = array($column1,$column2);
		$data['columns'] = $columnasDatatable;
		$seccion=session()->get('seccion');		
		$data['data'] = json_decode($Model->getAll($seccion));


		foreach ($data['data'] as $item) {
			$buttonEdit = '<form method="get" action="' . base_url() . '/' . $this->redireccion . '/edit/' . $item->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $item->ID . '" style="color:white;"  >'.lang('Translate.editar').'</button></form>';
			// $buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $item->ID . '" style="color:white;" class="btn btn-danger" >'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEdit;
			$item->btnEliminar = '';//$buttonDelete;
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

		$Model = new SeccionModel();


		$data['id'] = $id;

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			// reglas de validación
			$rules = [

				'descripcion' =>  'required|min_length[1]|max_length[50]'
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'DESCRIPCION' => $this->request->getVar('descripcion'),
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;

			} else {

				// Actualizar Seccion
				$newData = [
					'ID' => $id,
					'DESCRIPCION' => $this->request->getVar('descripcion'),
					'NOMBRE' => $this->request->getVar('nombre'),
					'DOMICILIO' => $this->request->getVar('domicilio'),
					'CPOSTAL' => $this->request->getVar('cpostal'),
					'POBLACION' => $this->request->getVar('poblacion'),
					'NUMCUENTA' => $this->request->getVar('cuenta'),
					'BIC' => $this->request->getVar('bic'),
					'IDENTIFICADOR' => $this->request->getVar('identificador')
				];

				//Guardamos
				$Model->save($newData);


				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', lang('Translate.actualizado'));

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$data['data'] = json_decode($Model->getById($id));


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
		$idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$Model = new SeccionModel();


		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			$rules = [
				'descripcion' =>  'required|min_length[1]|max_length[50]|is_unique[tbl_secciones.DESCRIPCION]'
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'DESCRIPCION' => $this->request->getVar('descripcion'),
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
				//return var_dump($data);

			} else {
				// Insertar Seccion
				$newData = [
					'DESCRIPCION' => $this->request->getVar('descripcion'),
					'NOMBRE' => $this->request->getVar('nombre'),
					'DOMICILIO' => $this->request->getVar('domicilio'),
					'CPOSTAL' => $this->request->getVar('cpostal'),
					'POBLACION' => $this->request->getVar('poblacion'),
					'NUMCUENTA' => $this->request->getVar('cuenta'),
					'BIC' => $this->request->getVar('bic'),
					'IDENTIFICADOR' => $this->request->getVar('identificador')
				];

				//Guardamos
				$Model->save($newData);

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', lang('Translate.creado'));

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$data['action'] = base_url() . '/' . $this->redireccion . '/new';
		$data['slug'] =  $this->redireccion;
		$data['migapan']=lang('Translate.'.$this->redireccion);
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
		echo view('dashboard/footer', $data);
	}
}