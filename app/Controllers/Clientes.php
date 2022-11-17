<?php

namespace App\Controllers;

use App\Models\ArticuloClienteModel;
use App\Models\ClienteModel;
use App\Models\BancoModel;

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

		$data['columnsclientes'] = json_decode($ClienteModel->getAll());
		$data['dataclientes'] = json_decode($ClienteModel->getAll());

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

		$data['columnsArticulos'] = json_decode($articulosClientesModel->getByCliente($id));
		$data['dataArticulos'] = json_decode($articulosClientesModel->getByCliente($id));

		$column1= array ('Field'=>'');
		$column2= array ('Field'=>'ID');
		$column3= array ('Field'=>'Número');
        $column4= array ('Field'=>'Letra');
        $column5= array ('Field'=>'Categoría');
        $column6= array ('Field'=>'Precio');

        $columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6);
		$data['columnsArticulosDisponibles'] = $columnasDatatable;
		$data['articulosDisponibles'] = json_decode($articulosClientesModel->getArticulosDisponibles());

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
		
		$BancoModel = new BancoModel();
		$data['bancos']=json_decode($BancoModel->getAll());

		
		$column1= array ('Field'=>'');
		$column2= array ('Field'=>'Número');
        $column3= array ('Field'=>'Letra');
        $column4= array ('Field'=>'Categoría');
        $column5= array ('Field'=>'Precio');

        $columnasDatatable = array($column1,$column2,$column3,$column4,$column5);
		$data['columnsArticulosDisponibles'] = $columnasDatatable;
		$articulosClientesModel = new ArticuloClienteModel();
		$data['articulosDisponibles'] = json_decode($articulosClientesModel->getArticulosDisponibles());


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
		$iban = $response->iban;
		$banco = $response->banco;
		$agencia = $response->agencia;
		$cuenta = $response->cuenta;
		$notas = $response->notas;

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
			'IBAN' => $iban,
			'BANCO_ID' => $banco,
			'AGENCIA' => $agencia,
			'CUENTA' => $cuenta,
			'NOTAS' => $notas

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

		$model = new ArticuloClienteModel();
		$newData = [
			'ARTICULO_ID' => $idArticulo,
			'CLIENTE_ID' => $idCliente
		];
		$id = $model->insert($newData);
		$artDisponibles= json_decode($model->getArticulosDisponibles());
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
		$artDisponibles= json_decode($model->getArticulosDisponibles());
		$articulosCliente=json_decode($model->getByCliente($idCliente));
		return json_encode(array($articulosCliente,$artDisponibles));
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
			$nombre = $datos[0]->NOMBRE;
			$apellidos = $datos[0]->APELLIDOS;
			$dni = $datos[0]->DNI;
			$domicilio = $datos[0]->DOMICILIO;
			$poblacion = $datos[0]->POBLACION;
			$codPostal = $datos[0]->COD_POSTAL;
			$telefono = $datos[0]->TELEFONO;
			$email = $datos[0]->EMAIL;
			$iban = $datos[0]->IBAN;
			$codBanco = $datos[0]->COD_BANCO;
			$nombreBanco = $datos[0]->NOMBRE_BANCO;
			$agencia = $datos[0]->AGENCIA;
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
		$html .= '<table>';
		$html .= '<tbody>';
		$html .= '<tr>';  //FILA 1
		$html .= '<td colspan="4">';
		$html .= '<strong>Zkia /</strong> Nº: ' . $numero;
		$html .= '</td>';
		$html .= '<td colspan="4">';
		$html .= '<strong>Karrika /</strong> Calle: ' . $letra;
		$html .= '</td>';
		$html .= '<td colspan="4">';
		$html .= '<strong>Maila/</strong> Categoría: ' . $categoria;
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
		$html .= '<strong>Kontu Zkia /</strong> Nº de cuenta: ' . $nombreBanco . ' ' . $iban.$codBanco.$agencia.$cuenta;
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '<tr>';  //FILA 6
		$html .= '<td colspan="3">';
		$html .= '<strong>Alkatea /</strong> El Alcalde';
		$html .= '</td>';
		$html .= '<td colspan="5">';
		$html .= ' ';
		$html .= '</td>';
		$html .= '<td colspan="4">';
		$html .= '<strong>Data/</strong> Fecha: ' . $creado;
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