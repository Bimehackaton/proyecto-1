<?php

class musicaController extends Controller
{
    private $_musica;
    
    public function __construct() {
        parent::__construct();
        
		if(!Session::get('email')){
            $this->redireccionar('index/cuenta');
        }
		
        $this->_musica = $this->loadModel('musica');
    }
    
    public function index()
    {
		
    }
	
	
	public function conciertos()
	{
		$this->_view->opcion = 'conciertos';
        
        $this->_view->setJs(array('jquery.dataTables', 'dataTables.bootstrap'));
		
		$this->_view->listaConciertos = $this->_musica->getConciertosDB();
		
        $this->_view->renderizar('conciertos');
	}
	
	
	public function capturar()
	{
		$this->_view->opcion = 'capturar';
        
		$this->getLibrary('PHPMailer'. DS . 'class.phpmailer');
		$this->getLibrary('PHPMailer'. DS . 'class.smtp');
		
		$this->_view->captura;
		
		if($this->getInt('capturar') == 1){
			$this->_view->captura = $this->_musica->getConciertos();
		}
		
		if($this->getInt('purgar') == 1){
			$this->_musica->purgarTablas();
		}
		
		
        $this->_view->renderizar('capturar');
	}
	
	
	public function cancelados()
	{
		$this->_view->opcion = 'cancelados';
		
		if($this->getInt('canceladosVisto') == 1){
			$idVisto = $this->getInt('idVisto');
			
			$this->_musica->setVisto($idVisto);
		}
		
		$this->_view->listaConciertos = $this->_musica->getConciertosDB_del();
		
        $this->_view->renderizar('cancelados');
	}
	
	
	public function modificados()
	{
		$this->_view->opcion = 'modificados';
       
		
		if($this->getInt('modificadoVisto') == 1){
			$idVisto = $this->getInt('idVisto');
			
			$this->_musica->setVisto($idVisto);
		}
		
		$this->_view->listaConciertos = $this->_musica->getConciertosDB_mod();
		
        $this->_view->renderizar('modificados');
	}
	
	
	public function pendientes()
	{
		$this->_view->opcion = 'pendientes';
       
		if($this->getInt('pendienteVisto') == 1){
			$idVisto = $this->getInt('idVisto');
			
			$this->_musica->setVisto($idVisto);
		}
		
		$this->_view->listaConciertos = $this->_musica->getConciertosDB_pen();
		
        $this->_view->renderizar('pendientes');
	}
	
	
	public function bolo($id)
	{
		$this->_view->opcion = 'bolo';
		
		if($this->getInt('boloVisto') == 1){
			$idVisto = $this->getInt('idVisto');
			
			$this->_musica->setVisto($idVisto);
		}
		
		$this->_view->listaConciertos = $this->_musica->getConciertosDB_bolo($id);
		
        $this->_view->renderizar('bolo');
	}
	
	
	public function asignados()
	{
		$this->_view->opcion = 'asignados';
		
		if($this->getInt('asignadoVisto') == 1){
			$idVisto = $this->getInt('idVisto');
			
			$this->_musica->setVisto($idVisto);
		}
		
		$this->_view->listaConciertos = $this->_musica->getConciertosDB_asign();
		
        $this->_view->renderizar('asignados');
	}
	
	
	public function asignacion()
	{
		if(!Session::get('admin')){
            $this->redireccionar();
        }
		
		$this->_view->opcion = 'asignacion';
		
		
		if($this->getInt('AutoAsignar') == 1){
			$totalAsignar = $this->getInt('totalAsignar');
			
			$listaAsignar = array();
			
			for($i=1;$i<=8;$i++){
				$email = $this->getTexto('email'. $i);
				
				if($email != '')
					$listaAsignar[] = $this->getTexto('email'. $i);
			}
			
			if(count($listaAsignar) == 0){
				$this->_view->_error = 'No hay ningun usuario seleccionado.';
				$this->_view->renderizar('asignacion');
				exit;
			}
			
			$iEnvio = 0;
			for($i=0;$i<$totalAsignar;$i++):
				$emailEnviar = $listaAsignar[$iEnvio];
				
				$this->_musica->asignarBolo($emailEnviar);
				
				$iEnvio++;
				if(($iEnvio) >= count($listaAsignar))
					$iEnvio = 0;
			endfor;
				
			$this->getLibrary('PHPMailer'. DS . 'class.phpmailer');
			$this->getLibrary('PHPMailer'. DS . 'class.smtp');
			
			for($i=0;$i<count($listaAsignar);$i++):
				$this->_musica->sendEmailAviso($listaAsignar[$i]);
			endfor;
			
			$this->_view->_confirmado = 'Asignacion Correcta';
		}
		
		if($this->getInt('BorrarAsignados') == 1){
			$this->_musica->purgarTablasAsignados();
		}
		
        $this->_view->renderizar('asignacion');
	}
}


?>