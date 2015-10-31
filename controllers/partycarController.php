<?php

class partycarController extends Controller
{
    private $_partycar;
    
    public function __construct() {
        parent::__construct();
        
        $this->_partycar = $this->loadModel('partycar');
    }
    
    public function index()
    {
        $this->_view->renderizar('lista');
	}
}

?>