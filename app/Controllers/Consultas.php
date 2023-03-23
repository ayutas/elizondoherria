<?php namespace App\Controllers;

use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use App\Models\ClienteModel;
use App\Models\ArticuloModel;
use App\Models\ReciboModel;
use App\Models\CategoriaModel;

use Dompdf\Dompdf;
use Dompdf\Options;

class Consultas extends BaseController
{
    protected $redireccion = "consultas";
	protected $redireccionView = "consultas";

         
	public function show()
    {
        $seccion=session()->get('seccion');
                
        $fechaDesde=date("Y-m-d",strtotime("-1 year"));
        $fechaHasta=date('Y-m-d');
        $results= $this->consultaBusqueda($seccion,'','',$fechaDesde,$fechaHasta,'');
        // return var_dump($results);
        $column1= array ('Field'=>'ID');
		$column2= array ('Field'=>lang('Translate.fecha'));
		$column3= array ('Field'=>lang('Translate.numero'));
		$column4= array ('Field'=>lang('Translate.referencia'));
		$column5= array ('Field'=>lang('Translate.concepto'));
		$column6= array ('Field'=>lang('Translate.nombre'));
		$column7= array ('Field'=>lang('Translate.dni'));
		$column8= array ('Field'=>lang('Translate.importe'));
		$column9= array ('Field'=>lang('Translate.cuenta'));
        $column10= array ('Field'=>lang('Translate.cobrado'));

		
		$columnasDatatable = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9,$column10);
		$data['columns'] = $columnasDatatable;	
        $data['data']= json_decode($results);	
        $data['migapan']=lang('Translate.'.$this->redireccion);
        echo view('dashboard/header',$data);   
        echo view("dashboard/consultas",$data);
        echo view("dashboard/footer",$data);
    }

    
    function  BotonEditar($data){
        
		foreach($data as $item){
            $buttonEdit = '<button type="Button" onclick="EditarRecibo(this)" id="btnEditarRecibo" class="btn btn-info btnEditar data-id="' . $item->ID . '" style="color:white;">'.lang('Translate.ver').'</button>';
            // $buttonEdit = '<form method="get" action="'.base_url().'/recibos/edit/'.$item->ID.'"><button id="btnEditar" type="submit" class="btn btn-primary btnEditar" data-toggle="modal" data-target="#Editar" data-id="'.$item->ID.'" style="color:white;"  >Editar</button></form>';
			$item->btnEditar=$buttonEdit;
		}
        
        return $data;
    }

    function buscar(){

        $response = json_decode($this->request->getPost('data'));
		
        $seccion=session()->get('seccion');

        $referencia=$response->referencia;
		$concepto = $response->concepto;
        $fechaDesde=$response->fechaDesde;
        $fechaHasta=$response->fechaHasta;
        $cobrado=$response->cobrado;
        $noCobrado=$response->noCobrado;
        if($cobrado && $noCobrado || (!$cobrado && !$noCobrado))
        {
            $filtroCobrado="";
        } else {
            if($cobrado)
            {
                $filtroCobrado="1";
            } else {
                $filtroCobrado="0";
            }
        }
        // return var_dump($filtroCobrado);


        return $this->consultaBusqueda($seccion,$referencia,$concepto,$fechaDesde,$fechaHasta,$filtroCobrado);

    }

    function consultaBusqueda($seccion,$referencia,$concepto,$fechaDesde,$fechaHasta,$cobrado){
        
		
        $usarAnd=false;

        $sql="SELECT TR.ID,
                    DATE(TR.FECHA) AS '" . lang('Translate.fecha') . "',
                    TR.NUMERO AS '" . lang('Translate.numero') . "',
                    TR.REF AS '" . lang('Translate.referencia') . "',
                    TR.CONCEPTO AS '" . lang('Translate.concepto') . "',
                    TR.NOMBRE AS '" . lang('Translate.nombre') . "',
                    TR.DNI AS '" . lang('Translate.dni') . "',
                    TR.IMPORTE AS '" . lang('Translate.importe') . "',
                    TR.CUENTA AS '" . lang('Translate.cuenta') . "',
                    IFNULL(TR.COBRADO,'-') AS '" . lang('Translate.cobrado') . "'
                FROM tbl_recibos AS TR
                WHERE TR.SECCION_ID=$seccion";
        
        if($referencia!=""){
            $sql= $sql. " ADN TR.REF LIKE %$referencia%";
            $usarAnd=true;
        }

        if($concepto!=""){            
            $sql= $sql. " ADN TR.CONCEPTO LIKE %$concepto%";
            $usarAnd=true;
        }
       
        if($fechaDesde!="" )
        {
            $sql= $sql. " AND DATE(TR.FECHA)>='".$fechaDesde."'";
        }
 
        if($fechaHasta!="" )
        {
            $sql= $sql. " AND DATE(TR.FECHA)<='".$fechaHasta."'";
        }

        if($cobrado!="" )
        {
            if ($cobrado=="0"){
                $sql= $sql. " AND TR.COBRADO IS NULL";
            } else{
                $sql= $sql. " AND TR.COBRADO IS NOT NULL";
            }
        }
        //return var_dump($sql);
        $db = \Config\Database::connect();

        $query = $db->query($sql);
		
		$results = $query->getResult();
		$results=$this->BotonEditar($results);
        return json_encode($results);
    }
}
