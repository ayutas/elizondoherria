<?php

namespace App\Controllers;

use App\Models\FormularioModel;
use App\Models\GrupoModel;
use App\Models\ItemModel;
use App\Models\FormularioGrupoItemModel;

class Formularios extends BaseController
{
	protected $redireccion = "formularios";
	protected $redireccionView = "mantenimiento/formularios/";

	protected $capturarArticulo = 0;
	protected $capturarLote = 0;
	protected $capturarCaducidad = 0;
	protected $capturarDocumento = 0;
	protected $capturarEntidad = 0;
	protected $capturarMotivo = 0;
	protected $precargar = 0;


	// Ver
	public function show()
	{

		helper(['form']);
		$uri = service('uri');

		$data = [];
		$Model = new FormularioModel();

		$data['columns'] = json_decode($Model->getAll());
		$data['data'] = json_decode($Model->getAll());


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

	public function recogerDatos()
	{
		if ($this->request->getVar('articulo') != null) {
			$this->capturarArticulo = 1;
		}
		if ($this->request->getVar('lote') != null) {
			$this->capturarLote = 1;
		}
		if ($this->request->getVar('caducidad') != null) {
			$this->capturarCaducidad = 1;
		}
		if ($this->request->getVar('documento') != null) {
			$this->capturarDocumento = 1;
		}
		if ($this->request->getVar('entidad') != null) {
			$this->capturarEntidad = 1;
		}
		if ($this->request->getVar('motivo') != null) {
			$this->capturarMotivo = 1;
		}
		if ($this->request->getVar('precargar') != null) {
			$this->precargar = 1;
		}
		return;
	}

	public function edit($id = "")
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$Model = new FormularioModel();


		$data['id'] = $id;



		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			if ($id == "") {
				// reglas de validación
				$rules = [

					'nombre' =>  'required|min_length[3]|max_length[100]|is_unique[tbl_formularios.NOMBRE]'
				];
			} else {
				// reglas de validación
				$rules = [

					'nombre' =>  'required|min_length[3]|max_length[100]'
				];
			}

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {


				$newData = [
					'NOMBRE' => $this->request->getVar('nombre'),
					'CAPTURA_ARTICULO' =>  $this->request->getVar('articulo'),
					'CAPTURA_LOTE' =>  $this->request->getVar('lote'),
					'CAPTURA_CADUCIDAD' =>  $this->request->getVar('caducidad'),
					'CAPTURA_DOCUMENTO' =>  $this->request->getVar('documento'),
					'CAPTURA_ENTIDAD' =>  $this->request->getVar('entidad'),
					'CAPTURA_MOTIVO_CHEQUEO' =>  $this->request->getVar('motivo'),
					'PRECARGAR' =>  $this->request->getVar('precargar')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
				//return var_dump($data);

			} else {

				$this->recogerDatos();

				if ($id == "") {
					// Insertar formulario
					$newData = [
						'NOMBRE' => $this->request->getVar('nombre'),
						'CAPTURA_ARTICULO' => $this->capturarArticulo, //$this->request->getVar('capturarArticulo'),
						'CAPTURA_LOTE' => $this->capturarLote, //$this->request->getVar('capturarLote'),
						'CAPTURA_CADUCIDAD' => $this->capturarCaducidad, //$this->request->getVar('capturarCaducidad'),
						'CAPTURA_DOCUMENTO' =>  $this->capturarDocumento, //$this->request->getVar('capturarDocumento'),
						'CAPTURA_ENTIDAD' =>  $this->capturarEntidad, //$this->request->getVar('capturarEntidad'),
						'CAPTURA_MOTIVO_CHEQUEO' => $this->capturarMotivo, //$this->request->getVar('capturarMotivo')
						'PRECARGAR' => $this->precargar,
					];
					//Insertamos
					$id = $Model->insert($newData);
				} else {
					// Actulizar formulario
					$newData = [
						'ID' => $id,
						'NOMBRE' => $this->request->getVar('nombre'),
						'CAPTURA_ARTICULO' => $this->capturarArticulo, //$this->request->getVar('capturarArticulo'),
						'CAPTURA_LOTE' => $this->capturarLote, //$this->request->getVar('capturarLote'),
						'CAPTURA_CADUCIDAD' => $this->capturarCaducidad, //$this->request->getVar('capturarCaducidad'),
						'CAPTURA_DOCUMENTO' =>  $this->capturarDocumento, //$this->request->getVar('capturarDocumento'),
						'CAPTURA_ENTIDAD' =>  $this->capturarEntidad, //$this->request->getVar('capturarEntidad'),
						'CAPTURA_MOTIVO_CHEQUEO' => $this->capturarMotivo, //$this->request->getVar('capturarMotivo')
						'PRECARGAR' => $this->precargar,
					];
					//Guardamos
					$Model->save($newData);
				}



				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Actualizado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$ModelGupos = new GrupoModel();
		$data['grupos'] = json_decode($ModelGupos->getAll());
		$ModelItems = new ItemModel();
		$data['items'] = json_decode($ModelItems->getAll());


		$FormularioGrupoItemModel = new FormularioGrupoItemModel();
		$dataItems = [];
		if ($id != "") {
			$dataItems = json_decode($FormularioGrupoItemModel->getByFormulario($id));
		}
		$data['dataItems'] = $dataItems;

		if ($id != "") {
			$data['data'] = json_decode($Model->getAll($id));
			$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;
		} else {
			$data['action'] = base_url() . '/' . $this->redireccion . '/edit';
		}
		$data['slug'] = $this->redireccion;
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
		echo view('dashboard/footer', $data);
	}


	public function insertar($nombre)
	{


		$this->recogerDatos();
		// Acutlizar delegacion
		$newData = [
			'NOMBRE' => $nombre //$this->request->getVar('nombre')
			// 'CAPTURA_ARTICULO' => $this->capturarArticulo, //$this->request->getVar('capturarArticulo'),
			// 'CAPTURA_LOTE' => $this->capturarLote, //$this->request->getVar('capturarLote'),
			// 'CAPTURA_CADUCIDAD' => $this->capturarCaducidad, //$this->request->getVar('capturarCaducidad'),
			// 'CAPTURA_DOCUMENTO' =>  $this->capturarDocumento, //$this->request->getVar('capturarDocumento'),
			// 'CAPTURA_ENTIDAD' =>  $this->capturarEntidad, //$this->request->getVar('capturarEntidad'),
			// 'CAPTURA_MOTIVO_CHEQUEO' => $this->capturarMotivo, //$this->request->getVar('capturarMotivo')
		];

		$Model = new FormularioModel();
		return $Model->insert($newData);
	}

	// Borrar
	public function delete($id)
	{

		$Model = new FormularioModel();
		$modelFormulariosGruposItems=new FormularioGrupoItemModel();
		$modelFormulariosGruposItems->deleteByFormulario($id);

		$answer = $Model->deleteById($id);

		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', 'Eliminado correctamente');

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}

	public function agregarItems()
	{
		$response = json_decode($this->request->getPost('data'));
		//return var_dump(json_decode($response->items));

		$idGrupo = $response->idGrupo;
		$id = $response->idFormulario;
		$nombreFormulario = $response->nomFormulario;
		$items = json_decode($response->items);
		$altaForm = 0;


		if ($id == 0) {
			if ($nombreFormulario != "") {
				$altaForm = 1;
				$id = $this->insertar($nombreFormulario);
			} else {
				return "0";
			}
		}

		// Comprobación de las validaciones
		if (!$idGrupo) {
			return "0";
		} else {

			//GRABAR FORMULARIOS GRUPOS ITEMS
			$modelFormulariosGruposItems = new FormularioGrupoItemModel();
			$modelFormulariosGruposItems->deleteByFormularioGrupo($id, $idGrupo);
			//$modelFormulariosGruposItems->where('ID_FORMULARIO',$id)->where('ID_GRUPO',$idGrupo)->delete();

			//return var_dump($items[0]->ID);
			foreach ($items as $item) {
				$idItem = $item->ID;
				$posItem = $item->POS;

				$newData = [
					'ID_FORMULARIO'	=> $id,
					'ID_GRUPO' => $idGrupo,
					'ID_ITEM' => $idItem,
					'ORDEN' => $posItem
				];
				//return var_dump($newData);
				$modelFormulariosGruposItems->insert($newData);
			}

			if ($altaForm == 0) {
				return $modelFormulariosGruposItems->getByFormulario($id);
			} else {
				return json_encode(['redirect' => true, 'id' => $id]);
			}
		}
	}
}