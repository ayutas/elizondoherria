<?php

namespace App\Controllers;

use App\Models\ArticuloClienteModel;
use App\Models\ClienteComentarioModel;
use App\Models\ClienteModel;
use App\Models\BancoModel;
use App\Models\ReciboModel;

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
		$ClienteModel = new ClienteModel();
		$articulosClientesModel = new ArticuloClienteModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>'Nombre');
        $column3= array ('Field'=>'Apellidos');
        $column4= array ('Field'=>'DNI');

        $columnasDatatable = array($column1,$column2,$column3,$column4);
		$data['columnsclientes'] = $columnasDatatable;
		$seccion=session()->get('seccion');
		$data['dataclientes'] = json_decode($ClienteModel->getAll($seccion));

		foreach ($data['dataclientes'] as $item) {
			$buttonEditCliente = '<form method="get" action="' . base_url() . '/' . $this->redireccion . '/edit/' . $item->ID . '"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="' . $item->ID . '" style="color:white;"  >Editar</button></form>';
			$buttonDeleteCliente = '<button id="btnEliminar" type="submit" data-toggle="model" data-target="#Eliminar" data-id="' . $item->ID . '" style="color:white;" class="btn btn-danger" >Eliminar</button>';
			$item->btnEditar = $buttonEditCliente;
			$item->btnEliminar = $buttonDeleteCliente;
		}

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

		$data['data'] = json_decode($ClienteModel->getById($id));
		$articulosClientesModel = new ArticuloClienteModel();
		$clientesComentariosModel=new ClienteComentarioModel();
		$recibosModel=new ReciboModel();

		$column1= array ('Field'=>'');
		$column2= array ('Field'=>'ID');
		$column3= array ('Field'=>'Descripción');
		$column4= array ('Field'=>'Número');
        $column5= array ('Field'=>'Letra');
        $column6= array ('Field'=>'Categoría');
        $column7= array ('Field'=>'Precio');
		$column8= array ('Field'=>'Disponible');

        $columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8);
		$data['columnsArticulos'] = $columnasDatatable;
		$data['dataArticulos'] = json_decode($articulosClientesModel->getByCliente($id));

		$data['columnsArticulosDisponibles'] = $columnasDatatable;
		$seccion=session()->get('seccion');
		$data['articulosDisponibles'] = json_decode($articulosClientesModel->getArticulosDisponibles($seccion));

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>'Comentario');
        $column3= array ('Field'=>'Creado');
        $column4= array ('Field'=>'Modificado');

        $columnasDatatableComentarios = array($column1,$column2,$column3,$column4);
		$data['columnsComentarios'] = $columnasDatatableComentarios;
		$data['dataComentarios'] = json_decode($clientesComentariosModel->getByCliente($id));
		
		foreach ($data['dataComentarios'] as $item) {
			$buttonEditComentario = '<button type="Button" onclick="EditarComentario(this)" id="btnEditarComentario" class="btn btn-primary btnEditar"  data-comentario="' . $item->Comentario . '" data-id="' . $item->ID . '" style="color:white;">Editar</button>';
			$buttonDeleteComentario = '<button type="Button" onclick="EliminarComentario(' . $item->ID . ')" id="btnEliminarComentario" class="btn btn-danger btnEliminar" style="color:white;">Eliminar</button>';
			$item->btnEditar = $buttonEditComentario;
			$item->btnEliminar = $buttonDeleteComentario;
		}

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>'Número');
		$column3= array ('Field'=>'Fecha');
		$column4= array ('Field'=>'Referencia');
		$column5= array ('Field'=>'Concepto');
        $column6= array ('Field'=>'Importe');

        $columnasDatatableRecibos = array($column1,$column2,$column3,$column4,$column5,$column6);
		$data['columnsRecibos'] = $columnasDatatableRecibos;
		$data['dataRecibos'] = json_decode($recibosModel->getByIdCliente($id));
		// return var_dump($data['dataComentarios'] );
		
		foreach ($data['dataRecibos'] as $item) {
			$buttonEditComentario = '<button type="Button" onclick="EditarRecibo(this)" id="btnEditarRecibo" class="btn btn-info btnEditar data-id="' . $item->ID . '" style="color:white;">Ver</button>';
			// $buttonDeleteComentario = '<button type="Button" onclick="EliminarComentario(' . $item->ID . ')" id="btnEliminarComentario" class="btn btn-danger btnEliminar" style="color:white;">Eliminar</button>';
			$item->btnEditar = $buttonEditComentario;
			$item->btnEliminar =''; //$buttonDeleteComentario;
		}
		// return var_dump($data['dataRecibos'] );

		// $BancoModel = new BancoModel();
		// $data['bancos']=json_decode($BancoModel->getAll());

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
		
		// $BancoModel = new BancoModel();
		// $data['bancos']=json_decode($BancoModel->getAll());

		
		$column1= array ('Field'=>'');
		$column2= array ('Field'=>'ID');
		$column3= array ('Field'=>'Descripción');
		$column4= array ('Field'=>'Número');
        $column5= array ('Field'=>'Letra');
        $column6= array ('Field'=>'Categoría');
        $column7= array ('Field'=>'Precio');
		$column8= array ('Field'=>'Disponible');

        $columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8);
		$data['columnsArticulos'] = $columnasDatatable;
		$data['columnsArticulosDisponibles'] = $columnasDatatable;
		$articulosClientesModel = new ArticuloClienteModel();
		$seccion=session()->get('seccion');
		$data['articulosDisponibles'] = json_decode($articulosClientesModel->getArticulosDisponibles($seccion));


		$data['action'] = base_url() . '/' . $this->redireccion . '/new';		
		$data['slug'] = $this->redireccion;

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
		$cuenta = $response->cuenta;
		$notas = $response->notas;
		$seccion =session()->get('seccion');
		
		$model = new ClienteModel();
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
			'CUENTA' => $cuenta,
			'NOTAS' => $notas,
			'SECCION_ID' => $seccion

		];
		if($id!=0){
			
			$newData['ID'] = $id;
			$model->save($newData);
		} else{
			$id = $model->insert($newData);
		}
		return json_encode(['id' => $id]);

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
			$buttonEditComentario = '<button type="Button" onclick="EditarComentario(this)" id="btnEditarComentario" class="btn btn-primary btnEditar"  data-comentario="' . $item->Comentario . '" data-id="' . $item->ID . '" style="color:white;">Editar</button>';
			$buttonDeleteComentario = '<button type="Button" onclick="EliminarComentario(' . $item->ID . ')" id="btnEliminarComentario" class="btn btn-danger btnEliminar" style="color:white;">Eliminar</button>';
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
			$buttonEditComentario = '<button type="Button" onclick="EditarComentario(this)" id="btnEditarComentario" class="btn btn-primary btnEditar"  data-comentario="' . $item->Comentario . '" data-id="' . $item->ID . '" style="color:white;">Editar</button>';
			$buttonDeleteComentario = '<button type="Button" onclick="EliminarComentario(' . $item->ID . ')" id="btnEliminarComentario" class="btn btn-danger btnEliminar" style="color:white;">Eliminar</button>';
			$item->btnEditar = $buttonEditComentario;
			$item->btnEliminar = $buttonDeleteComentario;
		}
		return json_encode(array($comentariosCliente));
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
		$html .= '<img src="' . base_url() . '/assets/images/Logo.jpg" width="65" height="70">';
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
        header("Content-Disposition:inline;filename=consulta.pdf");
		$output = $dompdf->output();
        echo ($output);
        exit;
	}
}