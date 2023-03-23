<?php

namespace App\Controllers;

use App\Models\ArticuloClienteModel;
use App\Models\ClienteComentarioModel;
use App\Models\ClienteModel;
use App\Models\FormaPagoModel;
use App\Models\ReciboModel;
use App\Models\ClienteDocumentoModel;
use App\Models\ParametrosModel;
use App\Models\ZonaModel;

use Dompdf\Dompdf;
use Dompdf\Options;

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
		$idioma=session()->get('idioma');
        $this->request->setLocale($idioma);
        $data['idioma']=$idioma;
		$ClienteModel = new ClienteModel();
		$articulosClientesModel = new ArticuloClienteModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.nombre'));
        $column3= array ('Field'=>lang('Translate.apellidos'));
        $column4= array ('Field'=>lang('Translate.dni'));
		$column5= array ('Field'=>lang('Translate.zona'));

        $columnasDatatable = array($column1,$column2,$column3,$column4,$column5);
		$data['columnsclientes'] = $columnasDatatable;
		$seccion=session()->get('seccion');
		$data['dataclientes'] = json_decode($ClienteModel->getAll($seccion));

		foreach ($data['dataclientes'] as $item) {
			$buttonEditCliente = '<form method="get" action="' . base_url() . '/' . $this->redireccion . '/edit/' . $item->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $item->ID . '" style="color:white;"  >'.lang('Translate.editar').'</button></form>';
			$buttonDeleteCliente = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $item->ID . '" style="color:white;" class="btn btn-danger" >'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEditCliente;
			$item->btnEliminar = $buttonDeleteCliente;
		}

		// Cargamos las vistas en orden
		$data['action'] = base_url() . '/' . $this->redireccion . '/new';
		$data['migapan']=lang('Translate.'.$this->redireccion);
		// $data['actionLineas'] = base_url() . '/clientesLineas/new';
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

		$ClienteModel = new ClienteModel();


		$data['id'] = $id;

		$data['data'] = json_decode($ClienteModel->getById($id));
		$articulosClientesModel = new ArticuloClienteModel();
		$clientesComentariosModel=new ClienteComentarioModel();
		$recibosModel=new ReciboModel();
		$clientesDocumentosModel=new ClienteDocumentoModel();

		$column1= array ('Field'=>'');
		$column2= array ('Field'=>'ID');
		$column3= array ('Field'=>lang('Translate.descripcion'));
		$column4= array ('Field'=>lang('Translate.numero'));
        $column5= array ('Field'=>lang('Translate.letra'));
        $column6= array ('Field'=>lang('Translate.categoria'));
        $column7= array ('Field'=>lang('Translate.precio'));
		$column8= array ('Field'=>lang('Translate.disponible'));

        $columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8);
		$data['columnsArticulos'] = $columnasDatatable;
		$data['dataArticulos'] = json_decode($articulosClientesModel->getByCliente($id));

		$data['columnsArticulosDisponibles'] = $columnasDatatable;
		$seccion=session()->get('seccion');
		$data['articulosDisponibles'] = json_decode($articulosClientesModel->getArticulosDisponibles($seccion));

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.comentario'));
        $column3= array ('Field'=>lang('Translate.created'));
        $column4= array ('Field'=>lang('Translate.updated'));

        $columnasDatatableComentarios = array($column1,$column2,$column3,$column4);
		$data['columnsComentarios'] = $columnasDatatableComentarios;
		$data['dataComentarios'] = json_decode($clientesComentariosModel->getByCliente($id));
		
		foreach ($data['dataComentarios'] as $item) {
			$buttonEditComentario = '<button type="Button" onclick="EditarComentario(this)" id="btnEditarComentario" class="btn btn-primary btnEditar"  data-comentario="' . $item->Comentario . '" data-id="' . $item->ID . '" style="color:white;">'.lang('Translate.editar').'</button>';
			$buttonDeleteComentario = '<button type="Button" onclick="EliminarComentario(' . $item->ID . ')" id="btnEliminarComentario" class="btn btn-danger btnEliminar" style="color:white;">'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEditComentario;
			$item->btnEliminar = $buttonDeleteComentario;
		}

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.titulo'));
        $column3= array ('Field'=>lang('Translate.created'));
        $column4= array ('Field'=>'Ruta');

        $columnasDatatableDocumentos = array($column1,$column2,$column3,$column4);
		$data['columnsDocumentos'] = $columnasDatatableDocumentos;
		$data['dataDocumentos'] = json_decode($clientesDocumentosModel->getByCliente($id));
		
		foreach ($data['dataDocumentos'] as $item) {
			$buttonEditDocumento = '<button type="Button" onclick="DescargarDocumento(this)" id="btnDescargarDocumento" class="btn btn-info btnEditar"  data-ruta="' . $item->Ruta . '" data-id="' . $item->ID . '" style="color:white;">'.lang('Translate.descargar').'</button>';
			$buttonDeleteDocumento = '<button type="Button" onclick="EliminarDocumento(' . $item->ID . ')" id="btnEliminarDocumento" class="btn btn-danger btnEliminar" style="color:white;">'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEditDocumento;
			$item->btnEliminar = $buttonDeleteDocumento;
		}


		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.numero'));
		$column3= array ('Field'=>lang('Translate.fecha'));
		$column4= array ('Field'=>lang('Translate.referencia'));
		$column5= array ('Field'=>lang('Translate.concepto'));
        $column6= array ('Field'=>lang('Translate.importe'));

        $columnasDatatableRecibos = array($column1,$column2,$column3,$column4,$column5,$column6);
		$data['columnsRecibos'] = $columnasDatatableRecibos;
		$data['dataRecibos'] = json_decode($recibosModel->getByIdCliente($id));
		// return var_dump($data['dataComentarios'] );
		
		foreach ($data['dataRecibos'] as $item) {
			$buttonEditRecibo = '<button type="Button" onclick="EditarRecibo(this)" id="btnEditarRecibo" class="btn btn-info btnEditar data-id="' . $item->ID . '" style="color:white;">'.lang('Translate.ver').'</button>';
			// $buttonDeleteRecibo = '<button type="Button" onclick="EliminarRecibo(' . $item->ID . ')" id="btnEliminarRecibo" class="btn btn-danger btnEliminar" style="color:white;">Eliminar</button>';
			$item->btnEditar = $buttonEditRecibo;
			$item->btnEliminar =''; //$buttonDeleteRecibo;
		}
		// return var_dump($data['dataRecibos'] );

		$formaPagoModel = new FormaPagoModel();
		$data['formasPago']=json_decode($formaPagoModel->getAll($seccion));
		//TRADUCIMOS LAS FORMAS DE PAGO
		foreach ($data['formasPago'] as $item) {
			$valor='Translate.'.$item->DESCRIPCION;
			$descripcion=lang($valor);
			$item->DESCRIPCION=$descripcion;
		}

		$zonaModel = new ZonaModel();
		$data['zonas']=json_decode($zonaModel->getData($seccion));

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

		$ClienteModel = new ClienteModel();

		$column1= array ('Field'=>'');
		$column2= array ('Field'=>'ID');
		$column3= array ('Field'=>lang('Translate.descripcion'));
		$column4= array ('Field'=>lang('Translate.numero'));
        $column5= array ('Field'=>lang('Translate.letra'));
        $column6= array ('Field'=>lang('Translate.categoria'));
        $column7= array ('Field'=>lang('Translate.precio'));
		$column8= array ('Field'=>lang('Translate.disponible'));

        $columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8);
		$data['columnsArticulos'] = $columnasDatatable;
		$data['columnsArticulosDisponibles'] = $columnasDatatable;
		$articulosClientesModel = new ArticuloClienteModel();
		$seccion=session()->get('seccion');
		$data['articulosDisponibles'] = json_decode($articulosClientesModel->getArticulosDisponibles($seccion));

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.comentario'));
        $column3= array ('Field'=>lang('Translate.created'));
        $column4= array ('Field'=>lang('Translate.updated'));

        $columnasDatatableComentarios = array($column1,$column2,$column3,$column4);
		$data['columnsComentarios'] = $columnasDatatableComentarios;
		$data['dataComentarios'] =[];

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.titulo'));
        $column3= array ('Field'=>lang('Translate.created'));
        $column4= array ('Field'=>'Ruta');

        $columnasDatatableDocumentos = array($column1,$column2,$column3,$column4);
		$data['columnsDocumentos'] = $columnasDatatableDocumentos;
		$data['dataDocumentos'] =[];

		$formaPagoModel = new FormaPagoModel();
		$data['formasPago']=json_decode($formaPagoModel->getAll($seccion));
		//TRADUCIMOS LAS FORMAS DE PAGO
		foreach ($data['formasPago'] as $item) {
			$valor='Translate.'.$item->DESCRIPCION;
			$descripcion=lang($valor);
			$item->DESCRIPCION=$descripcion;
		}

		$zonaModel = new ZonaModel();
		$data['zonas']=json_decode($zonaModel->getData($seccion));

		$data['action'] = base_url() . '/' . $this->redireccion . '/new';		
		$data['slug'] = $this->redireccion;
		$data['migapan']=lang('Translate.'.$this->redireccion);
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
		echo view('dashboard/footer', $data);
	}

	public function guardarCliente()
	{
		$response = json_decode($this->request->getPost('data'));
		$id = $response->id;
		$nombre = $response->nombre;
		$apellidos = $response->apellidos;
		$dni = $response->dni;
		$domicilio = $response->domicilio;
		$poblacion = $response->poblacion;
		$cpostal = $response->cpostal;
		$contacto = $response->contacto;
		$telefono = $response->telefono;
		$email = $response->email;
		$zona = $response->zona;
		$numero = $response->numero;
		$formaPago = $response->formaPago;
		$cuenta = $response->cuenta;
		$notas = $response->notas;
		$seccion =session()->get('seccion');
		
		$model = new ClienteModel();
		$datos=json_decode($model->existeDniActivoSeccion($dni,$seccion,$id));
		if(isset($datos[0])){
			return json_encode([false,lang('Translate.existeDni')]);
		}

		$newData = [
			'NOMBRE' => $nombre,
			'APELLIDOS' => $apellidos,
			'DNI' => $dni,
			'DOMICILIO' => $domicilio,
			'POBLACION' => $poblacion,
			'COD_POSTAL' => $cpostal,
			'CONTACTO' => $contacto,
			'TELEFONO' => $telefono,
			'EMAIL' => $email,
			'FORMAPAGO_ID' => $formaPago,
			'CUENTA' => $cuenta,
			'NOTAS' => $notas,
			'SECCION_ID' => $seccion,
			'ZONA_ID' => $zona,
			'NUMERO' => $numero
		];
		if($id!=0){
			$newData['ID'] = $id;
			$model->save($newData);
		} else{
			$id = $model->insert($newData);
		}
		return json_encode([true,$id]);

	}

	public function guardarArticuloCliente()
	{		
		$response = json_decode($this->request->getPost('data'));
		$idCliente = $response->idCliente;
		$idArticulo = $response->idArticulo;
		$cantidad = $response->cantidad;

		$model = new ArticuloClienteModel();
		$newData = [
			'ARTICULO_ID' => $idArticulo,
			'CLIENTE_ID' => $idCliente,
			'CANTIDAD' => $cantidad
		];
		$id = $model->insert($newData);
		$seccion=session()->get('seccion');
		$artDisponibles= json_decode($model->getArticulosDisponibles($seccion));
		$articulosCliente=json_decode($model->getByCliente($idCliente));
		return json_encode(array($articulosCliente,$artDisponibles));
	}

	public function quitarArticuloCliente()
	{
		$response = json_decode($this->request->getPost('data'));
		$id = $response->id;
		$idCliente = $response->idCliente;

		$model = new ArticuloClienteModel();		
		$id = $model->deleteById($id);
		$seccion=session()->get('seccion');
		$artDisponibles= json_decode($model->getArticulosDisponibles($seccion));
		$articulosCliente=json_decode($model->getByCliente($idCliente));
		return json_encode(array($articulosCliente,$artDisponibles));
	}
	
	public function guardarComentarioCliente()
	{		
		$response = json_decode($this->request->getPost('data'));
		$id = $response->id;
		$idCliente = $response->idCliente;
		$comentario = $response->comentario;

		$model = new ClienteComentarioModel();
		$Data = [				
			'CLIENTE_ID' => $idCliente,
			'COMENTARIO' => $comentario
		];
		if ($id==0){
			$id = $model->insert($Data);
		} else{
			$Data['ID']=$id;			
			$id = $model->save($Data);
		}
		$comentariosCliente=json_decode($model->getByCliente($idCliente));
		foreach ($comentariosCliente as $item) {
			$buttonEditComentario = '<button type="Button" onclick="EditarComentario(this)" id="btnEditarComentario" class="btn btn-primary btnEditar"  data-comentario="' . $item->Comentario . '" data-id="' . $item->ID . '" style="color:white;">'.lang('Translate.editar').'</button>';
			$buttonDeleteComentario = '<button type="Button" onclick="EliminarComentario(' . $item->ID . ')" id="btnEliminarComentario" class="btn btn-danger btnEliminar" style="color:white;">'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEditComentario;
			$item->btnEliminar = $buttonDeleteComentario;
		}
		return json_encode(array($comentariosCliente));
	}

	public function eliminarComentarioCliente()
	{		
		$response = json_decode($this->request->getPost('data'));
		$id = $response->id;
		$idCliente = $response->idCliente;

		$model = new ClienteComentarioModel();
		$answer = $model->deleteById($id);
		
		$comentariosCliente=json_decode($model->getByCliente($idCliente));
		foreach ($comentariosCliente as $item) {
			$buttonEditComentario = '<button type="Button" onclick="EditarComentario(this)" id="btnEditarComentario" class="btn btn-primary btnEditar"  data-comentario="' . $item->Comentario . '" data-id="' . $item->ID . '" style="color:white;">'.lang('Translate.editar').'Editar</button>';
			$buttonDeleteComentario = '<button type="Button" onclick="EliminarComentario(' . $item->ID . ')" id="btnEliminarComentario" class="btn btn-danger btnEliminar" style="color:white;">'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEditComentario;
			$item->btnEliminar = $buttonDeleteComentario;
		}
		return json_encode(array($comentariosCliente));
	}

	public function guardarDocumentoCliente()
	{
		$modelClientesDocumentos=new ClienteDocumentoModel();
		$response = json_decode($this->request->getPost('data'));
		if ( 0 < $_FILES['archivo']['error'] ) 
		{
			echo 'Error: ' . $_FILES['archivo']['error'] . '<br>';
		}
		else 
		{
			$modelParametros=new ParametrosModel();
			$param=$modelParametros->first();
			$rutaServidor=$_SERVER['DOCUMENT_ROOT'];
			if ($param['CARPETA_APP']!="") {
				$rutaServidor .= '/'.$param['CARPETA_APP'];
			}
			$carpeta_destino =  'uploads/documentos';
	
			if (!file_exists($rutaServidor.'/'.$carpeta_destino)) 
			{
				mkdir($rutaServidor.'/'.$carpeta_destino, 0777, true);
			}

			$nombreArchivo = $_FILES['archivo']['name'];
			$elementos = array_diff(scandir($rutaServidor.'/'.$carpeta_destino), array('..', '.'));			
			$archivo = explode('.', $nombreArchivo);
			//CAMBIO LOS ESPACIOS POR _ AL NOMBRE DE ARCHIVO QUE PARECE QUE ME DA PROBLEMAS EN EL CHEQUEO AL COPIAR LA IMAGEN DE EJEMPLO EN LA CARPETA DE CHEQUEO CORRESPONDIENTE
			//ADEMAS EL mb_url_title ME REEMPLAZA LOS CARACTERES RAROS O ESPECIALES
			$archivo[0] = mb_url_title($archivo[0], '_');

			foreach ($elementos as $item) {				
				while ($item == ($archivo[0] . "." . $archivo[1])) {
					$archivo[0] = substr(md5(time()), 0, 16);
				}
			}
			$nombre = $archivo[0] . '.' . $archivo[1];			
			$idCliente = $this->request->getPost('idCliente');
			$titulo = $this->request->getPost('titulo');

			move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaServidor.'/'.$carpeta_destino.'/'.$nombre);
		}

		$objetoGuardarDocumento = 
		[
			'CLIENTE_ID' => $idCliente,
			'TITULO' => $titulo,
			'RUTA' => $carpeta_destino."/".$nombre
		];
		
		$modelClientesDocumentos->insert($objetoGuardarDocumento);

		$documentosCliente=json_decode($modelClientesDocumentos->getByCliente($idCliente));
		foreach ($documentosCliente as $item) {
			$buttonEditDocumento = '<button type="Button" onclick="DescargarDocumento(this)" id="btnDescargarDocumento" class="btn btn-info btnEditar"  data-ruta="' . $item->Ruta . '" data-id="' . $item->ID . '" style="color:white;">'.lang('Translate.descargar').'</button>';
			$buttonDeleteDocumento = '<button type="Button" onclick="EliminarDocumento(' . $item->ID . ')" id="btnEliminarDocumento" class="btn btn-danger btnEliminar" style="color:white;">'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEditDocumento;
			$item->btnEliminar = $buttonDeleteDocumento;
		}
		return json_encode(array($documentosCliente));
	}

	public function eliminarDocumentoCliente()
	{		
		$response = json_decode($this->request->getPost('data'));
		$id = $response->id;
		$idCliente = $response->idCliente;

		$model = new ClienteDocumentoModel();
		$answer = $model->deleteById($id);
		
		$documentosCliente=json_decode($model->getByCliente($idCliente));
		foreach ($documentosCliente as $item) {
			$buttonEditDocumento = '<button type="Button" onclick="DescargarDocumento(this)" id="btnDescargarDocumento" class="btn btn-info btnEditar"  data-ruta="' . $item->Ruta . '" data-id="' . $item->ID . '" style="color:white;">'.lang('Translate.descargar').'</button>';
			$buttonDeleteDocumento = '<button type="Button" onclick="EliminarDocumento(' . $item->ID . ')" id="btnEliminarDocumento" class="btn btn-danger btnEliminar" style="color:white;">'.lang('Translate.eliminar').'</button>';
			$item->btnEditar = $buttonEditDocumento;
			$item->btnEliminar = $buttonDeleteDocumento;
		}
		return json_encode(array($documentosCliente));
	}

	public function descargarDocumento($id)
	{
		$model = new ClienteDocumentoModel();
		$datos=$model->where('ID', $id)->first();
		$ruta=$datos['RUTA'];

		$modelParametros=new ParametrosModel();
		$param=$modelParametros->first();
		$rutaServidor=$_SERVER['DOCUMENT_ROOT'];
		if ($param['CARPETA_APP']!="") {
			$rutaServidor .= '/'.$param['CARPETA_APP'];
		}
		$file=$rutaServidor.'/'. $ruta;
		$nombre=basename($file);
		if(file_exists($file)){

			header("Content-Type: text/html/force-download");
			header("Content-Disposition: attachment; filename=$nombre");
		
			// Read the file
			readfile($file);
		}
        exit;
	}

	// Borrar
	public function delete($id)
	{
		$ClienteModel = new ClienteModel();

		$answer = $ClienteModel->deleteById($id);

		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', lang('Translate.eliminado'));

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" .  $this->redireccion . '/show');
	}
	
	public function imprimirArticuloCliente($id)
	{
		$response = json_decode($this->request->getPost('data'));
		$model = new ArticuloClienteModel();		
		$datos = json_decode($model->getById($id));
		// return var_dump($datos);
		if (isset($datos[0])) {

			$numero = $datos[0]->NUMERO;
			$letra = $datos[0]->LETRA;
			$categoria = $datos[0]->CATEGORIA;
			$porcentaje = $datos[0]->PORCENTAJE;
			$nombre = $datos[0]->NOMBRE;
			$apellidos = $datos[0]->APELLIDOS;
			$dni = $datos[0]->DNI;
			$domicilio = $datos[0]->DOMICILIO;
			$poblacion = $datos[0]->POBLACION;
			$codPostal = $datos[0]->COD_POSTAL;
			$telefono = $datos[0]->TELEFONO;
			$email = $datos[0]->EMAIL;
			$cuenta = $datos[0]->CUENTA;
			$notas = $datos[0]->NOTAS;
			$creado = $datos[0]->CREATED_AT;
		}		
		//CREAMOS EL HTML PARA CONVERTIRLO EN PDF
		$html = '<!DOCTYPE html>';
		$html .= '<head>';
		$html .= '<style>';
		$html .= 'table {';
		$html .= 'border: 1px solid black; width:100%';
		$html .= '}';
		$html .= 'tbody {';
		$html .= 'width:100%';
		$html .= '}';
		$html .= '</style>';
		$html .= '</head>';
		$html .= '<body>';

		$html .= '<table style="border:none">';
		$html .= '<tbody>';
		$html .= '<tr style="text-align:center;">';  //CABECERA
		$html .= '<td colspan="5"';
		$html .= '<label style="font-size:22px;"><strong>ELIZONDOko HILERRIA</label><br><label style="font-size:16px;text-align:center">Denboraldi bateko erabilpen txartela</strong></label>';
		$html .= '</td>';
		$html .= '<td colspan="2">';
		$html .= '<img src="data:image/jpeg;base64,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" width="65" height="70">';
		$html .= '</td>';
		$html .= '<td colspan="5">';
		$html .= '<label style="font-size:22px;">CEMENTERIO de ELIZONDO</label><br><label style="font-size:16px;text-align:center">Tarjeta de uso temporal</label>';
		$html .= '</td>';
		$html .= '</tr>';
		// $html .= '<br>';
		$html .= '</tbody>';
		$html .= '</table>';
		
		// $html .= '<br>';
		$html .= '<table style="border:none">';
		$html .= '<tbody>';		
		
		$html .= '<tr>';  //CUADRO 1
			$html .= '<td colspan="12">'; 
			$html .= '<table>';
			$html .= '<tbody>';
			$html .= '<tr>';  //FILA 1
			$html .= '<td colspan="3">';
			$html .= '<strong>Zkia /</strong> Nº: ' . $numero;
			$html .= '</td>';
			$html .= '<td colspan="3">';
			$html .= '<strong>Karrika /</strong> Calle: ' . $letra;
			$html .= '</td>';
			$html .= '<td colspan="3">';
			$html .= '<strong>Maila/</strong> Categoría: ' . $categoria;
			$html .= '</td>';
			$html .= '<td colspan="3">';
			$html .= '<strong>%</strong> ' . $porcentaje;
			$html .= '</td>';			
			$html .= '</tr>';
			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</td>';
		$html .= '</tr>';

		
		$html .= '<tr>'; //FILA 2
		$html .= '<td colspan="9">';
		$html .= '<strong>Izena /</strong> Nombre: ' . $nombre . ' ' . $apellidos;
		$html .= '</td>';
		$html .= '<td colspan="3">';
		$html .= '<strong>NAN /</strong> DNI: ' . $dni;
		$html .= '</td>';
		$html .= '</tr>';			
		$html .= '<tr>'; //FILA 3
		$html .= '<td colspan="9">';
		$html .= '<strong>Helbidea /</strong> Dirección: ' . $domicilio;
		$html .= '</td>';
		$html .= '<td colspan="3">';
		$html .= '<strong>Tlf:</strong> ' . $telefono;
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '<tr>'; //FILA 4
		$html .= '<td colspan="9">';
		$html .= '<strong>Herria /</strong> Pueblo: ' . $poblacion;
		$html .= '</td>';
		$html .= '<td colspan="3">';
		$html .= '<strong>PK /</strong> CP: ' . $codPostal;
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '<tr>'; //FILA 5
		$html .= '<td colspan="12">';
		$html .= '<strong>Kontu Zkia /</strong> Nº de cuenta: ' . $cuenta;
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '<br>';
		$html .= '<tr>';  //FILA 6
		$html .= '<td colspan="2">';
		$html .= '</td>';
		$html .= '<td colspan="3">';
		$html .= '<strong>Alkatea /</strong> El Alcalde';
		$html .= '</td>';
		$html .= '<td colspan="2">';
		$html .= ' ';
		$html .= '</td>';
		$html .= '<td colspan="3">';
		$html .= '<strong>Data/</strong> Fecha: ' . $creado;
		$html .= '</td>';
		$html .= '<td colspan="2">';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td>';
		$html .= '<br>';
		$html .= '<br>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '<tr>';  //FILA 7
		$html .= '<td colspan="5">';
		$html .= '</td>';
		$html .= '<td colspan="2">';
		$html .= '<strong>Herriko telefonoa 948581450</strong>';
		$html .= '</td>';
		$html .= '<td colspan="5">';
		$html .= '</td>';		
		$html .= '</tr>';
		$html .= '<br>';

		$html .= '<tr>';  //CUADRO 2		
			$html .= '<table style="border-left:none;border-right:none">';
			$html .= '<tbody>';
			$html .= '<tr>';  //FILA 1
			$html .= '<td colspan="1">';
			$html .= '</td>';
			$html .= '<td colspan="12">';
			$html .= '<label><center><strong>Txartel honek aurrekoak baliogabetzen ditu / </strong> Esta tarjeta anula a las anteriores</center></label>';
			$html .= '</td>';
			$html .= '<td colspan="1">';
			$html .= '</td>';
			$html .= '</tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		$html .= '</tr>';
		$html .= '</tbody>';
		$html .= '</table>';

		$html .= '<table style="border:none">';
		$html .= '<tbody>';
		$html .= '<tr>';
		$html .= '<td>';
		// $html .= '<br>';
		$html .= '<p style="font-size:14px;">';
		$html .= '<strong>ELIZONDOKO HILERRIAREN ZENBAIT ARAU:</strong><br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Elizondoko Hilerria leku publikoa da, Elizondo herriaren jabetzakoa eta honen araugintza orokorraren menpean dagoena.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Lursail, panteoi eta horma-hobien jabeen betebeharra da garbiketa eta behar den segurtasun baldintzak kontserbatzea.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Jabeek beren beharrak betezen ez badituzte eta narriadura bistakoa bada, batzordeak interesatuei behar diren lanetan
											hasteko eskatuko die, 30 eguneko epean, utzikeriagatik sortutako narriadura konpontzeko asmoz.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Epea pasa ondotik hilerriko batzordeak konponketa lan hauek bere kargu har ditzake ordezkoak bilatuz. Ondoriozko kargua
											interesatuen eskuetan geldituko da, eta lanak bukatu eta 60 eguneko epean, ordainketarik egin ezean, emakidaren baliogabetzea
											gertatuko da.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Panteoien erosketa eta salmenta Elizondo herriari dagokio soilik, eta espekulazioa ekiditeko trasnferentzien grabaketa eginen du.
											Hilerriko batzordeak erosketa-salmenta egiteko eskubidea izanen du, betiere batzarraren oniritziarekin.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Urriak 15 eta azaroak 1 artean lehen eta bigarren graduko obrarik ezingo da egin.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Kuota hau ordaindu behar duten erabiltzaile guztiek kontu korronte bat eman behar diote herriari kuota kobratu ahal izateko,
											eta ez da bertzelako ordaintze modurik onartuko. Kuota azaroaren erdialdera pasatuko da normalki.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Kuota ez bada ordaintzen, erreklamazio bat bidaliko da posta ziurtatuaz; eta hurrengo urtean ere ez bada ordaintzen,
											bertze erreklamazio ziurtatu bat bidaliko da. Bi kuotak ez badira ordaintzen 30 egunetan, sistematikoki galduko du titulartasuna 
											eta Elizondoko herriaren esku geldituko da.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Elizondoko hilerriaren erabilera eta funtzionamendua arautzen duen ordenantzak herriko etxean daude eskuragarri.<br>';
		$html .= '</p>';
		$html .= '</br>';
		$html .= '<p style="font-size:14px;">';
		$html .= '<strong>APUNTES DE LA NORMATIVA DEL CEMENTERIO DE ELIZONDO:</strong><br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; El cementerio de Elizondo, es un lugar público, perteneciente al Pueblo de Elizondo y sometido a la legislación general
											aplicable a estos.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Es obligación de los titulares la limpieza y conservación en debidas condiciones de seguridad e higiene de las parcelas
											de tierra, panteones o nichos.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; En caso de que los titulares no cumplan con este deber y se aprecie estado de deterioro, la comisión requerirá a los interesados
											para que en el término de 30 días desde su comunicación, se comiencen los trabajos necesarios a fin de subsanar el deterioro
											ocasionado por su negligencia.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Transcurrido dicho plazo, la comisión del cementerio podrá realizarlos de forma subsidiaria, pasando el cargo resultante
											a los interesados y la falta de pago en un periodo de tiempo de 60 días desde la finalización de los trabajos producirá
											la anulación de la concesión.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Compra y venta de panteones. Pertenece en exclusividad al Pueblo de Elizondo, que será quien grave los traspasos para impedir
											la especulación. Tendrá potestad de realizar la compra-venta la comisión del cementerio, con la aprobación del batzarre.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; No se podrán realizar obras de primer y segundo grado entre el 15 de octubre y el 1 de noviembre.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Todos los usuarios que deban abonar esta cuota, deberán facilitarnos una cuenta bancaria donde poder cobrarla, pues no se 
											admitirá otra forma de pago. La cuota se pasará normalmente a mediados de noviembre<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; La falta de pago de dicha cuota, dará paso a una reclamación por correo certificado. Si al año siguiente tampoco paga
											se enviará otra reclamación por correo certificado y si no paga en los 30 dias siguientes las dos cuotas, pierde sistemáticamente 
											su titularidad, pasando al pueblo de Elizondo.<br>';
		$html .= '&nbsp;&nbsp;&nbsp;&nbsp; Las ordenanzas que regulan el uso del cementerio se encuentran a disposición del titular en la Herriko Etxea.<br>';
		$html .= '</p>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</tbody>';
		$html .= '</table>';

		$html .= '</body>';

		$html .= '</html>';


        // return var_dump($html);


        $options = new Options();
        $options->setIsRemoteEnabled(true);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf($options);
        // $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();       
        
        //---------------------------------------------------        
        header("Content-type:application/pdf");
        header("Content-Disposition:inline;filename=impreso.pdf");
		$output = $dompdf->output();
        echo ($output);
        exit;
	}
}