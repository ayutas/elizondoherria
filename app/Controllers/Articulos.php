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
		$column2= array ('Field'=>'Descripción');
		$column3= array ('Field'=>'Número');
		$column4= array ('Field'=>'Letra');
		$column5= array ('Field'=>'Categoría');
		$column6= array ('Field'=>'Precio');
		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6);
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
					'descripcion' =>  'required',
					'numero' =>  'required',
					'categoria' => 'required|numeric|greater_than[0]'
				];
			} else {
				// reglas de validación
				$rules = [
					'descripcion' =>  'required|is_unique[tbl_articulos.DESCRIPCION]',
					'numero' =>  'required|is_unique[tbl_articulos.NUMERO]',
					'categoria' => 'required|numeric|greater_than[0]'
				];
			}

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'DESCRIPCION' => $this->request->getVar('descripcion'),
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
						'DESCRIPCION' => $this->request->getVar('descripcion'),
						'LETRA' => $this->request->getVar('letra'),
						'CATEGORIA_ID' => $this->request->getVar('categoria')
					];
					
					//Guardamos
					$model->save($newData);
					$mensaje='Actualizado correctamente';
				} else {
					$newData = [						
						'DESCRIPCION' => $this->request->getVar('descripcion'),
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
			// $clienteAsignado=json_decode($articuloClienteModel->getClienteAsignado($id));
			// return var_dump($clienteAsignado);

			$data['clienteAsignado']=json_decode($articuloClienteModel->getClienteAsignado($id));
			// $data['clienteAsignado'][0]=array_push(json_encode($data['clienteAsignado'][0]), ['link'=>'prueba']);

			// return var_dump($data['clienteAsignado'][0]);
			// if (isset($data['clienteAsignado'][0])){
			// 	$data['clienteAsignado']=['link'=>base_url() . "/clientes/edit/".$data['clienteAsignado'][0]->ID];
				// return var_dump($data['clienteAsignado'][0]);
			// }
			// return var_dump($data);
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

	

	// function upload()
	// {
	// 	if (0 < $_FILES['archivo']['error']) {
	// 		echo 'Error: ' . $_FILES['archivo']['error'] . '<br>';
	// 	} else {

	// 		$rotacion = $this->request->getPost('rotacion');

	// 		// Accept upload if there was no origin, or if it is an accepted origin
	// 		$tmp = $_FILES['archivo'];

	// 		//EN ANASINF PARA QUE FUNCIONE TIENE QUE IR EN LA RUTA LA CARPETA gesioncalidad PERO EN ELABORADOS COMO SOLO HAY UNA UNICA APLICACION, ENTONCES VA SIN LA CARPETA gestioncalidad
	// 		if (session()->get('multiApp')) {
	// 			$serverFolder = $_SERVER['DOCUMENT_ROOT'] . '/gestioncalidad/uploads/referencias/';
	// 		} else {
	// 			$serverFolder = $_SERVER['DOCUMENT_ROOT'] . '/uploads/referencias/';
	// 		}

	// 		$elementos = array_diff(scandir($serverFolder), array('..', '.'));
	// 		$tmp = $_FILES['archivo'];
	// 		// $nombre  = $_FILES['archivo']['name'];			
	// 		$archivo = explode('.', $tmp['name']);
	// 		//CAMBIO LOS ESPACIOS POR _ AL NOMBRE DE ARCHIVO QUE PARECE QUE ME DA PROBLEMAS EN EL CHEQUEO AL COPIAR LA IMAGEN DE EJEMPLO EN LA CARPETA DE CHEQUEO CORRESPONDIENTE
	// 		//ADEMAS EL mb_url_title ME REEMPLAZA LOS CARACTERES RAROS O ESPECIALES
	// 		$archivo[0] = mb_url_title($archivo[0], '_');

	// 		foreach ($elementos as $item) {
	// 			while ($item == ($archivo[0] . ".jpg")) {

	// 				$archivo[0] = substr(md5(time()), 0, 16);
	// 			}
	// 		}
	// 		$nombre = $archivo[0] . '.jpg';

	// 		switch ($rotacion) {
	// 			case 'rotar-90':
	// 				$rotar = '-rotate "-90>"';
	// 				break;
	// 			case 'rotar90':
	// 				$rotar = '-rotate "90>"';
	// 				break;
	// 			case 'rotar180':
	// 				$rotar = '-rotate "180>"';
	// 				break;
	// 			default:
	// 				$rotar = '';
	// 				break;
	// 		}

	// 		//CONVERTIMOS EL PDF EN PNG CON IMAGICK INSTALANDO EN WINDOWS
	// 		$rutaImagick = session()->get('rutaImagick');
	// 		if ($rutaImagick != "") {
	// 			$comando = '"' . $rutaImagick . '" convert -verbose ' . $rotar . ' -density 300  -trim "' . $_FILES['archivo']['tmp_name'] . '" -quality 100 -resample 150 -flatten -sharpen 0x1.0 "' . $serverFolder . $nombre . '"';
	// 			// exec('"'.$rutaImagick .'" convert -verbose -density 200  -trim "'.$_FILES['archivo']['tmp_name'].'" -quality 100 -flatten -sharpen 0x1.0 "'.$serverFolder.$nombre.'"');
	// 		} else {
	// 			$comando = '"C:\Program Files\ImageMagick-7.0.11-Q16-HDRI\magick.exe" convert -verbose ' . $rotar . ' -density 300  -trim "' . $_FILES['archivo']['tmp_name'] . '"  -quality 100 -resample 150 -flatten -sharpen 0x1.0 "' . $serverFolder . $nombre . '"';
	// 		}
	// 		// return var_dump($comando);
	// 		exec($comando);

	// 		$elementos = array_diff(scandir($serverFolder), array('..', '.'));
	// 		foreach ($elementos as $item) {
	// 			while ($item == $nombre) {
	// 				return 'uploads/referencias/' . $nombre;
	// 			}
	// 		}
	// 	}
	// 	return 'false';
	// }
}