<?php

namespace App\Controllers;

use App\Models\ReciboModel;
use App\Models\ReciboLineaModel;
use App\Models\ArticuloClienteModel;
use App\Models\ParametrosModel;
use App\Models\SeccionModel;
use XMLWriter;

class Recibos extends BaseController
{
	protected $redireccion = "recibos";
	protected $redireccionView = "recibos";

	// Ver
	public function show()
	{
		$data['migapan']=lang('Translate.'.$this->redireccion);
		echo view('dashboard/header',$data);
		echo view($this->redireccionView . '/opciones',$data);
		echo view('dashboard/footer',$data);
	}

	public function consultas()
	{

		helper(['form']);
		$uri = service('uri');

		$data = [];
		$model = new ReciboModel();

		$column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.fecha'));
		$column3= array ('Field'=>lang('Translate.numero'));
		$column4= array ('Field'=>lang('Translate.referencia'));
		$column5= array ('Field'=>lang('Translate.concepto'));
		$column6= array ('Field'=>lang('Translate.nombre'));
		$column7= array ('Field'=>lang('Translate.dni'));
		$column8= array ('Field'=>lang('Translate.articulo'));
		$column9= array ('Field'=>lang('Translate.categoria'));
		$column10= array ('Field'=>lang('Translate.importe'));
		$column11= array ('Field'=>lang('Translate.cuenta'));
		$column12= array ('Field'=>lang('Translate.created'));
		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9,$column10,$column11,$column12);
		$data['columns'] = $columnasDatatable;
		$seccion=session()->get('seccion');
		$data['data'] = json_decode($model->getAll($seccion));

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

		// Cargamos los helpers de formularios
		helper(['form']);
		$uri = service('uri');

		$model = new ReciboModel();
		$modelLineas = new ReciboLineaModel();

		$data['id'] = $id;
		
		$data['data'] = json_decode($model->getById($id));

		$data['lineasRecibo'] = json_decode($modelLineas->getByIdRecibo($id));
		// return var_dump($data['data']);

		$data['action'] = base_url() . '/' . $this->redireccion . '/edit/' . $id;
		$data['slug'] =  $this->redireccion;
		$data['migapan']=lang('Translate.'.$this->redireccion);
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
		$column4= array ('Field'=>lang('Translate.nombre'));
		$column5= array ('Field'=>lang('Translate.dni'));
		$column6= array ('Field'=>lang('Translate.numero'));
		$column7= array ('Field'=>lang('Translate.categoria'));
		$column8= array ('Field'=>lang('Translate.importe'));
		$column9= array ('Field'=>lang('Translate.cuenta'));

		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9);
		$data['columns'] = $columnasDatatable;
		$seccion=session()->get('seccion');
		$data['data'] = json_decode($model->getAll($seccion));



		$data['action'] = base_url() . '/' . $this->redireccion . '/new';		
		$data['slug'] = $this->redireccion;
		$data['migapan']=lang('Translate.'.$this->redireccion);
		echo view('dashboard/header', $data);
		echo view($this->redireccionView . '/new', $data);
		echo view('dashboard/footer', $data);
	}

	public function guardarRecibo()
	{
		
		$response = json_decode($this->request->getPost('data'));
		$id = $response->id;
		$cobrado = $response->cobrado;
		
		if ($cobrado){
			$cobrado=date("Y-m-d H:i:s");
		} else{
			$cobrado=null;
		}

		$model = new ReciboModel();
		$newData = [
			'ID' => $id,
			'COBRADO' => $cobrado
		];
		$model->save($newData);
		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success',  lang('Translate.actualizado'));

		// Redireccionamos a la pagina de login
		return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}

	// Borrar
	public function delete($id)
	{
		$usuarioId=session()->get('id');
		$model = new ReciboModel();
		$answer = $model->deleteById($id,$usuarioId);
		// Creamos una session para mostrar el mensaje de registro correcto
		$session = session();
		$session->setFlashdata('success',  lang('Translate.eliminado'));

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
		$result=json_decode($model->existeRef($ref));		
		if($result[0]->CUANTOS>0){			
			return json_encode(array('Referencia utilizada en anteriores recibos, introduzca una nueva'));
		}

		$model->insertar($fecha,$ref,$concepto,$ids);
		
		$modelLineas = new ReciboLineaModel();
		$modelLineas->insertar($ref,$ids);
		$this->crearRecibosXML($ref);

		$modelParametros=new ParametrosModel();
		$carpetaApp=json_decode($modelParametros->getAll());
		$ruta= base_url();
		if(isset($carpetaApp[0])){
			$ruta .= '/'.$carpetaApp[0]->CARPETA_APP;
		}
		$ruta .= '/recibos/';
		return json_encode(array(true,$ruta));
		// return redirect()->to(base_url() . "/" . $this->redireccion . '/show');
	}

	Public function crearRecibosXML($ref)
    {		
		$numRecibos=0;
		$seccion=session()->get('seccion');

		$modelSeccion=new SeccionModel();
		$model = new ReciboModel();
		$datosCabecera=json_decode($model->ObtenerDatosCabeceraRemesa($ref));
		
		if (isset($datosCabecera[0])) {

			$numRecibos = $datosCabecera[0]->CUANTOS;
			$totalImportes = $datosCabecera[0]->TOTAL;
			$fechaVencimiento = date_format(date_create($datosCabecera[0]->FECHA),'Y-m-d');
			$numremesa=$ref;
			$fechaCreacion=date('Ymd');
			$datosEmpresa=$modelSeccion->where('ID', $seccion)->first();
			if (isset($datosEmpresa)) {
				$nombreEmpresa=$datosEmpresa['NOMBRE']; //"LUGAR DE ELIZONDO";
				$domicilioEmpresa=$datosEmpresa['DOMICILIO']; //"Jaime Urrutia 4";
				$cpEmpresa=$datosEmpresa['CPOSTAL']; //"31700";
				$poblacionEmpresa=$datosEmpresa['POBLACION']; //"Elizondo";
				//hilerri
				$numCuentaEmpresa=$datosEmpresa['NUMCUENTA']; //"ES0630080043142303410910";
				//herria
				//$numCuentaEmpresa="ES2330080043171214211813";
				$bicEmpresa=$datosEmpresa['BIC']; //"BCOEESMM";//CODIGO SWIFT DEL BANCO empresa
				$identificadorEmpresa=$datosEmpresa['IDENTIFICADOR']; //"ES71000P3105008A";//Identificador calculo segun CIF -- PAIS+DIGITOS_CONTROL97_10(CIF+ES+00+000+CIF)+CIF
			}
		}


		$datosLineas=json_decode($model->ObtenerDatosLineasRemesa($ref));
		// return var_dump($datosLineas);
		$file=basename('recibos_' . $ref . '.xml');
		
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
							$concepto = $linea->CONCEPTO;
							$importeRecibo = $linea->IMPORTE;
							$cifRecibo = $linea->DNI;
							$fechaRecibo = $linea->FECHA;
							// $bicRecibo = $linea->BICRECIBO;
							$nombreClienteRecibo = $linea->NOMBRE;
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
		return json_encode(array(true));
		// $this->DescargarXML();
        // // echo ($output);
		// // $fileName = basename('fichero.txt');
		// // $filePath = 'files/'.$fileName;

		
		// if(file_exists($file)){
		// 	header('Content-Description: File Transfer');
		// 	header('Content-Type: text/xml');
		// 	header('Content-Disposition: attachment; filename="'.$file.'"');
		// 	header('Expires: 0');
		// 	header('Cache-Control: must-revalidate');
		// 	header('Pragma: public');
		// 	header('Content-Length: ' . filesize($file));
		// 	readfile($file);
		// 	exit;
			
		// // 	// // Define headers
		// // 	// header("Cache-Control: public");
		// // 	// header("Content-Description: File Transfer");
		// // 	// header("Content-Disposition: attachment; filename=test.xml");
		// // 	// header("Content-Type: xml");
		
		// // 	// // Read the file
		// // 	// readfile('test.xml');
		// // }else{
		// // 	echo 'The file does not exist.';
		// }
        // exit;
		// // echo $xw->outputMemory();


    }

	public function DescargarXML($ref)
	{
		$file=basename('recibos_' . $ref . '.xml');
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
			
			//delete file
			unlink($file);

		}else{
			
		}
        exit;
	}
}