<?php

        if($_SESSION['perfil'] != 1){
            echo '<script>window.location = "inicio"</script>';
        }

?>
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
    
        $institucion = InstitucionController::ctrMostrarInstitucion();
        

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
                                <img src="<?php echo $institucion["logotipo"] ?>" width="150px" alt="">
                            </div>
                            <div class="col-md-12">
                                <h3 class="text-center"><?php echo $institucion["razonSocial"] ?></h3>
                                <hr>
                                <p><b>Dirección: </b> <?php echo $institucion["direccion"] ?></p>
                                <p><b>NIT: </b> <?php echo $institucion["nit"] ?></p>
                                <p><b>Teléfono: </b> <?php echo $institucion["telefono"] ?></p>
                                <p><b>Correo: </b> <?php echo $institucion["correo"] ?></p>
                                <p><b>Sitio Web: </b> <?php echo $institucion["sitioWeb"] ?></p>
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
                                            <input value="<?php echo $institucion["nombre"] ?>" type="text" class="form-control" placeholder="Ingrese el nombre" name="editarNombreInstitucion">
                                            <input value="<?php echo $institucion["idInstitucion"] ?>" type="hidden"  name="idInstitucion">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarRazonSocialInstitucion">Razón Social</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                            </div>
                                            <input type="text" value="<?php echo $institucion["razonSocial"] ?>" class="form-control" placeholder="Ingrese la razon social" name="editarRazonSocialInstitucion">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarNitInstitucion">NIT</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                            </div>
                                            <input type="text" value="<?php echo $institucion["nit"] ?>" class="form-control" placeholder="Ingrese el nit" name="editarNitInstitucion">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarTelefonoInstitucion">Teléfono</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                            </div>
                                            <input type="text" value="<?php echo $institucion["telefono"] ?>" class="form-control" placeholder="Ingrese la razon social" name="editarTelefonoInstitucion">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarCorreoInstitucion">Correo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                                            </div>
                                            <input type="text" value="<?php echo $institucion["correo"] ?>" class="form-control" placeholder="Ingrese el correo electrónico" name="editarCorreoInstitucion">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarSitioWebInstitucion">Sitio Web</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                            </div>
                                            <input type="text" value="<?php echo $institucion["sitioWeb"] ?>" class="form-control" placeholder="Ingrese el sitio web de la institucion" name="editarSitioWebInstitucion">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="editarRazonSocialInstitucion">Dirección</label>
                                        <div class="input-group mb-3">
                                            <textarea name="editarDireccionInstitucion" class="form-control" rows="10"><?php echo $institucion["direccion"] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nuevaDireccionProveedor">Imagen</label>
                                        <hr>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="nuevaImagen" name="editarImagenInstitucion">
                                                <input type="hidden" name="editarImagenActualInstitucion" value="<?php echo $institucion["logotipo"] ?>">
                                            </div>
                                        </div>
                                        <p class="help-block">Peso máximo de la imagen 2MB</p>
                                        <img src="<?php echo $institucion["logotipo"] ?>" class="img-thumbnail previsualizar" width="100px">
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
                            
                                $editarInstitucion = new InstitucionController();
                                $editarInstitucion -> ctrEditarInstitucion();

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