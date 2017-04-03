<?php
class Causa {
        // we define 3 attributes
        // they are public so that we can access them using $Causa->author directly
  public $id;
  public $nombre ;
  public $descripcion  ;
  public $usuario  ;
  public $categoria;    
  public $respuesta;
  public $url ;
  public $estado;    
  public $lat;
  public $lng;
  public $direccion;        
  public $creado;
  public $modificado;

  public function __construct($id, $nombre, $descripcion, $usuario, $categoria, $respuesta, $url , $estado, $lat, $lng, $direccion, $creado, $modificado ) {
    $this->id           = intval($id);
    $this->nombre       = ($nombre) ;
    $this->descripcion  = ($descripcion)  ;
    $this->usuario      = intval($usuario)  ;
    $this->categoria    = intval($categoria);    
    $this->respuesta    = intval($respuesta);
    $this->url          = $url ;
    $this->estado       = intval($estado);    
    $this->lat          = floatval($lat);
    $this->lng          = floatval($lng);
    $this->direccion    = ($direccion);        
    $this->creado       = $creado;
    $this->modificado   = $modificado;

  }

  public static function allActivos($limit="") {
    $list   = [];
    $db     = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $req    = $db->query('SELECT * FROM causas WHERE cs_estado=1 ORDER BY cs_creado DESC '.$limit.';');


          // we create a list of Causa objects from the database results

    foreach($req->fetchAll() as $causa) {
      $list[] = new Causa($causa['cs_id'], $causa['cs_nombre'], $causa['cs_descripcion'], $causa['cs_usuario'], $causa['cs_categoria'], $causa['cs_respuesta'], $causa['cs_url'], $causa['cs_estado'], $causa['cs_lat'], $causa['cs_lng'], $causa['cs_direccion'], $causa['cs_creado'], $causa['cs_modificado']); 
    }


    return $list;
  }

  public static function all($limit="") {
    $list = [];
    $db   = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $req  = $db->query('SELECT * FROM causas ORDER BY cs_creado DESC '.$limit.';');


        // we create a list of Causa objects from the database results

    foreach($req->fetchAll() as $causa) {
      $list[] = new Causa($causa['cs_id'], $causa['cs_nombre'], $causa['cs_descripcion'], $causa['cs_usuario'], $causa['cs_categoria'], $causa['cs_respuesta'], $causa['cs_url'], $causa['cs_estado'], $causa['cs_lat'], $causa['cs_lng'], $causa['cs_direccion'], $causa['cs_creado'], $causa['cs_modificado']); }


      return $list;
  }

  public static function find($id) {
    $db     = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
      // we make sure $id is an integer
    $id     = intval($id);
    $req    = $db->prepare('SELECT * FROM causas WHERE cs_id = :_id');
      // the query was prepared, now we replace :id with our actual $id value
    $req->execute(array('_id' => $id));
    $causa  = $req->fetch();

    return new Causa($causa['cs_id'], $causa['cs_nombre'], $causa['cs_descripcion'], $causa['cs_usuario'], $causa['cs_categoria'], $causa['cs_respuesta'], $causa['cs_url'], $causa['cs_estado'], $causa['cs_lat'], $causa['cs_lng'], $causa['cs_direccion'], $causa['cs_creado'], $causa['cs_modificado']); 
  }

  public static function findSeguidores($id) {
    $db   = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
      // we make sure $id is an integer
    $id   = intval($id);
    //SELECT * FROM  `seguidores` AS t1  INNER JOIN  `usuarios` AS t2 ON t1.usuario = t2.id
    $req  = $db->query('SELECT * FROM seguidores AS t1 INNER JOIN usuarios AS t2 ON `sg_usuario`= `us_id` WHERE `sg_causa`='.$id.';');

    $seguidores=$req->fetchAll();
      //echo "<pre>";
      //var_dump($seguidores);
      //echo "</pre>";


    foreach($seguidores as $seguidor) {
      $list[] = array(
        "id"        => $seguidor['us_id'], 
        "usuario"   => $seguidor['us_usuario'],
        "nombre"    => $seguidor['us_nombre'],
        "apellido"  => $seguidor['us_apellido'],   
        "avatar"    => $seguidor['us_avatar'], 
        );
    }


    return $list;
  }

  public static function buscarPorUsuario($usuario) {
    $list = [];
    $db   = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $req  = $db->query('SELECT * FROM causas WHERE cs_estado=1 AND cs_usuario ='.$usuario.';');
    $req->execute();

      // we create a list of Causa objects from the database results

    foreach($req->fetchAll() as $causa) {
      $list[] = new Causa($causa['cs_id'], $causa['cs_nombre'], $causa['cs_descripcion'], $causa['cs_usuario'], $causa['cs_categoria'], $causa['cs_respuesta'], $causa['cs_url'], $causa['cs_estado'], $causa['cs_lat'], $causa['cs_lng'], $causa['cs_direccion'], $causa['cs_creado'], $causa['cs_modificado']); 
    }


    return $list;
  }


  public static function getAutoridades(){
    $list = [];
    $db   = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $req  = $db->query('SELECT * FROM autoridades ;');
    $req->execute();

    // we create a list of Causa objects from the database results


    foreach($req->fetchAll() as $autoridad) {
      $varat = array(
        "id" => $autoridad['at_id'], 
        "nombre" => $autoridad['at_nombre'], 
        "descripcion" => $autoridad['at_descripcion'], 
        );
      array_push($list, $varat) ;
    }

    //var_dump($list);
    return $list;
  }

  public static function buscarAutoridades($id){
    $list = [];
    $db   = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $req  = $db->query('SELECT * FROM autoridades WHERE at_id='.intval($id).' ;');
    //var_dump($req);
    $req->execute();

    // we create a list of Causa objects from the database results

    $autoridad= $req->fetch();
    $varat  = array(
      "id"          => $autoridad['at_id'], 
      "nombre"      => $autoridad['at_nombre'], 
      "descripcion" => $autoridad['at_descripcion'],
      "email"       => $autoridad['at_email'], 
      );


    //var_dump($varat);
    return $varat;
  }

  public static function getCategorias(){
    $list = [];
    $db   = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $req  = $db->query('SELECT * FROM categorias ;');
    $req->execute();

    // we create a list of Causa objects from the database results


    foreach($req->fetchAll() as $categoria) {
      $varcat = array(
        "id"          => $categoria['ct_id'], 
        "nombre"      => $categoria['ct_nombre'], 
        "descripcion" => $categoria['ct_descripcion'], 
        );
      array_push($list, $varcat) ;
    }

    //var_dump($list);
    return $list;
  }
  public function insert(){
    $dateInsert =     date('Y-m-d H:i:s');        
    $db         = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $this->creado       = $dateInsert;
    $this->modificado   = $dateInsert;
    //$req = $db->prepare('INSERT INTO  `causas` (`cs_id` , `cs_nombre` , `cs_descripcion` , `cs_usuario` , `cs_categoria` , `cs_respuesta` , `cs_url` , `cs_estado` , `cs_lat` , `cs_lng` , `cs_direccion` , `cs_creado` , `cs_modificado` ) 
    //                      VALUES (NULL ,  "'.mysql_real_escape_string($this->nombre).'",  "'.mysql_real_escape_string($this->descripcion).'",  "$this->usuario",  "$this->categoria", "$this->respuesta" , "$this->url" ,  "$this->estado",  "$this->lat",  "$this->lng",  "'.mysql_real_escape_string($this->direccion).'", "$this->creado" , "$this->modificado" );');

    $req = $db->prepare("INSERT INTO  `causas` ( `cs_nombre` , `cs_descripcion` , `cs_usuario` , `cs_categoria` , `cs_respuesta` , `cs_url` , `cs_estado` , `cs_lat` , `cs_lng` , `cs_direccion` , `cs_creado` , `cs_modificado` ) 
      VALUES (:nombre , :descripcion , :usuario , :categoria , :respuesta , :url , :estado , :lat , :lng , :direccion , :creado , :modificado );");

    $req->execute( array(
      ':nombre'       => $this->nombre,
      ':descripcion'  => $this->descripcion,
      ':usuario'      => $this->usuario,
      ':categoria'    => $this->categoria ,
      ':respuesta'    => $this->respuesta,
      ':url'          => $this->url,
      ':estado'       => $this->estado,
      ':lat'          => $this->lat,
      ':lng'          => $this->lng,
      ':direccion'    => $this->direccion,    
      ':creado'       => $this->creado,
      ':modificado'   => $this->modificado));      
    $this->id   = intval($db->lastInsertId());
    return $db->lastInsertId();
  }

  public static function validar($id){
    $dateValidar  =  date('Y-m-d H:i:s');              
    $db           = Db::getInstance();
    $db->query("SET NAMES 'utf8'");

    $req = $db->prepare("UPDATE causas SET cs_creado ='".$dateValidar."', cs_estado=1 WHERE cs_id=".$id.";");

    $req->execute();      
    return $db->lastInsertId();
  }
  public static function nuevoSeguidor($causa_id, $user_id){
    $db = Db::getInstance();
    $db->query("SET NAMES 'utf8'");

    $causa_id   = intval($causa_id);
    $user_id    = intval($user_id);
    $req        = $db->prepare("INSERT INTO  `seguidores` (`sg_id` , `sg_usuario` , `sg_causa` , `sg_creado` , `sg_modificado` ) 
      VALUES (NULL ,  $user_id ,  $causa_id, NULL , NULL );");

    $req->execute();      

    return $db->lastInsertId();
  }
  public static function allOrdenarSeguidores($limit=""){
    $list = [];
    $db   = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $req  = $db->query('SELECT `cs_id`,`cs_nombre`,`cs_descripcion`,`cs_usuario`,`cs_categoria`,`cs_respuesta`,`cs_url`,`cs_estado`,`cs_lat`,`cs_lng`,`cs_direccion`,`cs_creado`,`cs_modificado`, count(sg_usuario) FROM causas INNER JOIN seguidores ON sg_causa= cs_id WHERE  cs_estado=1 GROUP BY cs_id ORDER BY count(sg_usuario) DESC '.$limit.' ;');
    if (!$req) {
      die('Invalid query: ' . mysql_error());
    }
    // we create a list of Causa objects from the database results
    foreach($req->fetchAll() as $causa) {
      $list[] = new Causa($causa['cs_id'], $causa['cs_nombre'], $causa['cs_descripcion'], $causa['cs_usuario'], $causa['cs_categoria'], $causa['cs_respuesta'], $causa['cs_url'], $causa['cs_estado'], $causa['cs_lat'], $causa['cs_lng'], $causa['cs_direccion'], $causa['cs_creado'], $causa['cs_modificado']); 
    }
    return $list;
  }
  public static function buscarPorCategoria($categoria, $limit="") {
    $list = [];
    $db   = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $req  = $db->query('SELECT * FROM causas WHERE cs_estado=1 AND cs_categoria='.$categoria.' '.$limit.';');
    $req->execute();

    // we create a list of Causa objects from the database results

    foreach($req->fetchAll() as $causa) {
      $list[] = new Causa($causa['cs_id'], $causa['cs_nombre'], $causa['cs_descripcion'], $causa['cs_usuario'], $causa['cs_categoria'], $causa['cs_respuesta'], $causa['cs_url'], $causa['cs_estado'], $causa['cs_lat'], $causa['cs_lng'], $causa['cs_direccion'], $causa['cs_creado'], $causa['cs_modificado']); 
    }


    return $list;
  }
  public static function buscarPorCategoriaOrdenarSeguidores($categoria, $limit="") {  
    //campo cs_campo
    //orden DESC
    $list = [];
    $db   = Db::getInstance();
    $db->query("SET NAMES 'utf8'");
    $req  = $db->query('SELECT `cs_id`,`cs_nombre`,`cs_descripcion`,`cs_usuario`,`cs_categoria`,`cs_respuesta`,`cs_url`,`cs_estado`,`cs_lat`,`cs_lng`,`cs_direccion`,`cs_creado`,`cs_modificado`, count(sg_usuario) FROM causas INNER JOIN seguidores ON sg_causa= cs_id WHERE  cs_estado=1 AND cs_categoria='.$categoria.' GROUP BY cs_id ORDER BY count(sg_usuario) '.$limit.';');
    $req->execute();

    // we create a list of Causa objects from the database results

    foreach($req->fetchAll() as $causa) {
      $list[] = new Causa($causa['cs_id'], $causa['cs_nombre'], $causa['cs_descripcion'], $causa['cs_usuario'], $causa['cs_categoria'], $causa['cs_respuesta'], $causa['cs_url'], $causa['cs_estado'], $causa['cs_lat'], $causa['cs_lng'], $causa['cs_direccion'], $causa['cs_creado'], $causa['cs_modificado']); 
    }


    return $list;
   }
  }
?>

