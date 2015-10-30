<?php



class View
{
    private $_controlador;
	private $_js;
    
    public function __construct(Request $peticion) {
        $this->_controlador = $peticion->getControlador();
		$this->_js = array();
    }
    
    public function renderizar($vista, $item = false)
    {
		
		$js = array();
		if(count($this->_js)){
			$js = $this->_js;
		}
        
        $_layoutParams = array(
            'ruta_tmp' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/',
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'js' => $js
        );
        
        
        $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';
        
        if(is_readable($rutaView)){
            include_once ROOT . 'views'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once $rutaView;
            include_once ROOT . 'views'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        } 
        else {
            throw new Exception('Error de vista');
        }
    }
	
	public function setJs(array $js)
	{
		if(is_array($js) AND count($js)){
			for($i=0;$i<count($js);$i++){
				$this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' . $js[$i] . '.js';
			}
		}
		else{
			throw new Exception("Error de JS");
		}
	}
	
	public function setJsExterno(array $js)
	{
		if(is_array($js) AND count($js)){
			for($i=0;$i<count($js);$i++){
				$this->_js[] = $js[$i];
			}
		}
		else{
			throw new Exception("Error de JS");
		}
	}
}

?>
