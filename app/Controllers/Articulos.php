<?php

namespace App\Controllers;

use App\Models\ArticuloModel;
use App\Models\ArticuloClienteModel;
use App\Models\CategoriaModel;

class Articulos extends BaseController
{
	protected $redireccion = "articulos";
	protected $redireccionView = "mantenimiento/articulos";

	// Ver
	public function show()
	{
		helper(['form']);
		$uri = service('uri');

		$data = [];
		$model = new ArticuloModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>'Número');
		$column3= array ('Field'=>'Letra');
		$column4= array ('Field'=>'Categoría');
		$column5= array ('Field'=>'Precio');
		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5);
		$data['columns'] = $columnasDatatable;
		$data['data'] = json_decode($model->getAll());
		foreach ($data['data'] as $item) {
			$buttonEdit = '<form method="get" action="' . base_url() . '/' . $this->redireccion . '/edit/' . $item->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $item->ID . '" style="color:white;"  >Editar</button></form>';
			$buttonDelete = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $item->ID . '" style="color:white;" class="btn btn-danger" >Eliminar</button>';
			$item->btnEditar = $buttonEdit;
			$item->btnEliminar = $buttonDelete;
		}
		// Cargamos las vistas en orden
		$data['action'] =  base_url() . '/' . $this->redireccion . '/new';
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
		// $modelPerm = new PermsModel();
		// $roleModel = new RoleModel();
		$model = new ArticuloModel();

		//$perm = $modelPerm->getPerms(session()->get('role'),$uri->getSegment(1));
		$data['id'] = $id;



		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {


			if ($id != "") {
				// reglas de validación
				$rules = [
					'numero' =>  'required',
					'categoria' => 'required|numeric|greater_than[0]'
				];
			} else {
				// reglas de validación
				$rules = [
					'numero' =>  'required|is_unique[tbl_articulos.NUMERO]',
					'categoria' => 'required|numeric|greater_than[0]'
				];
			}

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'NUMERO' => $this->request->getVar('numero'),
					'LETRA' => $this->request->getVar('letra'),
					'CATEGORIA_ID' => $this->request->getVar('categoria')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;

			} else {

				if ($id != "") {
					// Acutlizar rol
					$newData = [
						'ID' => $id,
						'NUMERO' => $this->request->getVar('numero'),
						'LETRA' => $this->request->getVar('letra'),
						'CATEGORIA_ID' => $this->request->getVar('categoria')
					];
					
					//Guardamos
					$model->save($newData);
					$mensaje='Actualizado correctamente';
				} else {
					$newData = [
						'NUMERO' => $this->request->getVar('numero'),
						'LETRA' => $this->request->getVar('letra'),
						'CATEGORIA_ID' => $this->request->getVar('categoria')
					];
					$id = $model->insert($newData);
					$mensaje='Creado correctamente';
				}

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', $mensaje);

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . '/' . $this->redireccion . '/show');
			}
		}

		$categoriaModel = new CategoriaModel();
		$data['categorias'] = json_decode($categoriaModel->getAll());

		if ($id != "") {
			$articuloClienteModel=new ArticuloClienteModel();
			$data['clienteAsignado']=json_decode($articuloClienteModel->getClienteAsignado($id));
			if (isset($data['clienteAsignado'])){
				$data['clienteAsignado']['link']=base_url() . "/clientes/edit/".$data['clienteAsignado']['ID'];
			}
			$data['data'] = json_decode($model->getAll($id));
			$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;
		} else {
			$data['action'] = base_url() . '/' . $this->redireccion . '/edit';
		}
		$data['slug'] = $this->redireccion;
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
		echo view('dashboard/footer', $data);
	}

	// Borrar
	public function delete($id)
	{

		$model = new ArticuloModel();
		$answer = $model->deleteById($id);
		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', 'Eliminado correctamente');

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . '/' . $this->redireccion . '/show');
	}

	public function insertar($referencia, $descripcion, $marca)
	{
		$model = new ArticuloModel();
		$newData = [
			'REFERENCIA' => $referencia,
			'DESCRIPCION' => $descripcion,
			'MARCA' => $marca
		];
		$id = $model->insert($newData);
	}

	public function quitarArticuloGrupo()
	{
		$response = json_decode($this->request->getPost('data'));
		$idGrupo = $response->idGrupo;
		$id = $response->idArticulo;
		if ($id != 0 && $idGrupo != 0) //SU NO VIENEN IDs, NO SE PUEDE ELIMINAR
		{
			$modelArticuloGrupo = new ArticuloGrupoModel();
			$modelArticuloGrupo->where('ID_ARTICULO', $id)->where('ID_GRUPO', $idGrupo)->delete();
			return $modelArticuloGrupo->getGruposArt($id);
		} else {
			return 'false';
		}
	}

	public function grabarArticuloGrupo()
	{
		$response = json_decode($this->request->getPost('data'));
		//return var_dump($_FILES);
		$imagen = $response->imagen;
		$idGrupo = $response->idGrupo;
		$id = $response->idArticulo;
		$nombreArticulo = $response->nombreArt;
		$referenciaArticulo = $response->referenciaArt;
		$marcaArticulo = $response->marcaArt;

		$altaArt = 0;


		if ($id == 0) //SU NO VIENE ID, HAY QUE DAR DE ALTA EL ARTICULO
		{
			$id = $this->insertar($referenciaArticulo, $nombreArticulo, $marcaArticulo);
			$altaArt = 1;
		}

		if ($idGrupo == 0) {
			return "0";
		} else {
			$modelArticuloGrupo = new ArticuloGrupoModel();
			$modelArticuloGrupo->where('ID_ARTICULO', $id)->where('ID_GRUPO', $idGrupo)->delete();


			//ARTICULOS GRUPO			
			$newData = [
				'ID_ARTICULO' => $id,
				'ID_GRUPO' => $idGrupo,
				'IMAGEN_ETIQUETA' =>  $imagen
			];
			//			return var_dump($newData);		
			$modelArticuloGrupo->insert($newData);

			if ($altaArt == 0) {
				return $modelArticuloGrupo->getGruposArt($id);
			} else {
				return json_encode(['redirect' => true, 'id' => $id]);
			}
		}
	}

	public function grabarArticuloItemsFormulario()
	{

		$response = json_decode($this->request->getPost('data'));

		$id = $response->idArticulo;
		$nombreArticulo = $response->nombreArt;
		$referenciaArticulo = $response->referenciaArt;
		$marcaArticulo = $response->marcaArt;
		$idFormulario = $response->idFormulario;
		$items = json_decode($response->items);

		$altaArt = 0;


		if ($id == 0) //SU NO VIENE ID, HAY QUE DAR DE ALTA EL ARTICULO
		{
			$id = $this->insertar($referenciaArticulo, $nombreArticulo, $marcaArticulo);
			$altaArt = 1;
		}

		if ($id == 0) {
			return "0";
		} else {
			$articuloGrupoModel = new ArticuloGrupoModel();
			$modelArticuloFormularioGrupoItemModel = new ArticuloFormularioGrupoItemModel();
			$modelArticuloFormularioGrupoItemModel->deleteByArticuloFormulario($id, $idFormulario);

			foreach ($items as $item) {
				$idItem = $item->ID;

				//ARTICULOS FORMULARIOS_GRUPO_ITEM			
				$newData = [
					'ID_ARTICULO' => $id,
					'ID_FORMULARIO_GRUPO_ITEM' => $idItem,

				];
				//return var_dump($newData);
				$modelArticuloFormularioGrupoItemModel->insert($newData);
			}

			if ($altaArt == 0) {
				$arrayGruposArt = $arrayGruposArt = json_decode($articuloGrupoModel->getGruposArt($id));
				$arrayItemsArt = $modelArticuloFormularioGrupoItemModel->getByArticulo($id);
				return json_encode(array($arrayGruposArt, $arrayItemsArt));
			} else {
				return json_encode(['redirect' => true, 'id' => $id]);
			}
		}
	}

	function upload()
	{
		if (0 < $_FILES['archivo']['error']) {
			echo 'Error: ' . $_FILES['archivo']['error'] . '<br>';
		} else {

			$rotacion = $this->request->getPost('rotacion');

			// Accept upload if there was no origin, or if it is an accepted origin
			$tmp = $_FILES['archivo'];

			//EN ANASINF PARA QUE FUNCIONE TIENE QUE IR EN LA RUTA LA CARPETA gesioncalidad PERO EN ELABORADOS COMO SOLO HAY UNA UNICA APLICACION, ENTONCES VA SIN LA CARPETA gestioncalidad
			if (session()->get('multiApp')) {
				$serverFolder = $_SERVER['DOCUMENT_ROOT'] . '/gestioncalidad/uploads/referencias/';
			} else {
				$serverFolder = $_SERVER['DOCUMENT_ROOT'] . '/uploads/referencias/';
			}

			$elementos = array_diff(scandir($serverFolder), array('..', '.'));
			$tmp = $_FILES['archivo'];
			// $nombre  = $_FILES['archivo']['name'];			
			$archivo = explode('.', $tmp['name']);
			//CAMBIO LOS ESPACIOS POR _ AL NOMBRE DE ARCHIVO QUE PARECE QUE ME DA PROBLEMAS EN EL CHEQUEO AL COPIAR LA IMAGEN DE EJEMPLO EN LA CARPETA DE CHEQUEO CORRESPONDIENTE
			//ADEMAS EL mb_url_title ME REEMPLAZA LOS CARACTERES RAROS O ESPECIALES
			$archivo[0] = mb_url_title($archivo[0], '_');

			foreach ($elementos as $item) {
				while ($item == ($archivo[0] . ".jpg")) {

					$archivo[0] = substr(md5(time()), 0, 16);
				}
			}
			$nombre = $archivo[0] . '.jpg';

			switch ($rotacion) {
				case 'rotar-90':
					$rotar = '-rotate "-90>"';
					break;
				case 'rotar90':
					$rotar = '-rotate "90>"';
					break;
				case 'rotar180':
					$rotar = '-rotate "180>"';
					break;
				default:
					$rotar = '';
					break;
			}

			//CONVERTIMOS EL PDF EN PNG CON IMAGICK INSTALANDO EN WINDOWS
			$rutaImagick = session()->get('rutaImagick');
			if ($rutaImagick != "") {
				$comando = '"' . $rutaImagick . '" convert -verbose ' . $rotar . ' -density 300  -trim "' . $_FILES['archivo']['tmp_name'] . '" -quality 100 -resample 150 -flatten -sharpen 0x1.0 "' . $serverFolder . $nombre . '"';
				// exec('"'.$rutaImagick .'" convert -verbose -density 200  -trim "'.$_FILES['archivo']['tmp_name'].'" -quality 100 -flatten -sharpen 0x1.0 "'.$serverFolder.$nombre.'"');
			} else {
				$comando = '"C:\Program Files\ImageMagick-7.0.11-Q16-HDRI\magick.exe" convert -verbose ' . $rotar . ' -density 300  -trim "' . $_FILES['archivo']['tmp_name'] . '"  -quality 100 -resample 150 -flatten -sharpen 0x1.0 "' . $serverFolder . $nombre . '"';
			}
			// return var_dump($comando);
			exec($comando);

			$elementos = array_diff(scandir($serverFolder), array('..', '.'));
			foreach ($elementos as $item) {
				while ($item == $nombre) {
					return 'uploads/referencias/' . $nombre;
				}
			}
		}
		return 'false';
	}
}