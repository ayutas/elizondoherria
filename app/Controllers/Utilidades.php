<?php

namespace App\Controllers;

use App\Models\ParametrosModel;
use App\Models\RegistroFormularioGrupoModel;

class Utilidades extends BaseController
{
    public function RedimensionarImagenesEjemplo()
    {        
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
        $rutaImagenes=$rutaAGrabar . '/uploads/referencias/';
        // Abrimos la carpeta donde se alojan las imagenes de ejemplo
        $dir = opendir($rutaImagenes);
        
        // Leo todos los ficheros de la carpeta
        while (($elemento = readdir($dir))){
            // Tratamos los elementos . y .. que tienen todas las carpetas
            if( $elemento != "." && $elemento != ".."){
                // Si es una carpeta
                if( is_dir($rutaImagenes.$elemento) ){
                    
                // Si es un fichero
                } else {
                    // Muestro el fichero
                    $nombreEjemplo = pathinfo($elemento, PATHINFO_FILENAME);
                    $extensionEjemplo = pathinfo($elemento, PATHINFO_EXTENSION);
                    if ($extensionEjemplo=='png')
                    {
                        $rutaEjemplo = $rutaImagenes .  $elemento;
                        $rutaJpg = $rutaImagenes . $nombreEjemplo.'.jpg';
                        if ($rutaImagick != "") {
                            $comando = '"' . $rutaImagick . '" convert ' . $rutaEjemplo . " -resample 150 -trim " . $rutaJpg . '"';
                        } else {
                            $comando = '"C:\Program Files\ImageMagick-7.0.11-Q16-HDRI\magick.exe" convert "' . $rutaEjemplo . '" -resample 150 -trim "' . $rutaJpg . '"';
                        }
                        exec($comando);                        
                    }
                }
            }
        }
    }

    public function EliminarImagenesEjemploPng()
    {        
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
        $rutaImagenes=$rutaAGrabar . '/uploads/referencias/';
        // Abrimos la carpeta donde se alojan las imagenes de ejemplo
        $dir = opendir($rutaImagenes);
        
        // Leo todos los ficheros de la carpeta
        while (($elemento = readdir($dir))){
            // Tratamos los elementos . y .. que tienen todas las carpetas
            if( $elemento != "." && $elemento != ".."){
                // Si es una carpeta
                if( is_dir($rutaImagenes.$elemento) ){
                    
                // Si es un fichero
                } else {
                    // Muestro el fichero
                    $nombreEjemplo = pathinfo($elemento, PATHINFO_FILENAME);
                    $extensionEjemplo = pathinfo($elemento, PATHINFO_EXTENSION);
                    if ($extensionEjemplo=='png')
                    {
                        $rutaEjemplo = $rutaImagenes .  $elemento;
                        unlink($rutaEjemplo);
                    }
                }
            }
        }
    }

    public function EliminarPdfsChequeos()
    {        
        $modelParametros=new ParametrosModel();
		$parametros=json_decode($modelParametros->getAll());
		$rutaAGrabar = $_SERVER['DOCUMENT_ROOT'];
		
		if(isset($parametros)){			
			if($parametros[0]->multiApp){
				$rutaAGrabar=$_SERVER['DOCUMENT_ROOT'] . '/gestioncalidad';
			}
		}
        $rutaPdfs=$rutaAGrabar . '/uploads/chequeos/';

        // Abrimos la carpeta donde se alojan las Pdfs de ejemplo
        //$dir = opendir($rutaPdfs);
        
        $this->EliminarPdf($rutaPdfs);

    }    
    public function EliminarPdf($path){
        
        $dir = opendir($path);        
        while (false !== ($current = readdir($dir))){
            
            if( $current != "." && $current != "..") {
                //return var_dump($current);
                if(is_dir($path.$current)) {
                    
                    $this->EliminarPdf($path.$current.'/');
                }
                else {
                    
                    $nombreEjemplo = pathinfo($current, PATHINFO_FILENAME);
                    $extensionEjemplo = pathinfo($current, PATHINFO_EXTENSION);
                    if ($extensionEjemplo=='pdf')
                    {
                        $rutaPdf = $path .  $current;
                        
                        unlink($rutaPdf);
                    }
                }
            }

        }

    }    

    public function RedimensionImagenesChequeos()
    {        
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
        $rutaImagenes=$rutaAGrabar . '/uploads/chequeos/';
        // Abrimos la carpeta donde se alojan las imagenes de ejemplo
        $this->RediensionarImagen($rutaImagenes,$rutaImagick);
        // Una vez redimensionadas las imagenes borramos los png
        $this->EliminarImagenesPngChequeos($rutaImagenes);          
        //Ahora ya cambio en base de datos las extensiones png por jpg
        $modelRegistroFormularioGrupo=new RegistroFormularioGrupoModel();
        $modelRegistroFormularioGrupo->cambiarExtensionPngToJpg();

    }    

    public function RediensionarImagen($path,$rutaImagick){
        
        $dir = opendir($path);        
        while (false !== ($current = readdir($dir))){
            
            if( $current != "." && $current != "..") {
                //return var_dump($current);
                if(is_dir($path.$current)) {
                    
                    $this->RediensionarImagen($path.$current.'/',$rutaImagick);
                }
                else {                    
                    $nombreEjemplo = pathinfo($current, PATHINFO_FILENAME);
                    $extensionEjemplo = pathinfo($current, PATHINFO_EXTENSION);
                    if ($extensionEjemplo=='png')
                    {
                        if(strpos($nombreEjemplo,'ejemplo')!=false){
                            //si es imagen de ejemplo, le haremos un resmaple de 150 y lo guardamos en jpg
                            $rutaEjemplo = $path .  $current;
                            $rutaJpg = $path . $nombreEjemplo.'.jpg';
                            if ($rutaImagick != "") {
                                $comando = '"' . $rutaImagick . '" convert ' . $rutaEjemplo . " -resample 150 -trim " . $rutaJpg . '"';
                            } else {
                                $comando = '"C:\Program Files\ImageMagick-7.0.11-Q16-HDRI\magick.exe" convert "' . $rutaEjemplo . '" -resample 150 -trim "' . $rutaJpg . '"';
                            }
                            exec($comando); 
                        }
                        else
                        {
                            //si es imagen real, le haremos un resmaple de 150, un geometry x794 y lo guardamos en jpg
                            $rutaPng = $path .  $current;
                            $rutaJpg = $path . $nombreEjemplo.'.jpg';
                            if ($rutaImagick != "") {
                                $comando = '"' . $rutaImagick . '" convert ' . $rutaPng . " -resample 150 -geometry x794  -trim " . $rutaJpg . '"';
                            } else {
                                $comando = '"C:\Program Files\ImageMagick-7.0.11-Q16-HDRI\magick.exe" convert "' . $rutaPng . '" -resample 150 -geometry x794  -trim "' . $rutaJpg . '"';
                            }
                            exec($comando); 
                        }                        
                        
                    }
                }
            }

        }
    }    

    public function EliminarImagenesPngChequeos($path)
    {        
        $dir = opendir($path);        
        while (false !== ($current = readdir($dir))){
            
            if( $current != "." && $current != "..") {
                //return var_dump($current);
                if(is_dir($path.$current)) {
                    
                    $this->EliminarImagenesPngChequeos($path.$current.'/');
                }
                else {                    
                    $nombreEjemplo = pathinfo($current, PATHINFO_FILENAME);
                    $extensionEjemplo = pathinfo($current, PATHINFO_EXTENSION);
                    if ($extensionEjemplo=='png')
                    {
                        $rutaPng = $path .  $current;     
                        unlink($rutaPng);
                    }
                }
            }

        }
    }    
}