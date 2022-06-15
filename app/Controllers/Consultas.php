<?php namespace App\Controllers;

use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use App\Models\DelegacionModel;
use App\Models\DelegacionLineaModel;
use App\Models\FormularioModel;
use App\Models\GrupoModel;
use App\Models\ArticuloModel;
use App\Models\ItemModel;
use App\Models\ArticuloFormularioGrupoItemModel;
use App\Models\MotivoModel;
use App\Models\RegistroFormularioModel;
use App\Models\RegistroFormularioGrupoModel;
use App\Models\RegistroItemModel;

use Dompdf\Dompdf;
use Dompdf\Options;

class Consultas extends BaseController
{
    protected $redireccion = "consultas";
	protected $redireccionView = "consultas";

         
	public function show()
    {          
        $ModelFormularios=new FormularioModel();        
		$data['formularios']= json_decode($ModelFormularios->getAll());

        $ModelGrupos=new GrupoModel();
		$data['grupos']= json_decode($ModelGrupos->getAll());        

		$ModelMotivos=new MotivoModel();
		$data['motivos']= json_decode($ModelMotivos->getAll());		
		
        $ModelDelegacion=new DelegacionModel();
        $data['delegaciones'] = json_decode($ModelDelegacion->getAll());
        
        $ModelDelegacionLineas=new DelegacionLineaModel();
        $data['lineas'] = json_decode($ModelDelegacionLineas->getAll());
        //return var_dump($data['lineas']);
		
		$ModelArticulos =new ArticuloModel();
		$data['articulos'] = json_decode($ModelArticulos->getAll());

                
        $fechaDesde=date("Y-m-d",strtotime("-1 month"));
        $fechaHasta=date('Y-m-d');
        $results= $this->consultaBusqueda(0,'','','',0,0,$fechaDesde,$fechaHasta,'00:00','00:00','','','','',0,0);

        $data['columns']= json_decode($results);		
        $data['data']= json_decode($results);	
        
        echo view('dashboard/header',$data);   
        echo view("dashboard/consultas",$data);
        echo view("dashboard/footer",$data);
    }

    public function buscar_OLD()
    {
        $response = json_decode($this->request->getPost('data'));
		
        $idDelegacion=$response->idDelegacion;
		$idDelegacionLinea = $response->idDelegacionLinea;
		$idFormulario = $response->idFormulario;
		$idGrupo = $response->idGrupo;
		$idArticulo = $response->idArticulo;
		$idMotivo = $response->idMotivo;
        $fechaDesde=$response->fechaDesde;
        $fechaHasta=$response->fechaHasta;
        $horaDesde=$response->horaDesde;
        $horaHasta=$response->horaHasta;
		$lote = $response->lote;
		$caducidad = $response->caducidad;
		$documento = $response->documento;
		$entidad = $response->entidad;
        $hayIncidencia= $response->hayIncidencia;
        //   return var_dump($idDelegacionLinea);


        $db = \Config\Database::connect();

        $usarAnd=false;

        $sql = "SELECT distinct TRF.ID AS 'ID',                        
                        -- TRF.ID_USUARIO AS 'Id usuario',
                        CONCAT_WS(' ',TU.NOMBRE, TU.AP1, TU.AP2)  AS 'Nombre usuario',
                        -- TU.ID_DELEGACION AS 'Id delegación',
                        -- TD.DESCRIPCION AS 'Nombre delegación',
                        -- TRF.ID_ARTICULO As 'Id articulo',                        
                        TA.REFERENCIA AS 'Referencia',
                        TA.DESCRIPCION AS 'Descripción',
                        -- TRF.ID_FORMULARIO AS 'Id formulario',
                        TF.NOMBRE AS 'Checklist',
                        -- TF.CAPTURA_ARTICULO AS 'Captura articulo',
                        -- TF.CAPTURA_CADUCIDAD AS 'Captura caducidad',
                        -- TF.CAPTURA_DOCUMENTO AS 'Captura documento',
                        -- TF.CAPTURA_ENTIDAD AS 'Captura entidad',
                        -- TF.CAPTURA_LOTE AS 'Captura lote',
                        -- TF.CAPTURA_MOTIVO_CHEQUEO AS 'Captura motivo chequeo',
                        -- TRF.ID_MOTIVO AS 'Id motivo',
                        TM.NOMBRE AS 'Motivo',
                        TRF.FECHA AS 'Fecha',
                        -- TRF.LOTE AS 'Lote',
                        -- TRF.CADUCIDAD AS 'Caducidad',
                        -- TRF.DOCUMENTO AS 'Documento',
                        -- TRF.ENTIDAD AS 'Entidad',
                        TRF.OBSERVACIONES AS 'Observaciones',
                        TRF.SITUACION AS 'Situacion'
                        
                FROM tbl_registros_formularios TRF     
                    INNER JOIN tbl_usuarios TU ON TRF.ID_USUARIO=TU.ID   
                    INNER JOIN tbl_delegaciones TD ON TU.ID_DELEGACION=TD.ID
                    INNER JOIN tbl_articulos TA ON TRF.ID_ARTICULO=TA.ID                    
                    INNER JOIN tbl_formularios TF ON TRF.ID_FORMULARIO=TF.ID
                    LEFT JOIN tbl_motivos TM ON TRF.ID_MOTIVO=TM.ID               
                    LEFT JOIN tbl_registros_formularios_grupos TRFG ON TRF.ID=TRFG.ID_REGISTRO
                    INNER JOIN tbl_registros_items TRI ON TRF.ID=TRI.ID_REGISTRO";
                    if(!empty($idGrupo)){
                        $sql= $sql. " INNER JOIN tbl_formularios_grupos_items TFGI ON TRI.ID_FORMULARIO_GRUPO_ITEM=TFGI.ID";
                    }
                    if($idDelegacion!="0"){            
                        $sql= $sql. " INNER JOIN tbl_delegaciones_lineas TDL ON TRF.ID_DELEGACION_LINEA=TDL.ID
                        WHERE TDL.ID_DELEGACION=$idDelegacion";
                        $usarAnd=true;
                    }
                    if(!empty($idDelegacionLinea))
                    {
                        if($usarAnd){
                            $sql= $sql. " AND (";
                        } else
                        {
                            $sql= $sql. " WHERE (";
                            $usarAnd=true;
                        }
                        $i=count($idDelegacionLinea);
                        foreach($idDelegacionLinea as $item){
                            $sql= $sql. " TRF.ID_DELEGACION_LINEA=$item";
                            if($i>1){$sql= $sql . " OR ";}
                            $i--;                                
                        }
                        $sql= $sql. ")";
                    }
                    if(!empty($idFormulario))
                    {
                        if($usarAnd){
                            $sql= $sql. " AND (";
                        } else
                        {
                            $sql= $sql. " WHERE (";
                            $usarAnd=true;
                        }
                        $i=count($idFormulario);
                        foreach($idFormulario as $item){
                            $sql= $sql. " TRF.ID_FORMULARIO=$item";
                            if($i>1){$sql= $sql . " OR ";}
                            $i--;                                
                        }
                        $sql= $sql. ")";
                    }
                    if(!empty($idGrupo))
                    {
                        if($usarAnd){
                            $sql= $sql. " AND (";
                        } else
                        {
                            $sql= $sql. " WHERE (";
                            $usarAnd=true;
                        }
                        $i=count($idGrupo);
                        foreach($idGrupo as $item){
                            $sql= $sql. " TFGI.ID_GRUPO=$item";
                            if($i>1){$sql= $sql . " OR ";}
                            $i--;                                
                        }
                        $sql= $sql. ")";
                    }                    
                    if($idArticulo!="0")
                    {
                        if($usarAnd){
                            $sql= $sql. " AND TRF.ID_ARTICULO=$idArticulo";
                        } else
                        {
                            $sql= $sql. " WHERE TRF.ID_ARTICULO=$idArticulo";
                            $usarAnd=true;
                        }
                    }
                    if($idMotivo!="0")
                    {
                        if($usarAnd){
                            $sql= $sql. " AND TRF.ID_MOTIVO=$idMotivo";
                        } else
                        {
                            $sql= $sql. " WHERE TRF.ID_MOTIVO=$idMotivo";
                            $usarAnd=true;
                        }
                    }
                    if($lote!="")
                    {
                        if($usarAnd){
                            $sql= $sql. " AND TRF.LOTE='$lote'";
                        } else
                        {
                            $sql= $sql. " WHERE TRF.LOTE='$lote'";
                            $usarAnd=true;
                        }
                    }  
                    if($caducidad!="")
                    {
                        if($usarAnd){
                            $sql= $sql. " AND TRF.CADUCIDAD='$caducidad'";
                        } else
                        {
                            $sql= $sql. " WHERE TRF.CADUCIDAD='$caducidad'";
                            $usarAnd=true;
                        }
                    }  
                    if($documento!="")
                    {
                        if($usarAnd){
                            $sql= $sql. " AND TRF.DOCUMENTO='$documento'";
                        } else
                        {
                            $sql= $sql. " WHERE TRF.DOCUMENTO='$documento'";
                            $usarAnd=true;
                        }
                    }  
                    if($entidad!="")
                    {
                        if($usarAnd){
                            $sql= $sql. " AND TRF.ENTIDAD='$entidad'";
                        } else
                        {
                            $sql= $sql. " WHERE TRF.ENTIDAD='$entidad'";
                            $usarAnd=true;
                        }
                    }                                                                                  

                    if($fechaDesde!="" )
                    {

                        if($usarAnd){
                            $sql= $sql. " AND DATE(TRF.FECHA)>='$fechaDesde'";
                        } else
                        {
                            $sql= $sql. " WHERE DATE(TRF.FECHA)>='$fechaDesde'";
                            $usarAnd=true;
                        }
                    }  
                    if($horaDesde!="00:00" )
                    {

                        if($usarAnd){
                            $sql= $sql. " AND TIME(TRF.FECHA)>='$horaDesde'";
                        } else
                        {
                            $sql= $sql. " WHERE TIME(TRF.FECHA)>='$horaDesde'";
                            $usarAnd=true;
                        }
                    }  
                    if($fechaHasta!="" )
                    {

                        if($usarAnd){
                            $sql= $sql. " AND DATE(TRF.FECHA)<='$fechaHasta'";
                        } else
                        {
                            $sql= $sql. " WHERE DATE(TRF.FECHA)<='$fechaHasta'";
                            $usarAnd=true;
                        }
                    }  
                    if($horaHasta!="00:00" )
                    {

                        if($usarAnd){
                            $sql= $sql. " AND TIME(TRF.FECHA)<='$horaHasta'";
                        } else
                        {
                            $sql= $sql. " WHERE DATTIMEE(TRF.FECHA)<='$horaHasta'";
                            $usarAnd=true;
                        }
                    }                                              
                    
                    if($hayIncidencia)
                    {
                        if($usarAnd){
                            $sql= $sql. " AND TRI.VALOR=0";
                        } else
                        {
                            $sql= $sql. " WHERE TRI.VALOR=0";
                            $usarAnd=true;
                        }
                    }    
                      

		$query = $db->query($sql);
		
		$results = $query->getResult();
		$results=$this->BotonEditar($results);
        return json_encode($results);

    }

    function  BotonEditar($data){
        
		foreach($data as $item){
            $buttonEdit = '<form method="get" action="'.base_url().'/ChequeoRecepcion/edit/'.$item->ID.'"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="'.$item->ID.'" style="color:white;"  >Editar</button></form>';
			$item->btnEditar=$buttonEdit;
		}
        
        return $data;
    }

    function buscar(){

        $response = json_decode($this->request->getPost('data'));
		
        $idDelegacion=$response->idDelegacion;
		$idDelegacionLinea = $response->idDelegacionLinea;
		$idFormulario = $response->idFormulario;
		$idGrupo = $response->idGrupo;
		$idArticulo = $response->idArticulo;
		$idMotivo = $response->idMotivo;
        $fechaDesde=$response->fechaDesde;
        $fechaHasta=$response->fechaHasta;
        $horaDesde=$response->horaDesde;
        $horaHasta=$response->horaHasta;
		$lote = $response->lote;
		$caducidad = $response->caducidad;
		$documento = $response->documento;
		$entidad = $response->entidad;
        $hayIncidencia= $response->hayIncidencia;
        $sinRevisar= $response->sinRevisar;

        return $this->consultaBusqueda($idDelegacion,$idDelegacionLinea,$idFormulario,$idGrupo,$idArticulo,$idMotivo,$fechaDesde,$fechaHasta,$horaDesde,$horaHasta
        ,$lote,$caducidad,$documento,$entidad,$hayIncidencia,$sinRevisar);

    }

    function consultaBusqueda($idDelegacion,$idDelegacionLinea,$idFormulario,$idGrupo,$idArticulo,$idMotivo,$fechaDesde,$fechaHasta,$horaDesde,$horaHasta
    ,$lote,$caducidad,$documento,$entidad,$hayIncidencia,$sinRevisar){
        $Model = new ItemModel();

        
		
		$items = json_decode($Model->getItemsEnChequeos($idDelegacion,$idDelegacionLinea,$idFormulario,$idGrupo,$idArticulo,$idMotivo,$fechaDesde,$fechaHasta,$horaDesde,$horaHasta
        ,$lote,$caducidad,$documento,$entidad,$hayIncidencia,$sinRevisar));	
        
        $usarAnd=false;

        $contador=0;
        $sql="SELECT '' AS '', RF.ID,RF.SITUACION,MAX(RF.FECHA)FECHA,MAX(U.NOMBRE)USUARIO,MAX(D.DESCRIPCION)DELEGACION,MAX(DL.DESCRIPCION)LINEA
        ,MAX(F.NOMBRE)CHECKLIST, MAX(A.REFERENCIA)REFERENCIA,MAX(A.DESCRIPCION)DESCRIPCION,MAX(A.MARCA)MARCA
        ,MAX(ifnull(M.NOMBRE,''))MOTIVO,MAX(RF.LOTE)LOTE,MAX(RF.CADUCIDAD)CADUCIDAD,MAX(DOCUMENTO)ALBARAN,MAX(ENTIDAD)PROVEEDOR
        ,MAX(RF.OBSERVACIONES)OBSERVACIONES,MAX(G.NOMBRE)ELEMENTO";
        foreach($items as $item)
        {
            $sql.=",CASE WHEN NOT ISNULL(MAX(FGI$contador.ID)) THEN IF(MAX(RI.VALOR)=1,'OK','KO') ELSE NULL END AS `".str_replace('.','',$item->NOMBRE)."`";
            $contador++;
        }
        $contador=0;
        $sql.=" FROM TBL_REGISTROS_FORMULARIOS AS RF ";
        $sql.=" INNER JOIN tbl_registros_items AS RI ON RF.ID=RI.ID_REGISTRO ";
        $sql.=" INNER JOIN tbl_formularios_grupos_items AS FGI ON RI.ID_FORMULARIO_GRUPO_ITEM=FGI.ID ";
        $sql.=" INNER JOIN TBL_ITEMS AS I ON FGI.ID_ITEM=I.ID  ";
        $sql.=" INNER JOIN tbl_grupos AS G ON FGI.ID_GRUPO=G.ID ";
        $sql.=" INNER JOIN TBL_USUARIOS AS U ON RF.ID_USUARIO=U.ID ";
        $sql.=" INNER JOIN TBL_ARTICULOS AS A ON RF.ID_ARTICULO=A.ID ";
        $sql.=" INNER JOIN TBL_FORMULARIOS AS F ON RF.ID_FORMULARIO=F.ID ";
        $sql.=" INNER JOIN tbl_delegaciones_lineas AS DL ON RF.ID_DELEGACION_LINEA=DL.ID ";
        $sql.=" INNER JOIN TBL_DELEGACIONES AS D ON DL.ID_DELEGACION=D.ID ";
        $sql.=" LEFT JOIN TBL_MOTIVOS AS M ON RF.ID_MOTIVO=M.ID ";
        foreach($items as $item)
        {
            
            $sql.=" LEFT JOIN ITEMS FGI$contador
                    ON RI.ID_FORMULARIO_GRUPO_ITEM=FGI$contador.ID AND FGI$contador.ID_ITEM=$item->ID";
            $contador++;
        }
        
        if($idDelegacion!="0"){            
            $sql= $sql. " WHERE DL.ID_DELEGACION=$idDelegacion";
            $usarAnd=true;
        }
        if(!empty($idDelegacionLinea))
        {
            if($usarAnd){
                $sql= $sql. " AND (";
            } else
            {
                $sql= $sql. " WHERE (";
                $usarAnd=true;
            }
            $i=count($idDelegacionLinea);
            foreach($idDelegacionLinea as $item){
                $sql= $sql. " RF.ID_DELEGACION_LINEA=$item";
                if($i>1){$sql= $sql . " OR ";}
                $i--;                                
            }
            $sql= $sql. ")";
        }
        if(!empty($idFormulario))
        {
            if($usarAnd){
                $sql= $sql. " AND (";
            } else
            {
                $sql= $sql. " WHERE (";
                $usarAnd=true;
            }
            $i=count($idFormulario);
            foreach($idFormulario as $item){
                $sql= $sql. " RF.ID_FORMULARIO=$item";
                if($i>1){$sql= $sql . " OR ";}
                $i--;                                
            }
            $sql= $sql. ")";
        }
        if(!empty($idGrupo))
        {
            if($usarAnd){
                $sql= $sql. " AND (";
            } else
            {
                $sql= $sql. " WHERE (";
                $usarAnd=true;
            }
            $i=count($idGrupo);
            foreach($idGrupo as $item){
                $sql= $sql. " FGI.ID_GRUPO=$item";
                if($i>1){$sql= $sql . " OR ";}
                $i--;                                
            }
            $sql= $sql. ")";
        }                    
        if($idArticulo!="0")
        {
            if($usarAnd){
                $sql= $sql. " AND RF.ID_ARTICULO=$idArticulo";
            } else
            {
                $sql= $sql. " WHERE RF.ID_ARTICULO=$idArticulo";
                $usarAnd=true;
            }
        }
        if($idMotivo!="0")
        {
            if($usarAnd){
                $sql= $sql. " AND RF.ID_MOTIVO=$idMotivo";
            } else
            {
                $sql= $sql. " WHERE RF.ID_MOTIVO=$idMotivo";
                $usarAnd=true;
            }
        }
        if($lote!="")
        {
            if($usarAnd){
                $sql= $sql. " AND RF.LOTE='$lote'";
            } else
            {
                $sql= $sql. " WHERE RF.LOTE='$lote'";
                $usarAnd=true;
            }
        }  
        if($caducidad!="")
        {
            if($usarAnd){
                $sql= $sql. " AND RF.CADUCIDAD='$caducidad'";
            } else
            {
                $sql= $sql. " WHERE RF.CADUCIDAD='$caducidad'";
                $usarAnd=true;
            }
        }  
        if($documento!="")
        {
            if($usarAnd){
                $sql= $sql. " AND RF.DOCUMENTO='$documento'";
            } else
            {
                $sql= $sql. " WHERE RF.DOCUMENTO='$documento'";
                $usarAnd=true;
            }
        }  
        if($entidad!="")
        {
            if($usarAnd){
                $sql= $sql. " AND RF.ENTIDAD='$entidad'";
            } else
            {
                $sql= $sql. " WHERE RF.ENTIDAD='$entidad'";
                $usarAnd=true;
            }
        }                                                                                  

        if($fechaDesde!="" )
        {
            if($usarAnd){
                $sql= $sql. " AND DATE(RF.FECHA)>='".$fechaDesde."'";
            } else
            {
                $sql= $sql. " WHERE DATE(RF.FECHA)>='".$fechaDesde."'";
                $usarAnd=true;
            }
        }  
        if($horaDesde!="00:00" )
        {

            if($usarAnd){
                $sql= $sql. " AND TIME(RF.FECHA)>='$horaDesde'";
            } else
            {
                $sql= $sql. " WHERE TIME(RF.FECHA)>='$horaDesde'";
                $usarAnd=true;
            }
        }  
        if($fechaHasta!="" )
        {

            if($usarAnd){
                $sql= $sql. " AND DATE(RF.FECHA)<='".$fechaHasta."'";
            } else
            {
                $sql= $sql. " WHERE DATE(RF.FECHA)<='".$fechaHasta."'";
                $usarAnd=true;
            }
        }  
        if($horaHasta!="00:00" )
        {

            if($usarAnd){
                $sql= $sql. " AND TIME(RF.FECHA)<='$horaHasta'";
            } else
            {
                $sql= $sql. " WHERE DATTIMEE(RF.FECHA)<='$horaHasta'";
                $usarAnd=true;
            }
        }                                              
        
        if($hayIncidencia)
        {
            if($usarAnd){
                $sql= $sql. " AND RI.VALOR=0";
            } else
            {
                $sql= $sql. " WHERE RI.VALOR=0";
                $usarAnd=true;
            }
        }  

        //SI FILTRAN POR LOS PTES DE REVISAR, FILTRAMOS POR EL CAMPO SITUACION=1 QUE SERÁ LOS CHEQUEOS FINALIZADOS SIN REVISAR. 
        //PODRIA FILTRAR POR <2 PARA CARGAR TAMBIEN LOS PTES DE FINALIZAR, PERO NO TIENE SENTIDO CONSULTAR LOS PTES DE REVISAR SI NO ESTÁN NI FINALIZADOS        
        if($sinRevisar)
        {
            if($usarAnd){
                $sql= $sql. " AND RF.SITUACION=1";
            } else
            {
                $sql= $sql. " WHERE RF.SITUACION=1";
                $usarAnd=true;
            }
        } 

        $sql.=" GROUP BY RF.ID,FGI.ID_GRUPO";
        //return var_dump($sql);
        $db = \Config\Database::connect();

        $query = $db->query($sql);
		
		$results = $query->getResult();
		$results=$this->BotonEditar($results);
        return json_encode($results);
    }

    function  MarcarRevisados(){
        
        $data = $this->request->getPost('data');
        $items=implode(',',$data); 
        $modelRegistroFormulario=new RegistroFormularioModel();	
		$modelRegistroFormulario->chequeosRevisados($items);
		return json_encode(true);

    }
    
    function UnirPdfs_old(){
        $response = $this->request->getVar('data');  
        $items=explode(',',$response);
		if(session()->get('multiApp')){
			$rutaAGrabar = $_SERVER['DOCUMENT_ROOT'].'/gestioncalidad/uploads/chequeos/';
		} else{
			$rutaAGrabar=$_SERVER['DOCUMENT_ROOT'].'/uploads/chequeos/';
		}
           // return var_dump($items);

        $merger = new Merger;
        foreach($items as $item){
            //return var_dump($item);
            if(file_exists($rutaAGrabar. $item .'/Chequeo' . $item. '.pdf')){
                $merger->addFile($rutaAGrabar. $item .'/Chequeo' . $item. '.pdf');        
            }
        }
        $createdPdf = $merger->merge();
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=consulta.pdf");
        echo ($createdPdf);
        exit;
        //return $createdPdf;
    }

    function UnirPdfs(){
        $response = $this->request->getVar('data');  
        $items=explode(',',$response);      

        //CREAMOS EL HTML PARA CONVERTIRLO EN PDF
        $html = '<!DOCTYPE html>';

        foreach($items as $item){
            $ModelRegistroFormularioModel = new RegistroFormularioModel();
			$datosCabecera = json_decode($ModelRegistroFormularioModel->getAll($item));

			if (isset($datosCabecera[0])) {
				$usuario = $datosCabecera[0]->Usuario . ' ' . $datosCabecera[0]->Apellido1 . ' ' . $datosCabecera[0]->Apellido2;
				$delegacion = $datosCabecera[0]->Delegacion;
				$linea = $datosCabecera[0]->Linea . ' - ' . $datosCabecera[0]->NombreLinea;
				$cheklist = $datosCabecera[0]->Formulario;
				$fecha = $datosCabecera[0]->Fecha;
				$referencia = $datosCabecera[0]->Referencia . ' - ' . $datosCabecera[0]->Descripcion . ' - ' . $datosCabecera[0]->Marca;
				$lote = $datosCabecera[0]->Lote;
				$caducidad = $datosCabecera[0]->Caducidad;
				$albaran = $datosCabecera[0]->Documento;
				$proveedor = $datosCabecera[0]->Entidad;
				$motivo = $datosCabecera[0]->NombreMotivo;
				$observaciones = $datosCabecera[0]->Observaciones;
			}
            $ModelRegistroItem = new RegistroItemModel();
		//return $ModelRegistroItem->getByRegistro($idRegistro);
			$datosItems = json_decode($ModelRegistroItem->getDatosPDFByRegistro($item));

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
			$html .= '<strong>Usuario:</strong> ' . $usuario;
			$html .= '</td>';
			$html .= '<td colspan="4">';
			$html .= '<strong>Delegacion:</strong> ' . $delegacion;
			$html .= '</td>';
			$html .= '<td colspan="4">';
			$html .= '<strong>Linea:</strong> ' . $linea;
			$html .= '</td>';
			$html .= '</tr>';
			$html .= '<tr>'; //FILA 2
			$html .= '<td colspan="6">';
			$html .= '<strong>Checklist:</strong> ' . $cheklist;
			$html .= '</td>';
			$html .= '<td colspan="6">';
			$html .= '<strong>Fecha-hora chequeo:</strong> ' . $fecha;
			$html .= '</td>';
			$html .= '</tr>';
			$html .= '<tr>'; //FILA 3
			$html .= '<td colspan="12">';
			$html .= '<strong>Referencia:</strong> ' . $referencia;
			$html .= '</td>';
			$html .= '</tr>';
			if ($motivo != "") //SI TENEMOS RELLENO EL MOTIVO
			{
				$html .= '<tr>'; //FILA 4 
				$html .= '<td colspan="12">';
				$html .= '<strong>Motivo:</strong> ' . $motivo;
				$html .= '</td>';
				$html .= '</tr>';
			}
			//CALCULO EL NUMERO DE COLSPAN SEGUN LOS VALORES QUE ME VENGAN RELLENOS
			$contador = 0;
			if ($lote != "") {
				$contador = $contador + 1;
			}
			if ($caducidad != "") {
				$contador = $contador + 1;
			}
			if ($albaran != "") {
				$contador = $contador + 1;
			}
			if ($proveedor != "") {
				$contador = $contador + 1;
			}
			if ($contador > 0) {
				$html .= '<tr>'; //FILA 5
				$colspan = 12 / $contador;
				if ($lote != "") {
					$html .= '<td colspan="' . $colspan . '">';
					$html .= '<strong>Lote:</strong> ' . $lote;
					$html .= '</td>';
				}
				if ($caducidad != "") {
					$html .= '<td colspan="' . $colspan . '">';
					$html .= '<strong>Caducidad:</strong> ' . $caducidad;
					$html .= '</td>';
				}
				if ($albaran != "") {
					$html .= '<td colspan="' . $colspan . '">';
					$html .= '<strong>Albaran:</strong> ' . $albaran;
					$html .= '</td>';
				}
				if ($proveedor != "") {
					$html .= '<td colspan="' . $colspan . '">';
					$html .= '<strong>Proveedor:</strong> ' . $proveedor;
					$html .= '</td>';
				}
				$html .= '</tr>';
			}
			$html .= '<tr>'; //FILA 6
			$html .= '<td colspan="12" rowspan="3"><strong>Observaciones:</strong> ' . $observaciones . '</td>';
			$html .= '</tr>';
			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '<br>';
			$html .= '<table>';
			$html .= '<tbody>';

			$imagenEjemplo = "";
			$imagenReal = "";

			if (isset($datosItems)) {
				$idGrupo = 0;
				$i = 1;
				foreach ($datosItems as $item) {
					if ($i > 2) {
						$html .= '</tr>';
						$i = 1;
					}
					if ($item->Valor == 1) {
						$valor = "OK";
					} else {
						$valor = "KO";
					}
					if ($idGrupo != $item->IdGrupo) {
						if ($idGrupo != 0) {
							//return var_dump('<img src="' . base_url() . '/' . $imagenReal . '" width="50%">');
							$html .= '<tr>';
							$html .= '<td colspan="6">';
							if ($imagenEjemplo != '') {
								$html .= '<img src="' . base_url() . '/' . $imagenEjemplo . '" width="50%">';
							}
							$html .= '</td><td colspan="6">';
							if ($imagenReal != '') {
								$html .= '<img src="' . base_url() . '/' . $imagenReal . '" width="50%">';
							}
							$html .= '</td>';
							$html .= '</tr>';

							$html .= '</tbody>';
							$html .= '</table>';
							$html .= '<div style="page-break-before: always;"></div>';
							$html .= '<br>';
							$html .= '<table>';
							$html .= '<tbody>';
						}
						//NUEVO GRUPO
						$html .= '<tr style="text-align: center;">';
						$html .= '<td colspan="12" style="border-bottom:1px solid grey;"><strong>Elemento chequeado:</strong> ' . $item->NombreGrupo . '</td>';
						$html .= '</tr>';

						$idGrupo = $item->IdGrupo;
					}

					if ($i == 1) {
						$html .= '<tr>';
					}

					$html .= '<td colspan="6"><strong>' . $item->NombreItem . ':</strong> ' . $valor;
					if ($valor == "KO") {
						$html .= '<br><strong>Incidencia:</strong> ' . $item->Problema;
						$html .= '<br><strong>Correción:</strong> ' . $item->Solucion;
					}
					$html .= '</td>';
					$i += 1;
					$imagenEjemplo = $item->EjemploEtiqueta;
					$imagenReal = $item->EtiquetaReal;
					//return var_dump('<img src="' . base_url() . '/' . $imagenReal . '" width="50%">');
				}
				$html .= '</tr>';
				$html .= '<tr>';

				$html .= '<td colspan="6">';
				if ($imagenEjemplo != '') {
					$html .= '<img src="' . base_url() . '/' . $imagenEjemplo . '" width="50%">';
				}
				$html .= '</td><td colspan="6">';
				if ($imagenReal != '') {
					$html .= '<img src="' . base_url() . '/' . $imagenReal . '" width="50%">';
				}
				$html .= '</td>';
				$html .= '</tr>';
			}
			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</body>';
        }

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
        $output = $dompdf->output();
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=consulta.pdf");
        echo ($output);
        exit;

        //return $createdPdf;
    }    
}
