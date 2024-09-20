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
            <h1 class="m-0">Control de cheques</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Control de cheques</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalInsertarCheque">
                        <i class="fas fa-plus"></i>
                        Agregar
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped tablas">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Cheque</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Total</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                $item = null;

                                $valor = null;

                                $respuesta = ChequesController::ctrMostrarCheques($item, $valor);

                                foreach ($respuesta as $key => $value) {

                                    $itemUsuario = "idUsuario";
                                    $valorUsuario = $value["usuario"];

                                    $respuestaUsuario = UsuariosController::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                                    echo '
                                    <tr>
                                        <td>'.($key + 1 ).'</td>
                                        <td>'.$value["noCheque"].'</td>
                                        <td>'.$value["descripcion"].'</td>
                                        <td>'.$value["fecha"].'</td>
                                        <td>'.$value["concepto"].'</td>
                                        <td>'.$value["total"].'</td>
                                        <td>'.$respuestaUsuario["nombre"].'</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-xs btnEditarCheque" idCheque="'.$value["idControl"].'" data-toggle="modal" data-target="#modalEditarCheque"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-xs btnEliminarCheque" idCheque="'.$value["idControl"].'"><i class="fas fa-trash"></i></button>';
                                        echo '</td>
                                    </tr>
                                    ';
                                }

                            ?>
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <div class="modal fade" id="modalInsertarCheque">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header" style="color: white; background-color:#0069d9">
                        <h4 class="modal-title">Nuevo cheque</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoNoCheque">No. de Cheque</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de cheque" name="nuevoNoCheque">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevaFechaCheque">Fecha</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control"  name="nuevaFechaCheque">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoTotalCheque">Total</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-quora"></i></span>
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control" placeholder="Ingrese el total"  name="nuevoTotalCheque">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDescripcionCheque">Proveedor</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre a quien le paga" name="nuevaDescripcionCheque">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevoConceptoCheque">Concepto</label>
                                    <div class="input-group mb-3">
                                        <textarea name="nuevoConceptoCheque" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>

                    <?php
                    
                        $insertarCheque = new ChequesController();
                        $insertarCheque -> ctrInsertarCheque();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalEditarCheque">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header" style="color: white; background-color:#ffc107">
                        <h4 class="modal-title">Editar cheque</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarNoCheque">No. de Cheque</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de cheque" name="editarNoCheque" id="editarNoCheque">
                                        <input type="hidden" name="editarIdCheque" id="editarIdCheque">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarFechaCheque">Fecha</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control"  name="editarFechaCheque" id="editarFechaCheque">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarTotalCheque">Total</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-quora"></i></span>
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control" placeholder="Ingrese el total"  name="editarTotalCheque" id="editarTotalCheque">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editarDescripcionCheque">Proveedor</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre a quien le paga" name="editarDescripcionCheque" id="editarDescripcionCheque">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editarConceptoCheque">Concepto</label>
                                    <div class="input-group mb-3">
                                        <textarea name="editarConceptoCheque" id="editarConceptoCheque" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>
                    <?php

                        $editarCheque = new ChequesController();
                        $editarCheque -> ctrEditarCheque();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php
    
        $eliminarCHeque = new ChequesController();
        $eliminarCHeque -> ctrEliminarCheque();

    ?>