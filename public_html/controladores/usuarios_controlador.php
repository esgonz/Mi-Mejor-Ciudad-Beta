<?php
class UsuarioController {
	public static $salt 		= "d0be2dc421be4fcd0172e5afceea3970e2f3d940";
	public static $urlbase 	= "http://cupontu.com/tesis/proyecto-titulo/public_html/";

	public function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	public function clean($string) {
		   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
		   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

		   return preg_replace('/-+/', '', $string); // Replaces multiple hyphens with single one.
		}
		public function listar() {
	      // we store all the posts in a variable
			$usuario = Usuario::buscarPorUsuario(0);
			require_once('vistas/usuarios/listar.php');
		}



		public function registrar(){
			$tipo			= 0; 
			$estado		= 0;
			$creado		= ""; 
			$modificado	= "";
			$error 		= null; 




			if(isset($_POST['enviar']))//para saber si el botón registrar fue presionado.
			{
				$usuario = $this->clean($_POST['usuario']);
				$email 	= ($_POST["email"]);							

				$password 	= trim($_POST['password']);
				$password2 	= trim($_POST['password2']);
				$nombre 		= $this->test_input($_POST["nombre"]);
				if (!preg_match("/^[a-zA-Z ]*$/",$nombre)) {
					$error['nombre'] = "Solo letras y Espacios son permitidos"; 
				} 
				$apellido = $this->test_input($_POST["apellido"]);
				if (!preg_match("/^[a-zA-Z ]*$/",$apellido)) {
					$error['apellido'] = "Solo letras y Espacios son permitidos"; 
				} 

				//$avatar		= $this->clean($_POST['avatar']);
				$avatar="";

				if($usuario == '' or $password == '' or $password2 == '')
				{ 
					//echo 'Por favor llene todos los campos.';//Si los campos están vacíos muestra el siguiente mensaje, caso contrario sigue el siguiente codigo.
					$error['campos'] 	="Por favor llene todos los campos Necesarios.";
				}	 
				else 
				{ 	

					$sqlVerif 	= " us_usuario ='".$usuario ."' ";
					$DBuser 		= Usuario::findVerif($sqlVerif); 
					//$sql = 'SELECT * FROM usuarios'; 
					//$rec = mysql_query($sql); 
					$verificar_usuario = 0;//Creamos la variable $verificar_usuario que empieza con el valor 0 y si la condición que verifica el usuario(abajo), entonces la variable toma el valor de 1 que quiere decir que ya existe ese nombre de usuario por lo tanto no se puede registrar

					if ($DBuser) {
						$verificar_usuario = 1;
						$error['usuario']="Este Nombre de usuario ya ha sido registrado anteriormente."; 

					}

					$sqlVerifemail 	=" us_email ='".$email ."' ";
					$DBemail 			= Usuario::findVerif($sqlVerifemail); 
					if ($DBemail) {
						$verificar_usuario = 1;
						$error['usuario']="Este email ya ha sido registrado anteriormente."; 	
					}

					

					if($verificar_usuario == 0) 
					{ 
						if($password== $password2)//Si los campos son iguales, continua el registro y caso contrario saldrá un mensaje de error.
						{ 
							
							$target_dir  		= "uploads/avatares/";
							$nombreArchivo 	='avtr'.uniqid(). uniqid() . '.jpg';
							$avatar 				= $target_dir .$nombreArchivo;
							$uploadOk 			= 1;
							$imageFileType 	= pathinfo($avatar,PATHINFO_EXTENSION);
							// Check if image file is a actual image or fake image
							
							$check = getimagesize($_FILES["avatar"]["tmp_name"]);
							if($check !== false) {
								//echo "File is an image - " . $check["mime"] . ".";
								$uploadOk = 1;
							} else {
								$error['Avatar'] ="Archivo no es una imagen.";
								$uploadOk = 0;
							}
							
							// Check if file already exists
							if (file_exists($avatar)) {
								$error['Avatar'] = "la imagen ya existe.";
								$uploadOk = 0;
							}
							// Check file size
							if ($_FILES["avatar"]["size"] > 2097152) {
								$error['Avatar'] = "Tu foto pesa mas de 2Mb";
								$uploadOk = 0;
							}
							// Allow certain file formats
							if($imageFileType != "jpg" && $imageFileType != "jpeg" ) {
								$error['Avatar'] = "Solo formato jpg y jpeg permitidos";
								$uploadOk = 0;
							}
							// Check if $uploadOk is set to 0 by an error
							if ($uploadOk == 0) {
								$verificar_usuario=1;
								$error['Avatar'] = "La imagen no fue subida";
							// if everything is ok, try to upload file
							} else {
								if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar)) {
									$verificar_usuario=0;
							        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
								} else {
									$verificar_usuario=1;
									$error['Avatar'] =  "Existe un error subiendo las imagenes";
								}
							}


							if ( $verificar_usuario ==0) {
								$usuarioObj = new Usuario(null, $tipo,$estado, $usuario, $email, sha1($password.UsuarioController::$salt), $nombre,   $apellido, $avatar,$creado, $modificado);

								$nid=$usuarioObj->insert();
								if($nid){
									$usuarioObj->id 	= $nid;
									$this->mail($usuarioObj,UsuarioController::crearUrlVerificacion($usuarioObj), 'validar' ); 
									$mensaje['validar_email']="Todo Ocurrio exelentemente :)";
								}else{
									$error['error']="Ocurrio un error :( Intentelo nuevamente.";
								}            

							}
						} 
						else 
						{ 
							$error['claves']="Las claves no son iguales, intente nuevamente.";
								//echo 'Las claves no son iguales, intente nuevamente.';
						} 
					} 
				} 
			}

			if ($error==null) {
				require_once('vistas/usuarios/crear.php');
			}else{
				// we store all the posts in a variable
			      //$usuario = Usuario::buscarPorUsuario(0);
				require_once('vistas/usuarios/crear.php');
			}

			
		}
		public function logout(){
			if(session_destroy()) // Destroying All Sessions
			{	
				$url="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapa";
				$string = '<script type="text/javascript">';
				$string .= 'window.location = "' . $url . '"';
				$string .= '</script>';

				echo $string;
				//return call('causas', 'mapa');
				//require_once('vistas/causas/indexMapXML.php');
			}
		}

		public function login() {

			if ($_SESSION['valid']) {
				$url="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=listar";
				$string = '<script type="text/javascript">';
				$string .= 'window.location = "' . $url . '"';
				$string .= '</script>';

				echo $string;
			}
			$error= null; 




      if(isset($_POST['enviar']))//para saber si el botón registrar fue presionado.
      {
      	$email 		= ($_POST["email"]);              
      	$password   = trim($_POST['password']); 

      	$sqlVerif 	= " us_email ='".$email ."' ";
      	$DBuser 		= Usuario::findVerif($sqlVerif); 
          $verificar_usuario = 0;//Creamos la variable $verificar_usuario que empieza con el valor 0 y si la condición que verifica el usuario(abajo), entonces la variable toma el valor de 1 que quiere decir que ya existe ese nombre de usuario por lo tanto no se puede registrar
          
          if ($DBuser) {          	
          	$verificar_usuario 	= 1;
          }else{
          	$error["Usuario"] 	= "Usuario No existe.";
          }
          if($verificar_usuario == 1) 
          { 
          	$sqlVerifPass 	= " us_email ='".$email ."' AND us_password='".sha1($password.UsuarioController::$salt)."' ";
            //echo $sqlVerifPass;
          	$DBuserPass 	= Usuario::findVerif($sqlVerifPass);
          	if ($DBuserPass!=false) {

          		if ($DBuserPass->password == sha1($password.UsuarioController::$salt)) {
          			$verificar_usuario = 1;

          		}else{
          			$verificar_usuario = 0;
          			$error['Clave']="Los datos de Usuario no concuerdan.";

          		}
          	}else{
          		$verificar_usuario = 0;
          		$error['Clave']="Los datos de Usuario no concuerdan.";

          	}
          	if ($verificar_usuario==1) {

          		$_SESSION['valid'] 			= true;
          		$_SESSION['timeout'] 		= time();
          		$_SESSION['us_usuario'] 	= $DBuser->usuario;
          		$_SESSION['us_email'] 		= $DBuser->email;    
          		$_SESSION['us_id'] 			= $DBuser->id;
          		$_SESSION['us_tipo'] 		= $DBuser->tipo;
          		$_SESSION['us_estado'] 		= $DBuser->estado;
          		$_SESSION['us_nombre'] 		= $DBuser->nombre;
          		$_SESSION['us_apellido']	= $DBuser->apellido;
          		$_SESSION['us_avatar'] 		= $DBuser->avatar;                

          	} 
          } 

      }//end if post enviar
      if (!isset($_POST['enviar'])) {
      	require_once('vistas/usuarios/login.php');

      }elseif ($error==null) {
      	$url="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=listar";
      	$string = '<script type="text/javascript">';
      	$string .= 'window.location = "' . $url . '"';
      	$string .= '</script>';

      	echo $string;
      	//return call("causas","listar");
        //require_once('vistas/usuarios/login.php');
      }else{
        // we store all the posts in a variable
            //$usuario = Usuario::buscarPorUsuario(0);
      	require_once('vistas/usuarios/login.php');
      }

   }



   public static function crearUrlVerificacion($usuario){

   	return UsuarioController::$urlbase."index.php?controlador=usuarios&accion=verificarUsuario&usuario=".$usuario->id."&url=".urlencode(sha1($usuario->id.$usuario->usuario.$usuario->email.$usuario->password.UsuarioController::$salt));

   }

   public function verificarUsuario(){

   	if (isset($_GET["url"]) && isset($_GET["usuario"])  ) {
   		$usuario 	= intval($_GET["usuario"]);
   		$sqlVerif 	= " us_id ='".$usuario ."' ";
   		$DBuser 		= Usuario::findVerif($sqlVerif); 
   		if ($DBuser) {
   			if ($DBuser->estado==0) {
						//usuario estado no validado
   				$DBstring 	= sha1($DBuser->id.$DBuser->usuario.$DBuser->email.$DBuser->password.UsuarioController::$salt);
   				$urlString 	= urldecode($_GET["url"]);

   				if ($DBstring == $urlString) {
   					$DBuser->validar($DBuser->id);
   					$mensaje['verificar_usuario'] 	= "Tu Usuario se pudo validar";
   				}else{
   					$error['usuario'] 	= "Ocurrio un error :(";
   				}
						/*if($DBuser->usuario == $usuario) //Esta condición verifica si ya existe el usuario
						{ 
							$verificar_usuario = 1;
							$error['usuario']="Este usuario ya ha sido registrado anteriormente."; 
							
						}*/
					}else{
						$error['usuario'] 	= "Usuario esta Validado:)";
					}
					
				}
				else{
					$error['usuario']	= "Sin usuario que verificar :(";

				}
			}else{
				$error['usuario'] 	= "Sin nada que verificar :(";
			}	

			require_once('vistas/usuarios/validar.php');

		}
		public static function mail($usuario, $verifurl, $accion){
			$urlbase="http://cupontu.com/tesis/proyecto-titulo/public_html/";
	      // multiple recipients
	      $to  = $usuario->nombre." <".$usuario->email .'>,'; // note the comma
	      //$to .= 'wez@example.com';
	      $subject="";
	      $mensaje=null;

      	switch ($accion) {
	      	case 'validar':
	      	$subject = 'Creaste un Perfil en mimejorciudad.cl ';
	      	$mensaje["titulo"]="En Hora Buena Eres Miembro de Mimejorciudad.cl !";
	      	$mensaje["contenido"]='
	      	<h3>Hola '.$usuario->nombre.',</h3>
	      	<p> Gracias por confiar en nuestra plataforma y registrarte como nuevo Miembro.<p>
	      		<h3>Para validar tu cuenta, ingresa al siguiente Enlace:</h3>
	      		<a href="'.$verifurl.'">Valida tu cuenta aqui </a>

	      		';
      		break;
      		default:
          		# code...
      		break;
      	}
	      // subject



	      	require_once('vistas/mail/basica.php'); 

	      // To send HTML mail, the Content-type header must be set
	      	$headers  = 'MIME-Version: 1.0' . "\r\n";
	      	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	      // Additional headers
	      //$headers .= 'To: Esteban <estebangon.g@gmail.com>' . "\r\n";
	      	$headers .= 'From: mimejorciudad.cl <no-reply@mimejorciudad.cl>' . "\r\n";
	      //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	      //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

	      // Mail it
      	mail($to, $subject, $plantilla_email, $headers);
      }
   }
?>