<?php

class indexModel extends Model
{
	public function __construct() {
		parent::__construct();
	}
<<<<<<< HEAD
=======
	
	public function getPosts()
	{
		$datos = $this->_db->query(
			"SELECT * FROM posts ".
			"WHERE activo='1'
            ORDER BY fecha DESC;"
			);
            
		//return $datos->fetchAll();
	}
>>>>>>> 3a485126d19e8bf79204a074a99e7e637975fbcd
}

?>
