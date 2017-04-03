<?php
  class Respuesta {
    // we define 3 attributes
    // they are public so that we can access them using $Respuesta->author directly
    public $id;
    public $autoridad;
    public $respuesta;
    public $adjunto;

    public $creado;
    public $modificado;

    public function __construct($id, $autoridad, $respuesta, $adjunto) {
      $this->id         = $id;
      $this->autoridad   = $autoridad;
      $this->respuesta  = $respuesta;
      $this->adjunto  = $adjunto;

      $this->creado  = $creado;
      $this->modificado = $modificado;

    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM respuestas');

      // we create a list of Respuesta objects from the database results
      foreach($req->fetchAll() as $respuesta) {
        $list[] = new Respuesta($respuesta['id'], $respuesta['autoridad'], $respuesta['respuesta'], $respuesta['respuesta']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM respuestas WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $respuesta = $req->fetch();

      return new Respuesta($respuesta['id'], $respuesta['autoridad'], $respuesta['respuesta'], $respuesta['respuesta']);
    }
  }
?>