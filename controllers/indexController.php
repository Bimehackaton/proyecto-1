<?php

class indexController extends Controller
{
    private $_index;
    
    public function __construct() {
        parent::__construct();
        
        $this->_index = $this->loadModel('index');
    }
    
    public function index()
    {
<<<<<<< HEAD
        $this->_view->renderizar('index');
=======
		if(!Session::get('email')){
            $this->redireccionar('index/cuenta');
        }
		else{
			$this->redireccionar('musica/conciertos');
		}
		
        $this->_view->opcion = 'dashboard';
        
        $this->_view->setJs(array('index'));
        $this->_view->renderizar('index');
    }
	
	public function cuenta($email = '')
	{
		if(Session::get('email')){
            $this->redireccionar();
        }
		
		if($email != ''){
			Session::set('email', $email);
			
			if($email == 'desarrollo2@proyectoscoonic.com' OR $email == 'cdoval@coonic.com' OR $email == 'ebenito@coonic.com' OR $email == 'desarrollo@coonic.com')
				Session::set('admin', true);
				
			$this->redireccionar();
		}
		
        $this->_view->opcion = '';
		
        $this->_view->renderizar('cuenta');
>>>>>>> 3a485126d19e8bf79204a074a99e7e637975fbcd
	}
	
	public function salir()
	{
		Session::destroy();
		$this->redireccionar();
	}
}

?>