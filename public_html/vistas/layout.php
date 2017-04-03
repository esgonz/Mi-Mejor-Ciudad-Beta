<?php 
  
  $urlbase="http://cupontu.com/tesis/proyecto-titulo/public_html/"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Mimejorciudad.cl</title>

     <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/Style.css" rel="stylesheet">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</style>

</head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
  </div>
</nav>

<nav class="navbar navbar-default navbar-fixed-top">  
  <div class="container-fluid"> 
    <div class="navbar-header"> 
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6" aria-expanded="false"> 
        <span class="sr-only">Ocultar</span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button> 

      <a class="navbar-brand" href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php">
        <img class="logo"src="css/img/logo_mejorciudad.png">
      </a> 
    </div> 
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6"> 
      <ul class="nav navbar-nav"> 
        <li class="active">
          <a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php">
            Inicio
          </a>
        </li> 
        <li>
          <a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapa">
            Mapa
          </a>
        </li>
        <li>
         <a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapaVial">
           Mapa Vial
         </a>
       </li>
       <li>
         <a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapaTransito">
           Mapa Transito
         </a>
       </li>
       <li>
         <a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapaSenaletica">
           Mapa Señaletica
         </a>
       </li>
       <li>
         <a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=crear">
           Crear Nueva Causa
         </a>
       </li>  
     </ul>


      <ul class="nav navbar-nav navbar-right">
      	<?php if ($_SESSION['valid']) : ?>
      		<li><a href="#">Hola <?php echo $_SESSION['us_nombre']; ?></a></li>
      		<li><a class="btn btn-default navbar-btn" href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=usuarios&accion=logout">Cerrar Sesion</a></li>
      	<?php
      		else:?>
      		<li><a class="btn btn-default navbar-btn" href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=usuarios&accion=login">iniciar Sesion</a></li>
      		<?php endif;?>
        
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=listar">Ver mis Causas</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=moderar">Ver Lista Causas (moderador)</a></li>
          </ul>
        </li>
      </ul>     
   </div>
 </div> 
</nav>      






<!--pagecontent-->
<div class="container containerMain">
        <!-- Content Row -->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
             <?php require_once('routes.php'); ?>
          </div>
         
        </div>
        <!-- Footer -->
        <footer>
          <div class="container text-center">
              <hr />
            <div class="row">
              <div class="col-lg-12">
                <div class="col-md-4">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php">Inicio</a></li>
                    <li><a href="#">Sobre nosotros</a></li>
                    <li><a href="#">Blog</a></li>
                  </ul>
                </div>
                <div class="col-md-4">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=crear">Crear una nueva Causa</a></li>
                    <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapa">Ver Mapa de Causas</a></li>
                    <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapaViales">Ver Mapa de Causas Viales</a></li>
                    <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapaTransito">Ver Mapa de Causas Transito</a></li> 
                    <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=causas&accion=mapaSenaletica">Ver Mapa de Causas Señaletica</a></li>         
                  </ul>
                </div>
                <div class="col-md-4">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=usuarios&accion=login">Iniciar Sesion</a></li>
                    <li><a href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=usuarios&accion=registrar">Registrarse</a></li>
                  </ul>
                </div>  
              </div>
            </div>
            <hr>
              <div class="row">
                  <div class="col-lg-12">
                      <ul class="nav nav-pills nav-justified">
                          <li><a  href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php">
        <img class="logo-footer"src="css/img/logo_mejorciudad.png">
      </a></li>
                          <li><a href="#">Terminos Servicio</a></li>
                          <li><a href="#">Privacidad</a></li>
                      </ul>
                  </div>
              </div>
          </div>
        </footer>

</div><!-- /pagecontent-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Google Maps js -->


</body></html>