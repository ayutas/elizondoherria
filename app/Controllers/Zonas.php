<?php

namespace App\Controllers;

use App\Models\ZonaModel;

class Zonas extends BaseController
{
	protected $redireccion = "zonas";
	protected $redireccionView = "mantenimiento/zonas/";

	// Ver
	public function show()
	{

		helper(['form']);
		$uri = service('uri');

		$data = [];
		$idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;
		$data['admin']=session()->get('admin');
		$Model = new ZonaModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.descripcion'));
		// $column3= array ('Field'=>lang('Translate.precio'));
		
		$columnasDatatable = array($column1,$column2); //,$column3);
		$data['columns'] = $columnasDatatable;
		$seccion=session()->get('seccion');		
		$data['data'] = json_decode($Model->getAll($seccion));

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
		$data['admin']=session()->get('admin');

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$Model = new ZonaModel();


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

				// Actualizar categoria
				$newData = [
					'ID' => $id,
					'DESCRIPCION' => $this->request->getVar('descripcion'),
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
		$data['admin']=session()->get('admin');

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$Model = new ZonaModel();


		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			$rules = [
				'descripcion' =>  'required|min_length[1]|max_length[50]|is_unique[tbl_zonas.DESCRIPCION]'
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

				$seccion=session()->get('seccion');
				// Insertar categoria
				$newData = [
					'DESCRIPCION' => $this->request->getVar('descripcion'),
					'SECCION_ID' => $seccion
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

	// Borrar
	public function delete($id)
	{
		$Model = new ZonaModel();

		$answer = $Model->deleteById($id);

		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', lang('Translate.eliminado'));

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}
}