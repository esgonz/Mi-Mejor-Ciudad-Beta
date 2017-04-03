<?php
class CausaController {

  public $urlbase="http://cupontu.com/tesis/proyecto-titulo/public_html/";
  public function listar() {

      //verify session
    if (!isset($_SESSION)) {
      return call("usuarios","login");

    }elseif ($_SESSION['valid']==false ) {
      return call("usuarios","login");

    }
    elseif ($_SESSION['us_id']==null ) {

      return call("usuarios","login");
    }

        /*        
        $_SESSION['valid']        = true;
        $_SESSION['timeout']      = time();
        $_SESSION['us_usuario']   = $DBuser->usuario;
        $_SESSION['us_email']     = $DBuser->email;    
        $_SESSION['us_id']        = $DBuser->id;
        $_SESSION['us_tipo']      = $DBuser->tipo;
        $_SESSION['us_estado']    = $DBuser->estado;
        $_SESSION['us_nombre']    = $DBuser->nombre;
        $_SESSION['us_apellido']  = $DBuser->apellido;
        $_SESSION['us_avatar']    = $DBuser->avatar;   
        */  

        $causas = Causa::buscarPorUsuario($_SESSION['us_id']);

        require_once('vistas/causas/listar.php');
      }
      public function _listar($uid) {

      //verify session
        if (!isset($_SESSION)) {
          return call("usuarios","login");

        }elseif ($_SESSION['valid']==false ) {
          return call("usuarios","login");

        }
        elseif ($_SESSION['us_id']==null ) {

          return call("usuarios","login");
        }
        
        /*        
        $_SESSION['valid']        = true;
        $_SESSION['timeout']      = time();
        $_SESSION['us_usuario']   = $DBuser->usuario;
        $_SESSION['us_email']     = $DBuser->email;    
        $_SESSION['us_id']        = $DBuser->id;
        $_SESSION['us_tipo']      = $DBuser->tipo;
        $_SESSION['us_estado']    = $DBuser->estado;
        $_SESSION['us_nombre']    = $DBuser->nombre;
        $_SESSION['us_apellido']  = $DBuser->apellido;
        $_SESSION['us_avatar']    = $DBuser->avatar;   
        */ 

        $causas = Causa::buscarPorUsuario($uid);

        require_once('vistas/causas/listar.php');
      }

      public function moderar () {
      //verify session
        if (!isset($_SESSION)) {
          return call("usuarios","login");

        }elseif ($_SESSION['valid']==false ) {
          return call("usuarios","login");

        }
        elseif ($_SESSION['us_id']==null ) {

          return call("usuarios","login");
        }
        
        /*        
        $_SESSION['valid']        = true;
        $_SESSION['timeout']      = time();
        $_SESSION['us_usuario']   = $DBuser->usuario;
        $_SESSION['us_email']     = $DBuser->email;    
        $_SESSION['us_id']        = $DBuser->id;
        $_SESSION['us_tipo']      = $DBuser->tipo;
        $_SESSION['us_estado']    = $DBuser->estado;
        $_SESSION['us_nombre']    = $DBuser->nombre;
        $_SESSION['us_apellido']  = $DBuser->apellido;
        $_SESSION['us_avatar']    = $DBuser->avatar;   
        */  

        $causas = Causa::all();
        require_once('vistas/causas/listar.php');
      }

      public function ver() {

        if (!isset($_GET['id'])){        
          return call('causas', 'mapa');

        }

      //$causa = Causa::find($_GET['id']);
        $this->_mostrar($_GET['id']);
      }

      public function firmar() {

        if (!isset($_GET['id'])){        
          return call('causas', 'mapa');

        }
        $id         = $_GET['id'];      
        $causa      = Causa::find($id);
        $seguidores = Causa::findSeguidores($id);
        $usuarioObj = Usuario::find($usuario);
        $this->mail($usuarioObj, $causa, $seguidores, "firmar");
      }
      public function _mostrar($id) {

        $causa = Causa::find($id);

        if ($_SESSION['us_tipo']!=1 && $causa->estado==0) {
          return call("usuarios","login");
        }

      // we expect a url of form ?controlador=posts&accion=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database

      // we use the given id to get the right post

        $comentarios  = Comentario::findByCausa($id);
        $seguidores   = Causa::findSeguidores($id);
        $autoridad    = Causa::buscarAutoridades($causa->respuesta);
        require_once('vistas/causas/mostrar.php');
      }

      public function generarCarta($id) {
      // we expect a url of form ?controlador=posts&accion=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database

      // we use the given id to get the right post
        $causa        = Causa::find($id);
        $comentarios  = Comentario::findByCausa($id);
        $seguidores   = Causa::findSeguidores($id);
        require_once('vistas/causas/mostrar.php');
      }



      public function crear(){
      //verify session
        if (!isset($_SESSION)) {
          return call("usuarios","login");

        }elseif ($_SESSION['valid']==false ) {
          return call("usuarios","login");

        }
        elseif ($_SESSION['us_id']==null ) {
         return call("usuarios","login");
       }

        /*        
        $_SESSION['valid']        = true;
        $_SESSION['timeout']      = time();
        $_SESSION['us_usuario']   = $DBuser->usuario;
        $_SESSION['us_email']     = $DBuser->email;    
        $_SESSION['us_id']        = $DBuser->id;
        $_SESSION['us_tipo']      = $DBuser->tipo;
        $_SESSION['us_estado']    = $DBuser->estado;
        $_SESSION['us_nombre']    = $DBuser->nombre;
        $_SESSION['us_apellido']  = $DBuser->apellido;
        $_SESSION['us_avatar']    = $DBuser->avatar;   
        */              


        $id             = "";
        $nombre         = "";
        $descripcion    = "";
        $usuario        = $_SESSION['us_id'];
        $categoria      = "";    
        $respuesta      = "";
        $url            = "";
        $estado         = 0; 
        $lat            = "";
        $lng            = "";
        $direccion      = "";     
        $creado         = "";
        $modificado     = "";

        if (isset($_POST['hiddenCrear'])) {
          $error= null;

          $nombre       =   trim( $_POST['inputNombre'] );
          $descripcion  =   trim( $_POST['textBoxDescripcion']);
          $categoria    =   trim( $_POST['inputCategoria']);
          $respuesta    =   trim( $_POST['inputRespuesta']);    
          $lat          =   trim( $_POST['lat']);
          $lng          =   trim( $_POST['lng']);
          $direccion    =   trim( $_POST['inputDireccion']);     



          if (!isset($_POST['inputNombre']) || trim($_POST['inputNombre']) == "" ) {
            $error['nombre']  = "debe agregar un nombre";
          }

          if (!isset($_POST['textBoxDescripcion']) || trim($_POST['textBoxDescripcion']) == "" ) {
            $error['descripcion']   = "debe agregar un descripcion";
          }

          if (!isset($_POST['inputCategoria']) || trim($_POST['inputCategoria']) == "" ) {
            $error['categoria']   = "debe agregar un categoria";
          }

          if (!isset($_POST['lat']) || trim($_POST['lat']) == "" ) {
            $error['lat']   = "debe agregar un lat";
          }

          if (!isset($_POST['lng']) || trim($_POST['lng']) == "" ) {
            $error['lng']   = "debe agregar un lng";
          }
          if (!isset($_POST['inputDireccion']) || trim($_POST['inputDireccion']) == "" ) {
            $error['direccion']   = "debe agregar un direccion";
          }

          
          if ($error == null) {
            $causa = new Causa($id, $nombre, $descripcion, $usuario, $categoria, $respuesta, $url , $estado, $lat, $lng, $direccion, $creado, $modificado );
            
            $causa->insert();            
            $usuarioObj= Usuario::find($usuario);
            //var_dump($usuarioObj);            
            $this->mail($usuarioObj, $causa,null, "crear");
            //require_once('vistas/causas/listar.php');
            $this->_listar($usuario);
          }

        }else{
          $categoriasObj=Causa::getCategorias();
          $autoridadesObj=Causa::getAutoridades();
        //echo "<pre>".print_r($categoriasObj)."</pre>";
          require_once('vistas/causas/crear.php');
        }   

      }

      public function guardar(){
        $causa = Causa::find($_GET['id']);
        require_once('vistas/causas/guardar.php');
      }

      public function actualizar(){
        $causa = Causa::find($_GET['id']);
        require_once('vistas/causas/actualizar.php');
      }

      public function eliminar(){
        $causa = Causa::find($_GET['id']);
        require_once('vistas/causas/mostrar.php');
      }

      public function validar(){
      //verify session
        if (!isset($_SESSION)) {
          return call("usuarios","login");

        }elseif ($_SESSION['valid']==false ) {
          return call("usuarios","login");

        }
        elseif ($_SESSION['us_id']==null ) {
          return call("usuarios","login");
        }
        
        /*        
        $_SESSION['valid']        = true;
        $_SESSION['timeout']      = time();
        $_SESSION['us_usuario']   = $DBuser->usuario;
        $_SESSION['us_email']     = $DBuser->email;    
        $_SESSION['us_id']        = $DBuser->id;
        $_SESSION['us_tipo']      = $DBuser->tipo;
        $_SESSION['us_estado']    = $DBuser->estado;
        $_SESSION['us_nombre']    = $DBuser->nombre;
        $_SESSION['us_apellido']  = $DBuser->apellido;
        $_SESSION['us_avatar']    = $DBuser->avatar;   
        */ 

        if (isset($_POST['validarCausa'])) {
          $error= null;
          $causa        =   trim( $_POST['inputCausaID'] );
          $usuario      =   $_SESSION['us_id'];
          if ($causa == "") {
           $error["validar"]  = "Debe seleccionar una causa";
         }
         if ($error == null) {

          $causaObj     = Causa::find($causa);
          $usuarioObj   = Usuario::find($causaObj->usuario);
          Causa::validar($causaObj->id);


          $this->mail($usuarioObj, $causaObj, $seguidores, "validar");
        }
        $this->_mostrar($causa);
      }else{
       $this->listar();
     }

   }

   public function comentar(){
      //verify session
    if (!isset($_SESSION)) {
      return call("usuarios","login");

    }elseif ($_SESSION['valid']==false ) {
      return call("usuarios","login");

    }
    elseif ($_SESSION['us_id']==null ) {

      return call("usuarios","login");
    }

        /*        
        $_SESSION['valid']        = true;
        $_SESSION['timeout']      = time();
        $_SESSION['us_usuario']   = $DBuser->usuario;
        $_SESSION['us_email']     = $DBuser->email;    
        $_SESSION['us_id']        = $DBuser->id;
        $_SESSION['us_tipo']      = $DBuser->tipo;
        $_SESSION['us_estado']    = $DBuser->estado;
        $_SESSION['us_nombre']    = $DBuser->nombre;
        $_SESSION['us_apellido']  = $DBuser->apellido;
        $_SESSION['us_avatar']    = $DBuser->avatar;   
        */ 

        $id           = "";
        $causa        = "";
        $comentario   = "";
        $creado       = "";
        $modificado   = "";
      //echo "creadondo comentario";


        if (isset($_POST['hiddenComentar'])) {
            //echo "<pre>
            //POST:
            //";
            //var_dump($_POST);
            //echo "</pre>";
            //echo "<pre>
            //GET
            //";
            //var_dump($$_GET);
            //echo "</pre>";
          $error        = null;
          $causa        =   trim( $_POST['InputComentCausa'] );
          $usuario      =   $_SESSION['us_id'];
          $comentario   =   trim( $_POST['InputComentario']);




          if (!isset($_POST['InputComentCausa']) || trim($_POST['InputComentCausa'])=="" ) {
            $error['InputComentCausa']="debe agregar un causa";
          }

          if (!isset($_POST['InputComentario']) || trim($_POST['InputComentario'])=="" ) {
            $error['InputComentario']="debe agregar un comentario";
          }


          
          if ($error==null) {

            $comentario   = new Comentario($id, $causa, $usuario, $comentario,$creado, $modificado );
            $comentario->insert();                       
            
            $causaObj     = Causa::find($causa);
            $usuarioObj   = Usuario::find($causaObj->usuario);        
            $seguidores   = Causa::findSeguidores($causa);

            /*if (count($seguidores)>0) {
              foreach ($seguidores as $seguidor) {
                
                $seguidorObj= Usuario::find($seguidor['us_id']);
                $this->mail($seguidorObj, $causaObj, $seguidores, "comento");
              }
            }*/


            $this->mail($usuarioObj, $causaObj,null, "comentar");
            

          }

        } 
        $this->_mostrar($causa);
      }

      public function unirse(){
      //verify session
        if (!isset($_SESSION)) {
          return call("usuarios","login");

        }elseif ($_SESSION['valid']==false ) {
          return call("usuarios","login");

        }
        elseif ($_SESSION['us_id']==null ) {

          return call("usuarios","login");
        }
        
        /*        
        $_SESSION['valid']        = true;
        $_SESSION['timeout']      = time();
        $_SESSION['us_usuario']   = $DBuser->usuario;
        $_SESSION['us_email']     = $DBuser->email;    
        $_SESSION['us_id']        = $DBuser->id;
        $_SESSION['us_tipo']      = $DBuser->tipo;
        $_SESSION['us_estado']    = $DBuser->estado;
        $_SESSION['us_nombre']    = $DBuser->nombre;
        $_SESSION['us_apellido']  = $DBuser->apellido;
        $_SESSION['us_avatar']    = $DBuser->avatar;   
        */ 
        $id         = "";
        $causa      = "";
        $usuario    = $_SESSION['us_id'];
        $creado     = "";
        $modificado = "";
      //echo "creadondo comentario";


        if (isset($_POST['hiddenSeguir'])) {
          $error  = null;
          $causa  = trim( $_POST['InputSeguirCausa'] );

          if ($error==null) {
            Causa::nuevoSeguidor($causa,$usuario);
            $causaObj   = Causa::find($causa);
            $usuarioObj = Usuario::find($causaObj->usuario);
            $seguidores = Causa::findSeguidores($causa);

            /*if (count($seguidores)>0) {
              foreach ($seguidores as $seguidor) {
                
                $segObj= Usuario::find($seguidor['us_id']);
                $this->mail($segObj, $causaObj, $seguidores, "unirse");
              }
            } */           
            $this->mail($usuarioObj, $causaObj, $seguidores, "unio");
          }

        } 
        $this->_mostrar($causa);
      }

      public function responder(){

      }


      public function mapaTransito(){
        $mapatipo="de Transito";
        $causas = Causa::buscarPorCategoria(3,"LIMIT 100");
        $ultimasCausas=Causa::buscarPorCategoria(3, "LIMIT 10");
        $masSeguidasCausas=Causa::buscarPorCategoriaOrdenarSeguidores(3, "LIMIT 10");
        require_once('vistas/causas/indexMapXML.php');  
      }

      public function mapaSenaletica(){
        $mapatipo="de Señaletica";
        $causas = Causa::buscarPorCategoria(2,"LIMIT 100");
        $ultimasCausas=Causa::buscarPorCategoria(2, "LIMIT 10");
        $masSeguidasCausas=Causa::buscarPorCategoriaOrdenarSeguidores(2, "LIMIT 10");
        require_once('vistas/causas/indexMapXML.php');    
      }
      public function mapaVial(){
        $mapatipo="Vial";
        $causas = Causa::buscarPorCategoria(1);
        $ultimasCausas=Causa::buscarPorCategoria(1, "LIMIT 10");
        $masSeguidasCausas=Causa::buscarPorCategoriaOrdenarSeguidores(1, "LIMIT 10");
        require_once('vistas/causas/indexMapXML.php');    
      }

      public function mapa(){
        $mapatipo="all";
        $causas = Causa::allActivos("LIMIT 100");
        $ultimasCausas=Causa::allActivos("LIMIT 10");
        $masSeguidasCausas=Causa::allOrdenarSeguidores("LIMIT 10");
        require_once('vistas/causas/indexMapXML.php');   
      }

      public static function mail($usuario, $causa, $seguidores, $accion){
        $urlbase="http://cupontu.com/tesis/proyecto-titulo/public_html/";
        // multiple recipients
        $to  = $usuario->email .','; // note the comma
        //echo "<div class='well bg-sucess'><p>Correo enviado a: ".$to."<p></div>";
        //$to .= 'wez@example.com';
        $subject="";
        //$mensaje=null;

        switch ($accion) {
          case 'crear':
            $subject = 'Creaste una nueva Causa en mimejorciudad.cl ';
            $mensaje["titulo"]="En Hora Buena Creaste Una nueva Causa en Mimejorciudad.cl !";
            $mensaje["contenido"]='
            <h3>Hola '.$usuario->nombre.',</h3>
            <p> Gracias por confiar en nuestra plataforma y crear una nueva Causa.
              Su Causa "'.$causa->nombre.'" ha sido creada y <strong>esta esperando por la validacion de un moderador.</strong></p>

              <p>A continuación, Recibira un mensaje cuando su causa sea validada.<p>
                ';
          break;
          case 'comentar':
            $subject = 'Han comentado una Causa Tuya en mimejorciudad.cl ';
            $mensaje["titulo"]="Recibiste un nuevo Comentario para tu Causa - Mimejorciudad.cl !";
            $mensaje["contenido"]='
            <h3>Hola '.$usuario->nombre.',</h3>
            <p>Tu causa "'.$causa->nombre.'" ha sido comentada recientemente.</p>
            <p>puedes ver el comentario en la pagina de detalle de la causa en el siguiente enlace:</p>
            <a href="'.$urlbase.'/index.php?controlador=causas&accion=ver&id='.$causa->id.'"> Ver mi Causa </a>

            <p>Saludos, del equipo de Mimejorciudad.cl<p>
              ';
          break;
          case 'comento':
            $subject = 'Han comentado una Causa Que Sigues en mimejorciudad.cl ';
            $mensaje["titulo"]="Hay un nuevo Comentario para la Causa ".$usuario->nombre."- Mimejorciudad.cl !";
            $mensaje["contenido"]='
            <h3>Hola '.$usuario->nombre.',</h3>
            <p>Tu causa "'.$causa->nombre.'" ha sido comentada recientemente.</p>
            <p>puedes ver el comentario en la pagina de detalle de la causa en el siguiente enlace:</p>
            <a href="'.$urlbase.'/index.php?controlador=causas&accion=ver&id='.$causa->id.'"> Ver mi Causa </a>

            <p>Saludos, del equipo de Mimejorciudad.cl<p>
              ';
          break;
          case 'unirse':
            $subject = 'Tienes 1 Nuevo Seguidor en Tu Causa -mimejorciudad.cl ';
            $mensaje["titulo"]="Recibiste un nuevo Seguidor para tu Causa - Mimejorciudad.cl !";
            $mensaje["contenido"]='
            <h3>Hola '.$usuario->nombre.',</h3>
            <p>Tu causa "'.$causa->nombre.'" Tiene un nuevo Seguidor.</p>
            <h3>Ahora tienes '.count($seguidores).' Seguidores</h3>
            <p>puedes ver el detalle de la causa en el siguiente enlace:</p>
            <a href="'.$urlbase.'/index.php?controlador=causas&accion=ver&id='.$causa->id.'"> Ver mi Causa </a>


            <p>Saludos, del equipo de Mimejorciudad.cl<p>
              ';
          break;
          case 'unio':

            $subject = '1 Nuevo seguidor Para la Causa -mimejorciudad.cl ';
            $mensaje["titulo"]="La causa Que sigues recibio un nuevo Seguidor - Mimejorciudad.cl !";
            $mensaje["contenido"]='
            <h3>Hola '.$usuario->nombre.',</h3>
            <p>Tu causa "'.$causa->nombre.'" Tiene un nuevo Seguidor.</p>
            <h3>Ahora tiene '.count($seguidores).' Seguidores</h3>
            <p>puedes ver el detalle de la causa en el siguiente enlace:</p>
            <a href="'.$urlbase.'/index.php?controlador=causas&accion=ver&id='.$causa->id.'"> Ver mi Causa </a>


            <p>Saludos, del equipo de Mimejorciudad.cl<p>
                      ';
          break;
          case 'validar':

            $subject = 'Su causa Validada -mimejorciudad.cl ';
            $mensaje["titulo"]="La causa Que Creaste ha sido validada por el administrador- Mimejorciudad.cl !";
            $mensaje["contenido"]='
            <h3>Hola '.$usuario->nombre.',</h3>
            <p>Tu causa "'.$causa->nombre.'" Ahora es nuestra causa.</p>

            <p>puedes ver el detalle de la causa en el siguiente enlace:</p>
            <a href="'.$urlbase.'/index.php?controlador=causas&accion=ver&id='.$causa->id.'"> Ver mi Causa </a>


            <p>Saludos, del equipo de Mimejorciudad.cl<p>
              ';
          break;
          case 'firmar':

            $subject = 'Peticion de Solución -mimejorciudad.cl ';
            $mensaje["titulo"]="La causa Que Creaste ha sido enviada a la Municipalidad- Mimejorciudad.cl !";


            $autoridad=Causa::buscarAutoridades($causa->respuesta);
            $string_seguidores="";
            if ($seguidores>1) {
              $string_seguidores=$string_seguidores."<p>Firman:</p>";
              $string_seguidores=$string_seguidores."<p>".$usuario->nombre." ".$usuario->apellido."</p>";
              foreach ($seguidores as $seg) {
                $string_seguidores=$string_seguidores."<p>".$seg['nombre']." ".$seg['apellido']."</p>";
              }
            }

            $mensaje["contenido"]='

            <p>Señores(as)</p>
            <p>'.$autoridad->nombre.'</p>

            <p>Exelentisimos(as):</p>

            <p>De nuestra consideración, el sitio web mimejorciudad.cl tiene como objetivo fomentar y promover el uso de herramientas tecnologicas para mejorar el entorno y el uso de la via publica para y por los ciudadanos;  buscando en esto que sus usuarios mejoren su calidad de vida a través de ella.
             Pone a su Disposición la informacion sobre una problematica que aqueja a sus ciudadanos y vecinos; esta Problematica, informamos a uusted a continuacion:</p>
             <p><strong>'.$causa->nombre.'</strong></p>
             <p><strong>'.$causa->Descripcion.'</strong></p>
             '.$string_seguidores.'
             <p>Nuestro interés, al igual que el suyo, es trabajar por el bienestar de la comunidad. Es por esto que solicitamos a usted, disponga la implementación en el menor plazo de una solucion para la problematica de nuestros usuarios y sus veciones, en función de colaborar con la puesta en marcha; en nuestro sitio web usted podra comunicarse con los ciudadanos afectados o analizar mas problematicas que van surgiendo y compartiendo por la comunidad.
             </p>
             <p>Conocedores de su buena disposición, </p>
             <p>quedamos atentos a su respuesta, sin otro particular se despide cordialmente,</p>

             <p>Esteban Gonzalez</p>
             <p>Representante</p>
             <p>mimejorciudad.cl</p>
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
        //$headers .= 'To: Esteban <esteban@gmail.com>' . "\r\n";
          $headers .= 'From: mimejorciudad.cl <no-reply@mimejorciudad.cl>' . "\r\n";

        // Mail it
        //
        if ($accion=="firmar") {
          echo $plantilla_email;
        }
           mail($to, $subject, $plantilla_email, $headers);
        }
      }
?>