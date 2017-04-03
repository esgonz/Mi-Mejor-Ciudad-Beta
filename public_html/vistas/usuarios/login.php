  <div class="container">
  <div class="row">

  <?php 
    if ($error!=null) :?>
     <div class="thumbnail col-md-6 col-md-offset-3 bg-warning">
      
        <?php
        foreach ($error as $key => $value) {

          echo "<p class='bg-warning'>$key: $value .-</p>";
        }
        ?>
      
       </div>
    <?php endif;
    ?>
      <div class="thumbnail col-md-6 col-md-offset-3">
        <form class="form-signin" action="index.php?controlador=usuarios&accion=login" method="POST">
        <h2 class="form-signin-heading">Iniciar Sesion</h2>
        <div class="form-group">
          <label for="email" >Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="true" autofocus="">
        </div>
        <div class="form-group">
          <label for="password" >Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required="true">
        </div>        
        
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="enviar" id="enviar">Iniciar Sesion</button>
      </form>
      <hr>
        <h3>No tienes un Usuario ?</h3>
        <a class="btn btn-lg btn-success btn-block" href="http://cupontu.com/tesis/proyecto-titulo/public_html/index.php?controlador=usuarios&accion=registrar">Registrarse</a>
      </div>
    

  </div>
</div>



