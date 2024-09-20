<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Configuracion</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Configuracion</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
   
        $item = "idUsuario";
        $valor = $_SESSION["id"];

        $usuario = UsuariosController::ctrMostrarUsuarios($item, $valor);

        $itemNivel = "idNivel";
        $valorNivel = $usuario["nivel"];

        $nivel = UsuariosController::ctrMostrarNivelesUsuario($itemNivel, $valorNivel);

    ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-outline card-info">
                    <div class="car-body p-2">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="<?php echo $usuario["imagen"] ?>" width="150px" alt="">
                            </div>
                            <div class="col-md-12">
                                <h3 class="text-center"><?php echo $usuario["nombre"] ?></h3>
                                <hr>
                                <p><b>Código: </b> <?php echo $usuario["codigo"] ?></p>
                                <p><b>Usuario: </b> <?php echo $usuario["usuario"] ?></p>
                                <p><b>Dirección: </b> <?php echo $usuario["direccion"] ?></p>
                                <p><b>Teléfono: </b> <?php echo $usuario["telefono"] ?></p>
                                <p><b>Correo: </b> <?php echo $usuario["correo"] ?></p>
                                <p><b>Nivel: </b> <?php echo $nivel["descripcion"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-outline card-warning">
                    <div class="card-body p2">
                        <form enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarNombreInstitucion">Nombre</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                            </div>
                                            <input value="<?php echo $usuario["nombre"] ?>" type="text" class="form-control" placeholder="Ingrese el nombre" name="editarNombreUsuario">
                                            <input value="<?php echo $usuario["idUsuario"] ?>" type="hidden"  name="editarIdUsuario">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="passwordActual">Password</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Ingrese la contraseña" name="editarPasswordUsuario">
                                            <input type="hidden" value="<?php echo $usuario["password"] ?>" name="passwordActual">
                                            <input type="hidden" name="editarNivelUsuario" value="<?php echo $usuario["nivel"] ?>">
                                            <input type="hidden" name="editarCodigoUsuario" value="<?php echo $usuario["codigo"] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarDireccionUsuario">Dirección</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="text" value="<?php echo $usuario["direccion"] ?>" class="form-control" placeholder="Ingrese la dirección" name="editarDireccionUsuario">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarTelefonoUsuario">Teléfono</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                            </div>
                                            <input type="text" value="<?php echo $usuario["telefono"] ?>" class="form-control" placeholder="Ingrese el número de telefono" name="editarTelefonoUsuario">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarCorreoUsuario">Correo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                                            </div>
                                            <input type="text" value="<?php echo $usuario["correo"] ?>" class="form-control" placeholder="Ingrese el correo electrónico" name="editarCorreoUsuario">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nuevaDireccionProveedor">Imagen</label>
                                        <hr>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="nuevaImagen" name="editarImagenUsuario">
                                                <input type="hidden" name="editarImagenActualUsuario" value="<?php echo $usuario["imagen"] ?>">
                                            </div>
                                        </div>
                                        <p class="help-block">Peso máximo de la imagen 2MB</p>
                                        <img src="<?php echo $usuario["imagen"] ?>" class="img-thumbnail previsualizar" width="100px">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6"></div>
                                <div class="col-6 text-right">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                                </div>
                            </div>
                            <?php
                            
                                $editarUsuario = new UsuariosController();
                                $editarUsuario -> ctrModificarUsuario();

                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->