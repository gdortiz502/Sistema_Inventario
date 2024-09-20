<?php

  $respuesta = InstitucionController::ctrMostrarInstitucion();

?>
<body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
            <a href="inicio"><?php echo $respuesta["nombre"] ?></a>
          </div>
          <!-- /.login-logo -->
          <div class="card">
            <div class="card-body login-card-body">
              <p class="login-box-msg">Ingresa tus credenciales para continuar</p>
        
              <form method="post">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Ingresa tu usuario" name="ingUsuario">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Ingresa tu contraseña" name="ingPassword">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- /.col -->
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                  </div>
                  <!-- /.col -->
                </div>
                <?php
                
                    $ingresar = new UsuariosController();
                    $ingresar -> ctrIngresoUsuarios();

                ?>
              </form>
              <!-- /.social-auth-links -->
            </div>
            <!-- /.login-card-body -->
          </div>
        </div>
        <!-- /.login-box -->