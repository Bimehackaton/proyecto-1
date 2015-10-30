<?php

class musicaModel extends Model
{
	public function __construct() {
		parent::__construct();
	}
	
	
	public function getConciertos($page=1, $locate='madrid')
	{
		$return = Array();
		
		while(true):
			$url = "http://ws.audioscrobbler.com/2.0/?method=geo.getevents&location=". $locate ."&api_key=15edf3fbd4f055cd04bc2c2ec285e88c&limit=200&format=json&page=". $page;

			$datos = file_get_contents($url);
			$datos = json_decode($datos,true);
			
			$datos = $datos['events']['event'];
			
			$return = array_merge($return, $datos);
			
			$page++;
			
			if(count($datos) < 200) break;
		endwhile;
		
		return $return;
	}
	
	/*
	public function getConciertos($page=1, $locate='madrid')
	{
		
		$url = "http://ws.audioscrobbler.com/2.0/?method=geo.getevents&location=". $locate ."&api_key=15edf3fbd4f055cd04bc2c2ec285e88c&limit=2&format=json&page=". $page;

		$datos = file_get_contents($url);
		$datos = json_decode($datos,true);
		
		$datos = $datos['events']['event'];
			
		
		return $datos;
	}
	*/
	
	static public function checkGuardado($id)
	{
		$e = new Database();
		
		$datos = $e->query(
			"SELECT * FROM bolos ".
            "WHERE idBolo = $id;"
			);
            
		$dato = count($datos->fetchAll());
		
		return $dato;
	}
	
	
	static public function checkModificado($id, $cadena)
	{
		$e = new Database();
		
		$datos = $e->query(
			"SELECT * FROM bolos ".
            "WHERE idBolo = $id;"
			);
           
		$datos = $datos->fetch();
		
		$md5_cadena = $datos['md5_cadena'];
		$mod = $datos['b_modificado'];
		
		$modificado = 0;
		
		if($md5_cadena != $cadena OR $mod == 1)
			$modificado = 1;
		
		return $modificado;
	}
	
	
	static public function checkVisto($id)
	{
		$e = new Database();
		
		$datos = $e->query(
			"SELECT * FROM bolos ".
            "WHERE idBolo = $id;"
			);
			
		$insertado = $datos->fetch();
		$insertado = $insertado['b_visto'];
		
		
		
		return $insertado;
	}
	
	
	static public function checkCandelado($id)
	{
		$e = new Database();
		
		$datos = $e->query(
			"SELECT * FROM bolos ".
            "WHERE idBolo = $id;"
			);
            
		$cancelado = $datos->fetch();
		$cancelado = $cancelado['b_cancelado'];
		
		
		return $cancelado;
	}
	
	
	
	static public function setBolos($id, $artista, $dia, $hora, $sala, $url_sala, $url_ticket, $url_img, $descripcion, $md5_cadena, $b_modificado, $b_visto, $b_cancelado)
	{
		$e = new Database();
		
		$e->prepare(
			"INSERT INTO bolos VALUES " .
			"(NULL, :id, :artista, :dia, :hora, :sala, :url_sala, :url_ticket, :url_img, :descripcion, :md5_cadena, :b_modificado, :b_visto, :b_cancelado);"
			)
			->execute(array(
				':id' => $id,
				':artista' => $artista,
				':dia' => $dia,
				':hora' => $hora,
				':sala' => $sala,
				':url_sala' => $url_sala,
				':url_ticket' => $url_ticket,
				':url_img' => $url_img,
				':descripcion' => $descripcion,
				':md5_cadena' => $md5_cadena,
				':b_modificado' => $b_modificado,
				':b_visto' => $b_visto,
				':b_cancelado' => $b_cancelado
			));
			
		$e->prepare(
			"INSERT INTO bolos_mod VALUES " .
			"(NULL, :id, 0, 0, 0, 0, 0, 0, 0, 0);"
			)
			->execute(array(
				':id' => $id
			));
	}
	
	static public function getOneData($id, $campo, $value)
	{
		$e = new Database();
		
		$datos = $e->query(
			"SELECT * FROM bolos ".
            "WHERE idBolo = $id;"
			);
            
		$oneData = $datos->fetch();
		$oneData = $oneData[$campo];
		
		if($oneData != $value)
			musicaModel::setOneDataMod($id, $campo);
	}
	
	static public function setOneDataMod($id, $campo)
	{
		$e = new Database();
		
		$campo = $campo ."_b";
		
		$e->prepare(
			"UPDATE bolos_mod SET " .
			"$campo = 1 ".
			"WHERE idBolo = :id;"
			)
			->execute(array(
				':id' => $id
			));
		
	}
	
	static public function updateBolos($id, $artista, $dia, $hora, $sala, $url_sala, $url_ticket, $url_img, $descripcion, $md5_cadena, $b_modificado, $b_visto, $b_cancelado)
	{
		$e = new Database();
		
		musicaModel::getOneData($id, 'artista', $artista);
		musicaModel::getOneData($id, 'dia', $dia);
		musicaModel::getOneData($id, 'hora', $hora);
		musicaModel::getOneData($id, 'sala', $sala);
		musicaModel::getOneData($id, 'url_sala', $url_sala);
		musicaModel::getOneData($id, 'url_ticket', $url_ticket);
		musicaModel::getOneData($id, 'url_img', $url_img);
		musicaModel::getOneData($id, 'descripcion', $descripcion);

		$e->prepare(
			"UPDATE bolos SET " .
			"artista = :artista, ".
			"dia = :dia, ".
			"hora = :hora, ".
			"sala = :sala, ".
			"url_sala = :url_sala, ".
			"url_ticket = :url_ticket, ".
			"url_img = :url_img, ".
			"descripcion = :descripcion, ".
			"md5_cadena = :md5_cadena, ".
			"b_modificado = :b_modificado, ".
			"b_visto = :b_visto, ".
			"b_cancelado = :b_cancelado ".
			
			"WHERE idBolo = :id;"
			)
			->execute(array(
				':id' => $id,
				':artista' => $artista,
				':dia' => $dia,
				':hora' => $hora,
				':sala' => $sala,
				':url_sala' => $url_sala,
				':url_ticket' => $url_ticket,
				':url_img' => $url_img,
				':descripcion' => $descripcion,
				':md5_cadena' => $md5_cadena,
				':b_modificado' => $b_modificado,
				':b_visto' => $b_visto,
				':b_cancelado' => $b_cancelado
			));
	}
	
	
	
	static public function cancelBolos($id)
	{
		$e = new Database();
		
		$e->prepare(
			"UPDATE bolos SET " .
			"b_cancelado = :b_cancelado, ".
			"b_visto = :b_visto ".
			
			"WHERE idBolo = :id;"
			)
			->execute(array(
				':id' => $id,
				':b_cancelado' => 1,
				':b_visto' => 0
			));
	}
	
	
	
	public function getConciertosDB()
	{
		$datos = $this->_db->query(
			"SELECT * FROM bolos ".
            "ORDER BY id;"
			);
		
		$datos = $datos->fetchAll();
		
		return $datos;
	}
	
	
	
	public function getConciertosDB_mod()
	{
		$datos = $this->_db->query(
			"SELECT * FROM bolos ".
			"WHERE b_modificado = 1 AND b_visto = 0 ".
            "ORDER BY id;"
			);
		
		$datos = $datos->fetchAll();
		
		return $datos;
	}
	
	
	
	public function getConciertosDB_del()
	{
		$datos = $this->_db->query(
			"SELECT * FROM bolos ".
			"WHERE b_cancelado = 1 AND b_visto = 0 ".
            "ORDER BY id;"
			);
		
		$datos = $datos->fetchAll();
		
		return $datos;
	}
	
	
	
	public function getConciertosDB_bolo($id)
	{
		$datos = $this->_db->query(
			"SELECT * FROM bolos ".
			"WHERE idBolo = $id ".
            "ORDER BY id;"
			);
		
		$datos = $datos->fetchAll();
		
		return $datos;
	}
	
	
	
	public function getConciertosDB_pen()
	{
		$datos = $this->_db->query(
			"SELECT * FROM bolos ".
			"WHERE b_cancelado = 0 AND b_visto = 0 AND b_modificado = 0 ".
            "ORDER BY id;"
			);
		
		$datos = $datos->fetchAll();
		
		return $datos;
	}
	
	
	
	public function getConciertosDB_asign()
	{
		$email = Session::get('email');
		
		$datos = $this->_db->query(
			"SELECT * FROM bolos ".
			"WHERE b_visto = 0 AND idBolo IN (SELECT idBolo FROM bolos_asignados WHERE email = '$email')".
            "ORDER BY id;"
			);
		
		$datos = $datos->fetchAll();
		
		return $datos;
	}
	
	
	
	public function setVisto($id)
	{
		$email = Session::get('email');
		
		$this->_db->prepare(
			"INSERT INTO visto_bolo VALUES " .
			"(NULL, :idBolo, :email);"
			)
			->execute(array(
				':idBolo' => $id,
				':email' => $email
			));
			
		$this->_db->prepare(
			"UPDATE bolos SET " .
			"b_visto = 1 ".
			
			"WHERE idBolo = :id;"
			)
			->execute(array(
				':id' => $id
			));
	}
	
	
	static function getOneMod($id, $campo)
	{
		$e = new Database();
		
		$datos = $e->query(
			"SELECT * FROM bolos_mod ".
			"WHERE idBolo = $id;"
			);
			
		$datos = $datos->fetch();
		$datos = $datos[$campo];
		
		return $datos;
	}
	
	
	public function purgarTablas()
	{
		$this->_db->query(
			"TRUNCATE TABLE bolos;"
			)
			->fetch();
			
		$this->_db->query(
			"TRUNCATE TABLE bolos_mod;"
			)
			->fetch();
			
		$this->_db->query(
			"TRUNCATE TABLE visto_bolo;"
			)
			->fetch();
	}
	
	static function getEmailIdBolo($id)
	{
		$e = new Database();
		
		$datos = $e->query(
			"SELECT * FROM visto_bolo ".
			"WHERE idBolo = $id;"
			);
			
		$datos = $datos->fetch();
		$datos = $datos['email'];
		
		return $datos;
	}
	
	static function sendEmails(array $idBolos)
	{
		$arrSend = Array();
		$emails = Array();
		
		if(is_array($idBolos) AND count($idBolos)){
			for($i=0;$i<count($idBolos);$i++){
				$idBolo = $idBolos[$i];
				
				if(musicaModel::getEmailIdBolo($idBolo) != ''){
					$arrSend[musicaModel::getEmailIdBolo($idBolo)][] = $idBolo;
					$emails[] = musicaModel::getEmailIdBolo($idBolo);
				}
			}
			
			$emails = array_unique($emails);
		}
		
		for($i=0;$i<count($emails);$i++){
			$email = $emails[$i];
			$arrBolos = Array();
			
			for($e=0;$e<count($arrSend[$email]);$e++){
				$arrBolos[] = $arrSend[$email][$e];
				
			}
			
			musicaModel::sendEmail($email, $arrBolos);
		}
	}
	
	static function getBoloData($id, $campo)
	{
		$e = new Database();
		
		$datos = $e->query(
			"SELECT * FROM bolos ".
			"WHERE idBolo = $id;"
			);
			
		$datos = $datos->fetch();
		$datos = $datos[$campo];
		
		return $datos;
	}
	
	static function sendEmail($email, array $idBolos)
	{
		$mail             = new PHPMailer();
		
		$listaBolos = '';
		
		for($i=0;$i<count($idBolos);$i++){
			$listaBolos .= "<a href='". BASE_URL ."musica/bolo/". $idBolos[$i] ."'>" . musicaModel::getBoloData($idBolos[$i], 'dia') . " - " . musicaModel::getBoloData($idBolos[$i], 'artista') . "</a><br />";
		}
		
		$body             = "<html>".
								"<head>".
									"<title>[AVISO: DATAESCAPE] modificados o cancelados</title>".
								"</head>".
								
								"<body>".
									"<h1>BOLOS MODIFICADOS O CANCELADOS</h1>".
									"<hr />".
									"<br />".
									$listaBolos .
								"</body>".
							"</html>";

		$mail             = new PHPMailer();


		$mail->IsSMTP(); 				// telling the class to use SMTP

		$mail->SMTPDebug  = 0;			// enables SMTP debug information (for testing)
											// 1 = errors and messages
											// 2 = messages only
												   
		$mail->SMTPAuth   = true;		// enable SMTP authentication
		$mail->SMTPSecure = "tls";		// sets the prefix to the servier

		$mail->Host       = SMTP_HOST;	// sets GMAIL as the SMTP server
		$mail->Port       = SMTP_PORT;	// set the SMTP port for the GMAIL server
		$mail->Username   = SMTP_USER;	// GMAIL username
		$mail->Password   = SMTP_PASS;	// GMAIL password

		$mail->SetFrom('desarrollo@coonic.com', 'dataescape');

		$mail->Subject    = "[AVISO: DATAESCAPE] modificados o cancelados"; // TITUL DEL MENSAJE

		$mail->AltBody    = ""; 		// optional, comment out and test

		$mail->MsgHTML($body); 			// CUERPO MENSAJE

		$mail->AddAddress($email); 		// A QUIEN VA EL MENSAJE

		
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
	
	
	
	static public function getPersonalAsign($email)
	{
		$e = new Database();
		
		$totalMod = 0;
		
		$datos = $e->query(
			"SELECT * FROM bolos_asignados ".
			"WHERE email = '$email';"
			);
			
		$totalMod = $datos->fetchAll();
		$totalMod = count($totalMod);
		
		return $totalMod;
	}
	
	
	static public function checkPorAsig()
	{
		$e = new Database();
		
		$totalMod = 0;
		
		$datos = $e->query(
			"SELECT * FROM bolos ".
			"WHERE idBolo NOT IN (".
			"SELECT idBolo FROM bolos_asignados) ".
			"AND b_visto = 0;"
			);
			
		$totalMod = $datos->fetchAll();
		$totalMod = count($totalMod);
		
		return $totalMod;
	}
	
	public function asignarBolo($email)
	{
		$idAsignar = 0;
		
		$datos = $this->_db->query(
			"SELECT * FROM bolos ".
			"WHERE idBolo NOT IN (".
			"SELECT idBolo FROM bolos_asignados) ".
			"AND b_visto = 0;"
			);
			
		$datos = $datos->fetchAll();
		$idAsignar = $datos[0]['idBolo'];
		
		$this->_db->prepare(
			"INSERT INTO bolos_asignados VALUES ".
			"(NULL, :email, :idBolo);"
			)
			->execute(array(
				':idBolo' => $idAsignar,
				':email' => $email
			));
	}
	
	public function purgarTablasAsignados()
	{
		$this->_db->query(
			"TRUNCATE TABLE bolos_asignados;"
			)
			->fetch();
	}
	
	
	static function sendEmailAviso($email)
	{
		$mail             = new PHPMailer();
		
		$listaBolos = '';
		
		for($i=0;$i<count($idBolos);$i++){
			$listaBolos .= "<a href='". BASE_URL ."musica/bolo/". $idBolos[$i] ."'>" . musicaModel::getBoloData($idBolos[$i], 'dia') . " - " . musicaModel::getBoloData($idBolos[$i], 'artista') . "</a><br />";
		}
		
		$body             = "<html>".
								"<head>".
									"<title>[AVISO: DATAESCAPE] Nuevos conciertos asignados</title>".
								"</head>".
								
								"<body>".
									"<h1>BOLOS NUEVOS</h1>".
									"<hr />".
									"<br />".
									"<a href='". BASE_URL ."musica/asignados'>IR A CONTENIDO</a>";
								"</body>".
							"</html>";

		$mail             = new PHPMailer();


		$mail->IsSMTP(); 				// telling the class to use SMTP

		$mail->SMTPDebug  = 0;			// enables SMTP debug information (for testing)
											// 1 = errors and messages
											// 2 = messages only
												   
		$mail->SMTPAuth   = true;		// enable SMTP authentication
		$mail->SMTPSecure = "tls";		// sets the prefix to the servier

		$mail->Host       = SMTP_HOST;	// sets GMAIL as the SMTP server
		$mail->Port       = SMTP_PORT;	// set the SMTP port for the GMAIL server
		$mail->Username   = SMTP_USER;	// GMAIL username
		$mail->Password   = SMTP_PASS;	// GMAIL password

		$mail->SetFrom('desarrollo@coonic.com', 'dataescape');

		$mail->Subject    = "[AVISO: DATAESCAPE] Nuevos conciertos asignados"; // TITUL DEL MENSAJE

		$mail->AltBody    = ""; 		// optional, comment out and test

		$mail->MsgHTML($body); 			// CUERPO MENSAJE

		$mail->AddAddress($email); 		// A QUIEN VA EL MENSAJE

		
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}
}

?>
