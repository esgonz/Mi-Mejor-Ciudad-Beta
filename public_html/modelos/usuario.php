<?php
  class Usuario {
    // we define 3 attributes
    // they are public so that we can access them using $Usuario->author directly
    public $id;
    public $tipo;
    public $estado;
    public $usuario;
    public $email;
    public $password;
    public $nombre ;
    public $avatar ;
    public $apellido ;
    public $creado;
    public $modificado;

    public function __construct($id, $tipo,$estado, $usuario, $email, $password, $nombre, $apellido,  $avatar,  $creado, $modificado ) {
      $this->id         = intval($id);
      $this->tipo   = intval($tipo);
      $this->estado   = intval($estado);
      $this->usuario  = $usuario;
      $this->email  = $email;
      $this->password  = $password;
      $this->nombre  = $nombre;
      $this->avatar  = $avatar;
      $this->apellido  = $apellido;
      $this->creado  = $creado;
      $this->modificado = $modificado;

    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM usuarios');

      // we create a list of Usuario objects from the database results
      foreach($req->fetchAll() as $usuario) {
        $list[] = new Usuario($usuario['us_id'], $usuario['us_tipo'],$usuario['us_estado'], $usuario['us_usuario'], $usuario['us_email'], $usuario['us_password'], $usuario['us_nombre'], $usuario['us_apellido'], $usuario['us_avatar'], $usuario['us_creado'], $usuario['us_modificado'] );
      }

      return $list;
    }


    public static function findVerif($verif="") {
      $db = Db::getInstance();
      $db->query("SET NAMES 'utf8'");
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM usuarios WHERE 1=1 AND '.$verif.' LIMIT 1;');

      // the query was prepared, now we replace :id with our actual $id value
      $req->execute();

      $usuario = $req->fetch();
      if (!$usuario) {
        return false;
      }
      
      return new Usuario($usuario['us_id'], $usuario['us_tipo'],$usuario['us_estado'], $usuario['us_usuario'], $usuario['us_email'], $usuario['us_password'], $usuario['us_nombre'], $usuario['us_apellido'], $usuario['us_avatar'], $usuario['us_creado'], $usuario['us_modificado']);
   
   }


    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM usuarios WHERE us_id = '.$id.' LIMIT 1;');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute();
      $usuario = $req->fetch();
      
     return new Usuario($usuario['us_id'], $usuario['us_tipo'],$usuario['us_estado'], $usuario['us_usuario'], $usuario['us_email'], $usuario['us_password'], $usuario['us_nombre'], $usuario['us_apellido'], $usuario['us_avatar'], $usuario['us_creado'], $usuario['us_modificado']);
   }


    public function insert(){
      $dateInsert =  date('Y-m-d H:i:s');        
      $db = Db::getInstance();
      $db->query("SET NAMES 'utf8'");

      $req = $db->prepare("INSERT INTO usuarios (us_id,  us_tipo, us_estado, us_usuario,  us_email,  us_password, us_nombre, us_apellido, us_avatar, us_creado, us_modificado) 
                            VALUES ( NULL, $this->tipo, $this->estado, '$this->usuario',  '$this->email',  '$this->password', '$this->nombre', '$this->apellido', '$this->avatar', '$dateInsert', '$dateInsert');");
      
      $req->execute();      
      $this->id= intval($db->lastInsertId());
      return $db->lastInsertId();
    }

    public function validar($id){
                   
      $db = Db::getInstance();
      $db->query("SET NAMES 'utf8'");

      $req = $db->prepare("UPDATE usuarios SET us_estado =1 WHERE us_id=".$id.";");

      $req->execute();      
      $this->id= intval($db->lastInsertId());
      return $db->lastInsertId();

    }
  }
?>