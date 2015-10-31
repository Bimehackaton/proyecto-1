<?php

class infofestController extends Controller
{
    private $_infofest;
    
    public function __construct() {
        parent::__construct();
        
        $this->_index = $this->loadModel('infofest');
    }
    
    public function index()
    {
        $this->_view->renderizar('index');
	}
}

?>