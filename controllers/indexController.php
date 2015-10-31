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
        $this->_view->renderizar('index');
	}
	
	public function salir()
	{
		Session::destroy();
		$this->redireccionar();
	}
}

?>