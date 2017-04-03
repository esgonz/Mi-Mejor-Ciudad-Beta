<?php
  class Mapa {
    // we define 3 attributes
    // they are public so that we can access them using $Mapa->author directly
    public $id;
    public $lat;
    public $lng;
    public $title;
    public $icon;
    public $creado;
    public $modificado;

    public function __construct($id, $lat, $lng, $title, $icon) {
      $this->id         = $id;
      $this->lat   = $lat;
      $this->lng  = $lng;
      $this->title  = $title;
      $this->icon  = $icon;
      $this->creado  = $creado;
      $this->modificado = $modificado;

    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM maps');

      // we create a list of Mapa objects from the database results
      foreach($req->fetchAll() as $mapa) {
        $list[] = new Mapa($mapa['id'], $mapa['lat'], $mapa['lng'], $mapa['mapa'],$mapa['icon']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM maps WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $mapa = $req->fetch();

      return new Mapa($mapa['id'], $mapa['lat'], $mapa['lng'], $mapa['mapa'],$mapa['icon']);
    }
  }
?>