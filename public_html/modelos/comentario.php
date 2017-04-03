<?php
  class Comentario {
    // we define 3 attributes
    // they are public so that we can access them using $Comentario->author directly
    public $id;
    public $causa;
    public $usuario;
    public $comentario;
    public $creado;
    public $modificado;

    public function __construct($id, $causa, $usuario, $comentario) {

      $this->id         = intval($id);
      $this->causa   = intval($causa);
      $this->usuario  = intval($usuario);
      $this->comentario  = $comentario;
      $this->creado  = 'creado';
      $this->modificado = 'modificado';
      //echo "<pre>";
      //var_dump($this);
      //echo"</pre>";

    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM comentarios');

      // we create a list of Comentario objects from the database results
      foreach($req->fetchAll() as $comentario) {
        $list[] = new Comentario($comentario['cm_id'], $comentario['cm_causa'], $comentario['cm_usuario'], $comentario['cm_comentario'],$comentario['cm_creado'],$comentario['cm_modificado']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM comentarios WHERE cm_id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $comentario = $req->fetch();

      return new Comentario($comentario['cm_id'], $comentario['cm_causa'], $comentario['cm_usuario'], $comentario['cm_comentario'],$comentario['cm_creado'],$comentario['cm_modificado']);
    }


    public static function findByCausa($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->query('SELECT cm_id, cm_causa, cm_comentario, cm_usuario, us_usuario, us_avatar FROM comentarios as t1 INNER JOIN usuarios ON cm_usuario= us_id WHERE cm_causa = '.$id.';');

      // we create a list of Comentario objects from the database results
      foreach($req->fetchAll() as $comentario) {

        $list[] = array(
              "cm_id" => $comentario['cm_id'], 
              "cm_causa" => $comentario['cm_causa'], 
               "cm_comentario" => $comentario['cm_comentario'], 
              "cm_usuario" => $comentario['cm_usuario'], 
              "us_usuario" => $comentario['us_usuario'], 
              "us_avatar" => $comentario['us_avatar'], 
               );
        

        //$list[] = new Comentario($comentario['cm_id'], $comentario['cm_causa'], $comentario['cm_usuario'], $comentario['cm_comentario'],$comentario['cm_creado'],$comentario['cm_modificado']);
      }

      return $list;
    }

    public function insert(){

      $db = Db::getInstance();
      $db->query("SET NAMES 'utf8'");
      // we make sure $id is an integer 

      //$req = $db->prepare("INSERT INTO  `causas` (`id` , `nombre` , `descripcion` , `usuario` , `categoria` , `respuesta` , `url` , `estado` , `lat` , `lng` , `direccion` , `creado` , `modificado` ) 
      //                      VALUES (NULL ,  'Caso 2 WEB',  'Caso lorem ipsup amet',  '1',  '1', NULL , NULL ,  '1',  '33.00873',  '-70.6877',  'almirante ''narroso'' 87#', NULL , NULL );");

      $req = $db->prepare("INSERT INTO  `comentarios` (`cm_id` , `cm_causa` , `cm_usuario` , `cm_comentario` , `cm_creado` , `cm_modificado`) 
                            VALUES (NULL ,  $this->causa,  $this->usuario,  '$this->comentario',  NULL , NULL);");
      $req->execute();      
      $this->id= intval($db->lastInsertId());
      return $db->lastInsertId();
          }
  }
?>