<?php

  function call($controller, $action) {
    // call the file of the controller to use
    require_once('controladores/' . $controller . '_controlador.php');

    // create a new instance of the controller
    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;

      case 'posts':
        // call the model appropriate for the controller
        require_once('modelos/post.php');
        $controller = new PostsController();
      break;

      case 'causas':
        //call the model appropriate for the controller
        require_once('modelos/causa.php');
        require_once('modelos/comentario.php');
        require_once('modelos/usuario.php');
        $controller = new CausaController();
      break;

      case 'usuarios':
        
        //call the model appropriate for the controller
        require_once('modelos/usuario.php');
        $controller = new UsuarioController();
      break;        
    }

    // call the action
    $controller->{ $action }();
  }

  // List of the controllers and their actions allowed
  $controllers = array(
    'pages'    => ['home', 'error'],
    'posts'    => ['index', 'show'],
    'usuarios' => ['listar', 'registrar','verificarUsuario','login','logout'],
    'causas'   => ['listar', 'ver','crear','mapa','comentar','unirse','mapaTransito',
                    'mapaSenaletica','mapaVial', 'validar','moderar','firmar']
  );

  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
      call('pages', 'error');
  }
?>