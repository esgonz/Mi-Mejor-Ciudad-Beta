<?php
  class Autoridad {
    // we define 3 attributes
    // they are public so that we can access them using $Autoridad->author directly
    public $id;
    public $nombre;
    public $descripcion;
    public $email;

    public $creado;
    public $modificado;

    public function __construct($id, $nombre, $descripcion, $email) {
      $this->id         = $id;
      $this->nombre   = $nombre;
      $this->descripcion  = $descripcion;
      $this->email  = $email;

      $this->creado  = $creado;
      $this->modificado = $modificado;

    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM autoridades');

      // we create a list of Autoridad objects from the database results
      foreach($req->fetchAll() as $descripcion) {
        $list[] = new Autoridad($descripcion['id'], $descripcion['nombre'], $descripcion['descripcion'], $descripcion['descripcion']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM autoridades WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $descripcion = $req->fetch();

      return new Autoridad($descripcion['id'], $descripcion['nombre'], $descripcion['descripcion'], $descripcion['descripcion']);
    }
  }
?>