<?php

namespace App\Controllers;

use App\Models\ReciboModel;
use App\Models\ArticuloClienteModel;
use XMLWriter;

class Recibos extends BaseController
{
	protected $redireccion = "recibos";
	protected $redireccionView = "recibos";

	// Ver
	public function show()
	{
		echo view('dashboard/header');
		echo view($this->redireccionView . '/opciones');
		echo view('dashboard/footer');
	}

	public function consultas()
	{

		helper(['form']);
		$uri = service('uri');

		$data = [];
		$model = new ReciboModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>'Fecha');
		$column3= array ('Field'=>'Número');
		$column4= array ('Field'=>'Ref');
		$column5= array ('Field'=>'Concepto');
		$column6= array ('Field'=>'Nombre');
		$column7= array ('Field'=>'DNI');
		$column8= array ('Field'=>'Artículo');
		$column9= array ('Field'=>'Categoría');
		$column10= array ('Field'=>'Importe');
		$column11= array ('Field'=>'Cuenta');
		$column12= array ('Field'=>'Creado');
		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9,$column10,$column11,$column12);
		$data['columns'] = $columnasDatatable;
		$data['data'] = json_decode($model->getAll());

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

	public function edit($id = "")
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$model = new UsuarioModel();

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

				'nombre' =>  'required|min_length[3]|max_length[100]',
				'usuario' =>  'required|min_length[3]|max_length[100]',
				// 'contrasena' =>  'required|min_length[3]|max_length[100]',
			];

			// Comprobación de las validaciones
			if (!$this->validate($rules)) {

				$newData = [
					'NOMBRE' => $this->request->getVar('nombre'),
					'AP1' => $this->request->getVar('apellido1'),
					'AP2' => $this->request->getVar('apellido2'),
					'ID_DELEGACION' => $this->request->getVar('id_delegacion'),
					'ADMINISTRADOR' => $this->request->getVar('admin'),
					'USUARIO' => $this->request->getVar('usuario'),
					'CONTRASENA' => $this->request->getVar('contrasena')
				];

				// Guardamos el error para mostrar en la vista
				$data['validation'] = $this->validator;

			} else {

				if ($this->request->getVar('admin') == null) {
					$admin = 0;
				} else {
					$admin = 1;
				}
				if ($this->request->getVar('contrasena') != "") {
					// Acutlizar usuario
					$newData = [
						'ID' => $id,
						'NOMBRE' => $this->request->getVar('nombre'),
						'AP1' => $this->request->getVar('apellido1'),
						'AP2' => $this->request->getVar('apellido2'),
						'ADMINISTRADOR' => $admin,
						'USUARIO' => $this->request->getVar('usuario'),
						'CONTRASENA' => $this->request->getVar('contrasena')

					];
				} else {
					$newData = [
						'ID' => $id,
						'NOMBRE' => $this->request->getVar('nombre'),
						'AP1' => $this->request->getVar('apellido1'),
						'AP2' => $this->request->getVar('apellido2'),
						'ADMINISTRADOR' => $admin,
						'USUARIO' => $this->request->getVar('usuario'),
					];
				}

				//Guardamos
				$model->save($newData);

				// Creamos una session para mostrar el mensaje de registro correcto
				$session = session();
				$session->setFlashdata('success', 'Actualizado correctamente');

				// Redireccionamos a la pagina
				return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
			}
		}

		$data['data'] = json_decode($model->getData($id));

		$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;
		$data['slug'] =  $this->redireccion;
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/edit', $data);
		echo view('dashboard/footer', $data);
	}

	public function newrecibos()
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$model = new ArticuloClienteModel();
		
		$column1= array ('Field'=>'');
		$column2= array ('Field'=>'');
		$column3= array ('Field'=>'ID');
		$column4= array ('Field'=>'Nombre');
		$column5= array ('Field'=>'DNI');
		$column6= array ('Field'=>'Número');
		$column7= array ('Field'=>'Categoría');
		$column8= array ('Field'=>'Importe');
		$column9= array ('Field'=>'Cuenta');

		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9);
		$data['columns'] = $columnasDatatable;
		$data['data'] = json_decode($model->getAll());



		$data['action'] = base_url() . '/' . $this->redireccion . '/new';		
		$data['slug'] = $this->redireccion;

		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/new', $data);
		echo view('dashboard/footer', $data);
	}

	public function crearxml()
	{
		//Variable con todos los datos a pasar a las vistas
		$data = [];

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		
		$data['slug'] = $this->redireccion;

		echo view('dashboard/header');
		echo view($this->redireccionView . '/newxml');
		echo view('dashboard/footer');
	}


	// Borrar
	public function delete($id)
	{
		$usuarioId=session()->get('id');
		$model = new ReciboModel();
		$answer = $model->deleteById($id,$usuarioId);
		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success', 'Eliminado correctamente');

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}

	public function CrearRecibos()
	{		
		$response = json_decode($this->request->getPost('data'));
		$fecha = $response->fecha;
		$ref = $response->ref;
		$concepto=$response->concepto;
		$ids = implode(',',$response->arrayIds);
		// return var_dump($fecha,$ref,$ids);
		$model = new ReciboModel();
		return $model->insertar($fecha,$ref,$concepto,$ids);
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}

	Public function crearRecibosXML()
    {
		$response = json_decode($this->request->getPost('data'));
		$ref = $response->ref;
		$ref="PUBLI BESTAK 2022";
		$numRecibos=0;

		$model = new ReciboModel();
		$datosCabecera=json_decode($model->ObtenerDatosCabeceraRemesa($ref));
		
		
		if (isset($datosCabecera[0])) {

			$numRecibos = $datosCabecera[0]->CUANTOS;
			$totalImportes = $datosCabecera[0]->TOTAL;
			$fechaVencimiento = date_format(date_create($datosCabecera[0]->FECHA),'Y-m-d');
			$numremesa=$ref;
			$fechaCreacion=date('Ymd');
			$nombreEmpresa="LUGAR DE ELIZONDO";
			$domicilioEmpresa="Jaime Urrutia 4";
			$cpEmpresa="31700";
			$poblacionEmpresa="Elizondo";
			//hilerri
			$numCuentaEmpresa="ES0630080043142303410910";
			//herria
			$numCuentaEmpresa="ES2330080043171214211813";
			$bicEmpresa="BCOEESMM";//CODIGO SWIFT DEL BANCO empresa
			$identificadorEmpresa="ES71000P3105008A";//Identificador calculo segun CIF -- PAIS+DIGITOS_CONTROL97_10(CIF+ES+00+000+CIF)+CIF
		}

		if($numRecibos==0)
		{
			$session = session();
			$session->setFlashdata('error', 'No se ha encontrado ningún recibo con la referencia introducida');
			exit;
		}

		$datosLineas=json_decode($model->ObtenerDatosLineasRemesa($ref));
		// return var_dump($datosLineas);
		$file=basename('recibos.xml');

		$xw = new XMLWriter();
		$xw->openURI($file);
		// $xw->openURI('php://output');
		// $xw->openMemory();
		$xw->startDocument("1.0", "utf-8");
			$xw->startElement("Document");
				$xw->writeAttribute("xmlns","urn:iso:std:iso:20022:tech:xsd:pain.008.001.02");
				$xw->startElement("CstmrDrctDbtInitn");
					$xw->startElement("GrpHdr");
						$xw->writeElement("MsgId",$numremesa); //numero remesa
						$xw->writeElement("CreDtTm",$fechaCreacion); //fecha creacion
						$xw->writeElement("NbOfTxs",$numRecibos); //numero de recibos
						$xw->writeElement("CtrlSum",$totalImportes); //total de importe recibos
						$xw->startElement("InitgPty");
						$xw->writeElement("Nm",$nombreEmpresa); //nombre empresa
							$xw->startElement("Id");
								$xw->startElement("OrgId");
									$xw->startElement("Othr");
										$xw->writeElement("Id",$identificadorEmpresa); //Identificador calculo segun CIF -- PAIS+DIGITOS_CONTROL97_10(CIF+ES+00+000+CIF)+CIF
									$xw->endElement();
								$xw->endElement();
							$xw->endElement();
						$xw->endElement();
					$xw->endElement(); //fin CstmrDrctDbtInitn
					$xw->startElement("PmtInf");
						$xw->writeElement("PmtInfId",$numremesa); //numero remesa
						$xw->writeElement("PmtMtd","DD"); 
						$xw->writeElement("BtchBookg","true");
						$xw->writeElement("NbOfTxs",$numRecibos); //numero de recibos
						$xw->writeElement("CtrlSum",$totalImportes); //total de importe recibos
						$xw->startElement("PmtTpInf");
							$xw->startElement("SvcLvl");
								$xw->writeElement("Cd","SEPA");
							$xw->endElement();
							$xw->startElement("LclInstrm");
								$xw->writeElement("Cd","CORE");
							$xw->endElement();
							$xw->writeElement("SeqTp","RCUR");
						$xw->endElement(); //fin PmtTpInf
						$xw->writeElement("ReqdColltnDt",$fechaVencimiento); //fecha vencimiento
						$xw->startElement("Cdtr");
							$xw->writeElement("Nm",$nombreEmpresa); //nombre empresa
							$xw->startElement("PstlAdr");
								$xw->writeElement("Ctry","ES"); //pais empresa
								$xw->writeElement("AdrLine",$domicilioEmpresa); //dom empresa
								$xw->writeElement("AdrLine",$cpEmpresa . ' ' . $poblacionEmpresa); //cp y pob empresa
							$xw->endElement(); //fin PstlAdr
						$xw->endElement(); //fin Cdtr
						$xw->startElement("CdtrAcct");
							$xw->startElement("Id");
								$xw->writeElement("IBAN",$numCuentaEmpresa); //num cuenta empresa
							$xw->endElement(); //fin Id
						$xw->endElement(); //fin CdtrAcct
						$xw->startElement("CdtrAgt");
							$xw->startElement("FinInstnId");
								$xw->writeElement("BIC",$bicEmpresa); //CODIGO SWIFT DEL BANCO empresa
							$xw->endElement(); //fin FinInstnId
						$xw->endElement(); //fin CdtrAgt
						$xw->writeElement("ChrgBr","SLEV");
						$xw->startElement("CdtrSchmeId");
							$xw->startElement("Id");
								$xw->startElement("PrvtId");
									$xw->startElement("Othr");
										$xw->writeElement("Id",$identificadorEmpresa);	//Identificador calculo segun CIF -- PAIS+DIGITOS_CONTROL97_10(CIF+ES+00+000+CIF)+CIF
										$xw->startElement("SchmeNm");
											$xw->writeElement("Prtry","SEPA");
										$xw->endElement(); //fin SchmeNm
									$xw->endElement(); //fin Othr
								$xw->endElement(); //fin PrvtId
							$xw->endElement(); //fin Id
						$xw->endElement(); //fin CdtrSchmeId
						//bucle por cada recibo
						foreach($datosLineas as $linea){
							$numRecibo = $linea->NUMRECIBO;
							$importeRecibo = $linea->IMPORTE;
							$cifRecibo = $linea->DNI;
							$fechaRecibo = $linea->FECHA;
							// $bicRecibo = $linea->BICRECIBO;
							$nombreClienteRecibo = $linea->CLIENTE;
							$domicilioRecibo = $linea->DOMICILIO;
							$cpRecibo = $linea->COD_POSTAL;
							$poblacionRecibo = $linea->POBLACION;
							$cuentaRecibo = $linea->CUENTA;
							
							
							if ($cuentaRecibo!=""){
								$xw->startElement("DrctDbtTxInf");
									$xw->startElement("PmtId");
										$xw->writeElement("EndToEndId",$numRecibo); //NUMERO RECIBO
									$xw->endElement(); //fin PmtId
									$xw->startElement("InstdAmt");
										$xw->writeAttribute("Ccy","EUR"); //ATRIBUTO Ccy =EUR
										$xw->text($importeRecibo); //IMPORTE RECIBO
									$xw->endElement(); //fin InstdAmt
									$xw->startElement("DrctDbtTx");
										$xw->startElement("MndtRltdInf");
											$xw->writeElement("MndtId",$cifRecibo); //REFERENCIA MANDATO (DNI/CIF)
											$xw->writeElement("DtOfSgntr",$fechaRecibo); //FECHA RECEP MANDATO
											$xw->writeElement("AmdmntInd","false");
										$xw->endElement(); //fin MndtRltdInf
									$xw->endElement(); //fin DrctDbtTx
									// $xw->startElement("DbtrAgt");
									// 	$xw->startElement("FinInstnId");
									// 		$xw->writeElement("BIC",$bicRecibo); //CODIGO SWIFT DEL BANCO
									// 	$xw->endElement(); //fin FinInstnId
									// $xw->endElement(); //fin DbtrAgt
									$xw->startElement("Dbtr");
										$xw->writeElement("Nm",$nombreClienteRecibo); //NOMBRE CLIENTE
										$xw->startElement("PstlAdr");
											$xw->writeElement("Ctry","ES"); //PAIS CLIENTE
											if($domicilioRecibo!=""){
												$xw->writeElement("AdrLine",$domicilioRecibo); //DOM CLIENTE
											}
											if($cpRecibo!="" || $poblacionRecibo!=""){
												$xw->writeElement("AdrLine",$cpRecibo . ' ' . $poblacionRecibo); //CP Y POBLACION CLIENTE
											}
										$xw->endElement(); //fin PstlAdr
										$xw->startElement("Id");
											$xw->startElement("OrgId");
												$xw->startElement("Othr");
													$xw->writeElement("Id",$cifRecibo); //DNI/CIF CLIENTE
												$xw->endElement(); //fin Othr
											$xw->endElement(); //fin OrgId
										$xw->endElement(); //fin Id
									$xw->endElement(); //fin Dbtr	
									$xw->startElement("DbtrAcct");
										$xw->startElement("Id");
											$xw->writeElement("IBAN",$cuentaRecibo); //CUENTA A COBRAR
										$xw->endElement(); //fin Id
									$xw->endElement(); //fin DbtrAcct
									$xw->startElement("RmtInf");
										$xw->writeElement("Ustrd",$numRecibo); //CONCEPTO
									$xw->endElement(); //fin RmtInf
								$xw->endElement(); //fin DrctDbtTxInf								
							}
							//fin bucle
						}
					$xw->endElement(); //fin PmtInf
				$xw->endElement();
			$xw->endElement();
		$xw->endDocument();
		$xw->flush();
		// echo $xw->outputMemory();
		unset($xw); //important!
		$this->DescargarXML();
        // echo ($output);
		// $fileName = basename('fichero.txt');
		// $filePath = 'files/'.$fileName;

		
		if(file_exists($file)){
			header('Content-Description: File Transfer');
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename="'.$file.'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
			
		// 	// // Define headers
		// 	// header("Cache-Control: public");
		// 	// header("Content-Description: File Transfer");
		// 	// header("Content-Disposition: attachment; filename=test.xml");
		// 	// header("Content-Type: xml");
		
		// 	// // Read the file
		// 	// readfile('test.xml');
		// }else{
		// 	echo 'The file does not exist.';
		}
        exit;
		// // echo $xw->outputMemory();


    }

	public function DescargarXML()
	{
		$file=basename('recibos.xml');
		if(file_exists($file)){
			// header('Content-Description: File Transfer');
			// header('Content-Type: text/xml');
			// header('Content-Disposition: attachment; filename="'.$file.'"');
			// header('Expires: 0');
			// header('Cache-Control: must-revalidate');
			// header('Pragma: public');
			// header('Content-Length: ' . filesize($file));
			// readfile($file);
			// exit;
			
			// Define headers
			// header("Cache-Control: public");
			// header("Content-Description: File Transfer");
			// header("Content-Disposition: attachment; filename=$file");
			// header("Content-Type: text/xml");

			header("Content-Type: text/html/force-download");
			header("Content-Disposition: attachment; filename=$file");
		
			// Read the file
			readfile($file);
			// return var_dump('hola');

		}else{
			
		}
        exit;
	}
}