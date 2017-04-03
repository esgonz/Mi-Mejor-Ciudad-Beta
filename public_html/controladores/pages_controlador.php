<?php
  class PagesController {
    public function home() {
      $url="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapa";
      $string = '<script type="text/javascript">';
      $string .= 'window.location = "' . $url . '"';
      $string .= '</script>';
      echo $string;
    }

    public function error() {
      $url="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapa";
        $string = '<script type="text/javascript">';
        $string .= 'window.location = "' . $url . '"';
        $string .= '</script>';
        echo $string;
    }
  }
?>