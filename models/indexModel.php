<?php

class indexModel extends Model
{
	public function __construct() {
		parent::__construct();
	}
	
	public function getPosts()
	{
		$datos = $this->_db->query(
			"SELECT * FROM posts ".
			"WHERE activo='1'
            ORDER BY fecha DESC;"
			);
            
		//return $datos->fetchAll();
	}
}

?>
