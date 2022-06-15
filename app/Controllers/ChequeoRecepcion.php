<?php

namespace App\Controllers;

use App\Models\DelegacionLineaModel;
use App\Models\FormularioModel;
use App\Models\ArticuloModel;
use App\Models\ItemModel;
use App\Models\ArticuloFormularioGrupoItemModel;
use App\Models\MotivoModel;
use App\Models\RegistroFormularioModel;
use App\Models\RegistroFormularioGrupoModel;
use App\Models\RegistroItemModel;
use App\Models\ParametrosModel;

use Dompdf\Dompdf;
use Dompdf\Options;


class ChequeoRecepcion extends BaseController
{

	protected $redireccion = "ChequeoRecepcion";
	protected $redireccionView = "chequeo/recepcion/";

	protected $capturarArticulo = 0;
	protected $capturarLote = 0;
	protected $capturarCaducidad = 0;
	protected $capturarDocumento = 0;
	protected $capturarEntidad = 0;
	protected $capturarMotivo = 0;


	public function nuevoRegistro()
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$Model = new FormularioModel();

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			// reglas de validación
			$rules = [

				'nombre' =>  'required|min_length[3]|max_length[100]'
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'NOMBRE' => $this->request->getVar('nombre'),
					'CAPTURA_ARTICULO' =>  $this->request->getVar('articulo'),
					'CAPTURA_LOTE' =>  $this->request->getVar('lote'),
					'CAPTURA_CADUCIDAD' =>  $this->request->getVar('caducidad'),
					'CAPTURA_DOCUMENTO' =>  $this->request->getVar('documento'),
					'CAPTURA_ENTIDAD' =>  $this->request->getVar('entidad'),
					'CAPTURA_MOTIVO_CHEQUEO' =>  $this->request->getVar('motivo')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
				//return var_dump($data);

			} else {

				//$this->recogerDatos();

				// Insertar formulario
				$newData = [
					'NOMBRE' => $this->request->getVar('nombre'),
					'CAPTURA_ARTICULO' => $this->capturarArticulo, //$this->request->getVar('capturarArticulo'),
					'CAPTURA_LOTE' => $this->capturarLote, //$this->request->getVar('capturarLote'),
					'CAPTURA_CADUCIDAD' => $this->capturarCaducidad, //$this->request->getVar('capturarCaducidad'),
					'CAPTURA_DOCUMENTO' =>  $this->capturarDocumento, //$this->request->getVar('capturarDocumento'),
					'CAPTURA_ENTIDAD' =>  $this->capturarEntidad, //$this->request->getVar('capturarEntidad'),
					'CAPTURA_MOTIVO_CHEQUEO' => $this->capturarMotivo, //$this->request->getVar('capturarMotivo')
				];
				//Insertamos
				$id = $Model->insert($newData);

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Actualizado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$ModelFormularios = new FormularioModel();
		$data['formularios'] = json_decode($ModelFormularios->getAll());

		$ModelMotivos = new MotivoModel();
		$data['motivos'] = json_decode($ModelMotivos->getAll());

		$sessionIdDelegacion = session()->get('idDelegacion');
		$ModelDelegacionLineas = new DelegacionLineaModel();
		$data['lineas'] = json_decode($ModelDelegacionLineas->getByIdDelegacion($sessionIdDelegacion));
		//return var_dump($data['lineas']);

		$ModelArticulos = new ArticuloModel();
		$data['articulos'] = json_decode($ModelArticulos->getByIdDelegacion($sessionIdDelegacion));
		$ModelItems = new ItemModel();
		$data['items'] = json_decode($ModelItems->getAll());


		// $ModelArticuloFormularioGrupoItemModel = new ArticuloFormularioGrupoItemModel();		
		// $data['todo'] = json_decode($ModelArticuloFormularioGrupoItemModel->getAll());

		$data['data'] = [];
		$data['action'] = base_url() . '/' . $this->redireccion . '/nuevoRegistro';

		$data['slug'] = $this->redireccion;
		echo view('dashboard/header', $data);
		echo view('chequeo/recepcion', $data);
		echo view('dashboard/footer', $data);
	}

	public function edit($id)
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$Model = new FormularioModel();

		// Comprobamos el metodo de la petición
		if ($this->request->getMethod() == 'post') {

			// reglas de validación
			$rules = [

				'nombre' =>  'required|min_length[3]|max_length[100]'
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'NOMBRE' => $this->request->getVar('nombre'),
					'CAPTURA_ARTICULO' =>  $this->request->getVar('articulo'),
					'CAPTURA_LOTE' =>  $this->request->getVar('lote'),
					'CAPTURA_CADUCIDAD' =>  $this->request->getVar('caducidad'),
					'CAPTURA_DOCUMENTO' =>  $this->request->getVar('documento'),
					'CAPTURA_ENTIDAD' =>  $this->request->getVar('entidad'),
					'CAPTURA_MOTIVO_CHEQUEO' =>  $this->request->getVar('motivo')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;
				//return var_dump($data);

			} else {

				//$this->recogerDatos();

				// Insertar formulario
				$newData = [
					'NOMBRE' => $this->request->getVar('nombre'),
					'CAPTURA_ARTICULO' => $this->capturarArticulo, //$this->request->getVar('capturarArticulo'),
					'CAPTURA_LOTE' => $this->capturarLote, //$this->request->getVar('capturarLote'),
					'CAPTURA_CADUCIDAD' => $this->capturarCaducidad, //$this->request->getVar('capturarCaducidad'),
					'CAPTURA_DOCUMENTO' =>  $this->capturarDocumento, //$this->request->getVar('capturarDocumento'),
					'CAPTURA_ENTIDAD' =>  $this->capturarEntidad, //$this->request->getVar('capturarEntidad'),
					'CAPTURA_MOTIVO_CHEQUEO' => $this->capturarMotivo, //$this->request->getVar('capturarMotivo')
				];
				//Insertamos
				$id = $Model->insert($newData);

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Actualizado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$ModelFormularios = new FormularioModel();
		$data['formularios'] = json_decode($ModelFormularios->getAll());

		$ModelMotivos = new MotivoModel();
		$data['motivos'] = json_decode($ModelMotivos->getAll());

		$sessionIdDelegacion = session()->get('idDelegacion');
		$ModelDelegacionLineas = new DelegacionLineaModel();
		$data['lineas'] = json_decode($ModelDelegacionLineas->getByIdDelegacion($sessionIdDelegacion));
		//return var_dump($data['lineas']);

		$ModelArticulos = new ArticuloModel();
		$data['articulos'] = json_decode($ModelArticulos->getByIdDelegacion($sessionIdDelegacion));
		$ModelItems = new ItemModel();
		$data['items'] = json_decode($ModelItems->getAll());


		$modelRegistroFormulario = new RegistroFormularioModel();
		$data['data'] = json_decode($modelRegistroFormulario->getDatosChequeo($id));
		//return var_dump($data['data']);
		$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;



		$data['slug'] = $this->redireccion;
		echo view('dashboard/header', $data);
		echo view('chequeo/recepcion', $data);
		echo view('dashboard/footer', $data);
	}




	public function obtenerItemsChequeoFormArtAjax()
	{
		$response = json_decode($this->request->getPost('data'));
		$idFormulario = $response->idFormulario;
		$idArticulo = $response->idArticulo;

		return $this->obtenerItemsChequeoFormArt($idFormulario, $idArticulo);
	}

	public function obtenerItemsChequeoFormArt($idFormulario, $idArticulo)
	{
		$ModelArticuloFormularioGrupoItemModel = new ArticuloFormularioGrupoItemModel();
		return $ModelArticuloFormularioGrupoItemModel->getAllByFormArt($idFormulario, $idArticulo);
	}

	public function obtenerItemsRegistroAnterior()
	{
		$response = json_decode($this->request->getPost('data'));
		$idFormulario = $response->idFormulario;
		$idDelegacionLinea = $response->idDelegacionLinea;
		$ModelRegistroFormularioModel = new RegistroFormularioModel();
		$registro = json_decode($ModelRegistroFormularioModel->getUltimoChequeoFormularioDelegacionLinea($idFormulario, $idDelegacionLinea));
		//return var_dump(isset($registro[0]));
		if (isset($registro[0])) {
			$idArticulo = $registro[0]->IdArticulo;

			$items = json_decode($this->obtenerItemsChequeoFormArt($idFormulario, $idArticulo));

			$datos = json_encode(array($registro, $items));
			return $datos;
		}
		return json_encode(['nodata' => true]);
	}

	public function obtenerDatosChequeo()
	{
		$response = json_decode($this->request->getPost('data'));
		$idRegistro = $response->idRegistro;


		$ModelRegistroFormularioModel = new RegistroFormularioModel();
		$datosCabecera = json_decode($ModelRegistroFormularioModel->getDatosChequeo($idRegistro));

		$datosItems = json_decode($this->obtenerItemsChequeoRegistro($idRegistro));

		$datos = json_encode(array($datosCabecera, $datosItems));
		return $datos;
	}
	public function obtenerItemsChequeoRegistro($idRegistro)
	{
		$ModelRegistroItem = new RegistroItemModel();
		return $ModelRegistroItem->getByRegistro($idRegistro);
	}

	public function registrarchequeo()
	{
		$response = json_decode($this->request->getPost('data'));
		// return var_dump($response);
		$idRegistro = $response->idRegistro;
		$fecha = $response->fecha;
		$idUsuario = $response->idUsuario;
		$idArticulo = $response->idArticulo;
		$idFormulario = $response->idFormulario;
		$idDelegacionLinea = $response->idDelegacionLinea;
		$idMotivo = $response->idMotivo;
		$lote = $response->lote;
		$caducidad = $response->caducidad;
		$documento = $response->documento;
		$entidad = $response->entidad;
		$observaciones = $response->observaciones;
		$idGrupo = $response->idGrupo;
		$imagenEjemplo = $response->imagenEjemplo;
		$imagenReal = $response->imagenReal;
		$items = json_decode($response->items);

		//REGISTROS FORMULARIOS		
		$modelRegistroFormulario = new RegistroFormularioModel();

		if ($idRegistro != 0) {
			$newDataRegistro = [
				'ID' => $idRegistro,
				'FECHA' => $fecha,
				'ID_USUARIO' => $idUsuario,
				'ID_ARTICULO' => $idArticulo,
				'ID_FORMULARIO' => $idFormulario,
				'ID_DELEGACION_LINEA' =>  $idDelegacionLinea,
				'ID_MOTIVO' =>  $idMotivo,
				'LOTE' =>  $lote,
				'CADUCIDAD' =>  $caducidad,
				'DOCUMENTO' =>  $documento,
				'ENTIDAD' =>  $entidad,
				'OBSERVACIONES' =>  $observaciones,
			];
			//update del registro de cabecera si el idRegistro no viene a 0
			//return var_dump($newDataRegistro);
			$modelRegistroFormulario->save($newDataRegistro);
		} else {

			$newDataRegistro = [
				'FECHA' => $fecha,
				'ID_USUARIO' => $idUsuario,
				'ID_ARTICULO' => $idArticulo,
				'ID_FORMULARIO' => $idFormulario,
				'ID_DELEGACION_LINEA' =>  $idDelegacionLinea,
				'ID_MOTIVO' =>  $idMotivo,
				'LOTE' =>  $lote,
				'CADUCIDAD' =>  $caducidad,
				'DOCUMENTO' =>  $documento,
				'ENTIDAD' =>  $entidad,
				'OBSERVACIONES' =>  $observaciones,
			];
			//insert del registro de cabecera
			$idRegistro = $modelRegistroFormulario->insert($newDataRegistro);
		}

		//PRIMERO VOY A GESTIONAR LAS IMAGENES ANTES DE GRABAR NADA EN BASE DE DATOS
		//SI LA IMAGEN REAL VIENE EN BASE64 (EMPIEZA POR DATA) ENTONCES TENEMOS QUE GRABAR LAS IMAGENES, SINO VIENE EN BASE64 ES QUE LA IMAGEN NO HA CAMBIADO DE LA ORIGINAL POR LO QUE NO HACEMOS NADA
		if (substr($imagenReal, 0, 4) == 'data') {
			//EN ANASINF PARA QUE FUNCIONE TIENE QUE IR EN LA RUTA LA CARPETA gesioncalidad PERO EN ELABORADOS COMO SOLO HAY UNA UNICA APLICACION, ENTONCES VA SIN LA CARPETA gestioncalidad
			if (session()->get('multiApp')) {
				$rutaAGrabar = $_SERVER['DOCUMENT_ROOT'] . '/gestioncalidad/uploads/chequeos/' . $idRegistro;
			} else {
				$rutaAGrabar = $_SERVER['DOCUMENT_ROOT'] . '/uploads/chequeos/' . $idRegistro;
			}

			if (!is_dir($rutaAGrabar)) {
				$RutaCreada = mkdir($rutaAGrabar, 0777, true);
			} else {
				$RutaCreada = true;
			}
			// return var_dump($RutaCreada);
			if ($RutaCreada) {
				//PUEDE QUE LLEGUE IMAGEN REAL SIN QUE HAYA IMAGEN DE EJEMPLO, ASI QUE TENGO QUE CONTROLARLOS POR SEPARADO
				//LA RUTA DE EJEMPLO DEJAREMOS LA QUE TIENE RELACIONADA LA REFERENCIA EN LA CARPETA DE REFERENCIAS
				$rutaEjemplo = $imagenEjemplo;
				$rutaReal = $rutaAGrabar . '/' . $idGrupo . '_real.jpg';

				//GRABAMOS LA IMAGEN REAL EN LA RUTA DEFINIDA
				$base_to_php = explode(',', $imagenReal);
				$imagenBinaria = base64_decode($base_to_php[1]);
				$respuesta = file_put_contents($rutaReal, $imagenBinaria);
			} else {
				return 'false';
			}
			//ANTES DE SEGUIR, REVISO QUE EXISTE LA FOTO REAL, SINO DEVUELVO FALSE
			if (!file_exists($rutaReal)) {
				return 'false';
			}

			$this->correctImageOrientation($rutaAGrabar . '/' . $idGrupo . '_real.jpg');
			//REGISTROS FORMULARIOS GRUPOS
			$modelRegistroFormularioGrupo = new RegistroFormularioGrupoModel();
			//grabaremos el registro del grupo con las 2 imagenes

			//COMO YA HEMOS GESTIONADO PREVIAMENTE TODAS LAS IMAGENES Y YA HE COMPROBADO QUE EXISTEN, YA SOLO GRABAMOS EN BBDD
			//elimino primero si existe algun registro con imagenes de ese grupo y registro de chequeo
			$modelRegistroFormularioGrupo->where('ID_REGISTRO', $idRegistro)->where('ID_GRUPO', $idGrupo)->delete();
			$nombreEjemplo = pathinfo($rutaEjemplo, PATHINFO_FILENAME);
			$extensionEjemplo = pathinfo($rutaEjemplo, PATHINFO_EXTENSION);

			//INSERTO EL NUEVO REGISTRO
			if ($rutaEjemplo != '') {
				$newDataImagenes = [
					'ID_REGISTRO' => $idRegistro,
					'ID_GRUPO' => $idGrupo,
					'IMAGEN_EJEMPLO' =>  '/uploads/referencias/' . $nombreEjemplo . '.' . $extensionEjemplo,
					'IMAGEN_REAL' =>  '/uploads/chequeos/' . $idRegistro . '/' . $idGrupo . '_real.jpg',
				];
			} else {
				$newDataImagenes = [
					'ID_REGISTRO' => $idRegistro,
					'ID_GRUPO' => $idGrupo,
					'IMAGEN_EJEMPLO' =>  '',
					'IMAGEN_REAL' =>  '/uploads/chequeos/' . $idRegistro . '/' . $idGrupo . '_real.jpg',
				];
			}

			$modelRegistroFormularioGrupo->insert($newDataImagenes);
		}



		//REGISTROS ITEMS
		$modelRegistroItem = new RegistroItemModel();
		$modelRegistroItem->deleteItemsChequeoFormularioGrupo($idRegistro, $idFormulario, $idGrupo);
		//grabaremos el registro de cada item con su valor de ok/ko y texto de problema y solucion
		// return var_dump($items);

		foreach ($items as $item) {

			//REGISTROS ITEMS
			$newData = [
				'ID_REGISTRO' => $idRegistro,
				'ID_FORMULARIO_GRUPO_ITEM' => $item->ID,
				'VALOR' => $item->VALOR,
				'PROBLEMA' => $item->PROBLEMA,
				'SOLUCION' => $item->SOLUCION,
			];

			$modelRegistroItem->insert($newData);
		}
		return json_encode(['idRegistro' => $idRegistro]);
	}

	public function correctImageOrientation($filename)
	{
		//ESTA FUNCION ES PARA PONER LA IMAGENEN VERTICAL SEGUN LOS METADATOS DE LA FOTO Y LA ORIENTACION QUE TIENE GRABADA Y VIENE POR LA TABLET O TELEFONO
		if (function_exists('exif_read_data')) {
			$exif = exif_read_data($filename);
			$info = finfo_open(FILEINFO_MIME_TYPE);
			foreach (glob($filename) as $fname) {
				$a = finfo_file($info, $fname);
			}
			finfo_close($info);
			//return var_dump($a);
			if ($exif && isset($exif['Orientation'])) {
				$orientation = $exif['Orientation'];
				if ($orientation != 1) {
					$img = imagecreatefromjpeg($filename);
					$deg = 0;
					switch ($orientation) {
						case 3:
							$deg = 180;
							break;
						case 6:
							$deg = 270;
							break;
						case 8:
							$deg = 90;
							break;
					}
					if ($deg) {
						$img = imagerotate($img, $deg, 0);
					}
					// then rewrite the rotated image back to the disk as $filename 
					imagejpeg($img, $filename, 95);
				} // if there is some rotation necessary
			} // if have the exif orientation info
		} // if function exists      
	}

	public function finalizarChequeo()
	{
		
		$response = json_decode($this->request->getPost('data'));
		$arrayIdRegistro = $response->idRegistro;
		$observaciones = $response->observaciones;
		
		$modelParametros=new ParametrosModel();
		$parametros=json_decode($modelParametros->getAll());
		$rutaAGrabar = $_SERVER['DOCUMENT_ROOT'];
		$rutaImagick="C:\Program Files\ImageMagick-7.0.11-Q16-HDRI\magick.exe";			
		if(isset($parametros)){			
			if($parametros[0]->multiApp){
				$rutaAGrabar=$_SERVER['DOCUMENT_ROOT'] . '/gestioncalidad';
			}
			if($parametros[0]->rutaImagick!=""){
				$rutaImagick=$parametros[0]->rutaImagick;
			}
		}

		//PRIMERO ACTUALIZO LAS OBSERVACIONES Y MARCO EL CHEQUEO COMO FINALIZADO
		foreach ($arrayIdRegistro as $idRegistro) {
			$modelRegistroFormulario = new RegistroFormularioModel();
			$modelRegistroFormulario->actualizarObservaciones($idRegistro, $observaciones);
			//HACEMOS LA UPDATE DE SITUACION PARA MARCAR EL REGISTRO COMO FINALIZADO
			$modelRegistroFormulario->finalizarChequeo($idRegistro);
		}

		//AHORA POR CADA CHEQUEO PRIMERO SACO LAS IMAGENES REALES QUE SE HAN GUARDADO PARA REDIMENSIONARLAS 
		foreach ($arrayIdRegistro as $idRegistro) {
			//AL FINALIZAR EL CHEQUEO ES CUANDO REDUZCO LA IMAGENES REALES Y LUEGO GENERO EL PDF
			//CONVERTIMOS LA IMAGEN EN JPG HACIENDO RESAMPLE Y PONIENDO EL TAMAÑO DE ALTO 29cm (794pixels)
			$modelRegistroFormularioGrupo = new RegistroFormularioGrupoModel();
			$imagenesReales=json_decode($modelRegistroFormularioGrupo->getByIdRegistro($idRegistro));
			if (isset($imagenesReales)) {								
				foreach($imagenesReales as $imagenReal){
					$rutaJpg = $rutaAGrabar . $imagenReal->ImagenReal;
					if ($rutaImagick != "") {
						$comando = '"' . $rutaImagick . '" convert ' . $rutaJpg . " -resample 150 -geometry x794  -trim " . $rutaJpg . '"';
					} else {
						$comando = '"C:\Program Files\ImageMagick-7.0.11-Q16-HDRI\magick.exe" convert "' . $rutaJpg . '" -resample 150 -geometry x794  -trim "' . $rutaJpg . '"';
					}
					exec($comando);
				}				
			}						
		}	
			
		return json_encode(true);
	}
}


