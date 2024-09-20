<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categorías</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Categorías</li>
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
                    <?php

                    if($_SESSION['perfil'] == 1){

                        echo '<div class="card-header">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalInsertarCategoria">
                        <i class="fas fa-plus"></i>
                        Agregar
                        </button>
                    </div>';

                    }

                    ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped tablas">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Estatus</th>
                            <?php

                            if($_SESSION['perfil'] == 1){

                                echo '<th>Acciones</th>';

                            }

                            ?>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                $item = null;

                                $valor = null;

                                $respuesta = CategoriasController::ctrMostrarCategorias($item, $valor);

                                foreach ($respuesta as $key => $value) {
                                    
                                    if($value["estatus"] == 1){
                                        $estatus = '<span style="cursor:context-menu" class="btn btn-xs btn-success">Activado</span>';
                                    }else{
                                        $estatus = '<span style="cursor:context-menu" class="btn btn-xs btn-danger">Desactivado</span>';
                                    }

                                    echo '
                                    <tr>
                                        <td>'.($key + 1 ).'</td>
                                        <td>'.$value["descripcion"].'</td>
                                        <td>'.$estatus.'</td>';
                                        
                                        if($_SESSION['perfil'] == 1){

                                            echo '<td>
                                            <button type="button" class="btn btn-warning btn-xs btnEditarCategoria" idCategoria="'.$value["idCategoria"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fas fa-edit"></i></button>';
                                            if($value["estatus"] == 1){
                                                echo '<button type="button" class="btn btn-danger btn-xs btnEliminarCategoria" idCategoria="'.$value["idCategoria"].'"><i class="fas fa-power-off"></i></button>';
                                            }else{
                                                echo '<button type="button" class="btn btn-success btn-xs btnActivarCategoria" idCategoria="'.$value["idCategoria"].'"><i class="fas fa-power-off"></i></button>';
                                            }

                                        echo'</td>';

                                        }

                                    echo '</tr>
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

    <div class="modal fade" id="modalInsertarCategoria">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header" style="color: white; background-color:#0069d9">
                        <h4 class="modal-title">Nueva Categoría</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDescripcionCategoria">Descripción</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-th"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese la descripción" name="nuevaDescripcionCategoria">
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
                    
                        $insertarCategoria = new CategoriasController();
                        $insertarCategoria -> ctrInsertarCategoria();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalEditarCategoria">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header" style="color: white; background-color:#ffc107">
                        <h4 class="modal-title">Editar Categoría</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="editarDescripcionCategoria">Descripción</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-th"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese la descripción" name="editarDescripcionCategoria" id="editarDescripcionCategoria">
                                        <input type="hidden" name="editarIdCategoria" id="editarIdCategoria">
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
                    
                        $editarCategoria = new CategoriasController();
                        $editarCategoria -> ctrEditarCategoria();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php
    
        $eliminarCategoria = new CategoriasController();
        $eliminarCategoria -> ctrActualizarCategoria();

    ?>