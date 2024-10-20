<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
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
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalInsertarProducto">
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
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Precio de Compra</th>
                            <th>Precio de Venta</th>
                            <th>Categoría</th>
                            <th>Proveedor</th>
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

                                $respuesta = ProductosController::ctrMostrarProductos($item, $valor);

                                foreach ($respuesta as $key => $value) {

                                    if($value["estatus"] == 1){
                                        $estatus = '<span style="cursor:context-menu" class="btn btn-xs btn-success">Activado</span>';
                                    }else{
                                        $estatus = '<span style="cursor:context-menu" class="btn btn-xs btn-danger">Desactivado</span>';
                                    }

                                    $itemCategoria = "idCategoria";
                                    $valorCategoria = $value["categoria"];

                                    $respuestaCategoria = CategoriasController::ctrMostrarCategorias($itemCategoria, $valorCategoria);
                                    
                                    $itemProveedor = "idProveedor";
                                    $valorProveedor = $value["proveedor"];

                                    $respuestaProveedores = ProveedoresController::ctrMostrarProveedores($itemProveedor, $valorProveedor);

                                    $itemInventario = "producto";
                                    $valorInventario = $value["idProducto"];

                                    $respuestaInventario = InventariosController::ctrMostrarInventario($itemInventario, $valorInventario);

                                    echo '
                                    <tr>
                                        <td>'.($key + 1 ).'</td>
                                        <td><img width="50px" src="'.$value["imagen"].'"></td>
                                        <td>'.$value["codigo"].'</td>
                                        <td>'.$value["descripcion"].'</td>
                                        <td>'.$value["precioCompra"].'</td>
                                        <td>'.$value["precioVenta"].'</td>
                                        <td>'.$respuestaCategoria[0]["descripcion"].'</td>
                                        <td>'.$respuestaProveedores[0]["nombre"].'</td>
                                        <td>'.$estatus.'</td>';
                                        
                                        if($_SESSION['perfil'] == 1){

                                                echo '<td>
                                            <button type="button" class="btn btn-warning btn-xs btnEditarProducto" idProducto="'.$value["idProducto"].'" data-toggle="modal" data-target="#modalEditarProducto"><i class="fas fa-edit"></i></button>';
                                            if($value["estatus"] == 1){
                                                echo '<button type="button" class="btn btn-danger btn-xs btnEliminarProducto" idProducto="'.$value["idProducto"].'"><i class="fas fa-power-off"></i></button>';

                                                if(count($respuestaInventario) == 0){
                                                    echo '<button type="button" class="btn btn-success btn-xs btnTrasladarInventario" idProducto="'.$value["idProducto"].'" data-toggle="modal" data-target="#modalAgregarInventario"><i class="fas fa-plus"></i></button>';
                                                }
                                            }else{
                                                echo '<button type="button" class="btn btn-success btn-xs btnActivarProducto" idProducto="'.$value["idProducto"].'"><i class="fas fa-power-off"></i></button>';
                                            }
                                        echo '</td>';

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

    <div class="modal fade" id="modalInsertarProducto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header" style="color: white; background-color:#0069d9">
                        <h4 class="modal-title">Nuevo Producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoCodigoProducto">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el código" name="nuevoCodigoProducto" id="nuevoCodigoProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="nuevaDescripcionProducto">Descripción</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese la descripción" name="nuevaDescripcionProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoPrecioCompraProducto">Precio de Compra</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control" placeholder="Ingrese el precio de compra" name="nuevoPrecioCompraProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoPrecioVentaProducto">Precio de Venta</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrow-down"></i></span>
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control" placeholder="Ingrese el precio de venta" name="nuevoPrecioVentaProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoCorreoProveedor">Categoría</label>
                                    <div class="input-group mb-3">
                                        <select name="nuevaCategoriaProducto" class="form-control">
                                            <option value="">Seleccione una categoría</option>
                                            <?php
                                            
                                            $itemDDCategoria = "estatus";
                                            $valorDDCategoria = 1;

                                            $respuestaDDCategoria = CategoriasController::ctrMostrarCategorias($itemDDCategoria, $valorDDCategoria);

                                            foreach ($respuestaDDCategoria as $key => $value) {
                                                
                                                echo '<option value="'.$value["idCategoria"].'">'.$value["descripcion"].'</option>';

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nuevoCorreoProveedor">Proveedor</label>
                                    <div class="input-group mb-3">
                                        <select name="nuevoProveedorProducto" class="form-control">
                                            <option value="">Seleccione un proveedor</option>
                                            <?php
                                            
                                            $itemDDProveedor = "estatus";
                                            $valorDDProveedor = 1;

                                            $respuestaDDProveedor = ProveedoresController::ctrMostrarProveedores($itemDDProveedor, $valorDDProveedor);

                                            foreach ($respuestaDDProveedor as $key => $value) {
                                                
                                                echo '<option value="'.$value["idProveedor"].'">'.$value["nombre"].'</option>';

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevaDireccionProveedor">Imagen</label>
                                    <hr>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="nuevaImagen" name="nuevaImagenProducto">
                                        </div>
                                    </div>
                                    <p class="help-block">Peso máximo de la imagen 2MB</p>
                                    <img src="views/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>

                    <?php
                    
                        $insertarProveedor = new ProductosController();
                        $insertarProveedor -> ctrInsertarProductos();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalEditarProducto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header" style="color: white; background-color:#ffc107">
                        <h4 class="modal-title">Editar Producto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarCodigoProducto">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el código" name="editarCodigoProducto" readonly id="editarCodigoProducto">
                                        <input type="hidden" name="editarIdProducto" id="editarIdProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="editarDescripcionProducto">Descripción</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese la descripción" name="editarDescripcionProducto" id="editarDescripcionProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarPrecioCompraProducto">Precio de Compra</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control" placeholder="Ingrese el precio de compra" name="editarPrecioCompraProducto" id="editarPrecioCompraProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarPrecioVentaProducto">Precio de Venta</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrow-down"></i></span>
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control" placeholder="Ingrese el precio de venta" name="editarPrecioVentaProducto" id="editarPrecioVentaProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarCategoriaProducto">Categoría</label>
                                    <div class="input-group mb-3">
                                        <select name="editarCategoriaProducto" id="editarCategoriaProducto" class="form-control">
                                            <option value="">Seleccione una categoría</option>
                                            <?php
                                            
                                            $itemDDCategoria = "estatus";
                                            $valorDDCategoria = 1;

                                            $respuestaDDCategoria = CategoriasController::ctrMostrarCategorias($itemDDCategoria, $valorDDCategoria);

                                            foreach ($respuestaDDCategoria as $key => $value) {
                                                
                                                echo '<option value="'.$value["idCategoria"].'">'.$value["descripcion"].'</option>';

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="editarProveedorProducto">Proveedor</label>
                                    <div class="input-group mb-3">
                                        <select name="editarProveedorProducto" id="editarProveedorProducto" class="form-control">
                                            <option value="">Seleccione un proveedor</option>
                                            <?php
                                            
                                            $itemDDProveedor = "estatus";
                                            $valorDDProveedor = 1;

                                            $respuestaDDProveedor = ProveedoresController::ctrMostrarProveedores($itemDDProveedor, $valorDDProveedor);

                                            foreach ($respuestaDDProveedor as $key => $value) {
                                                
                                                echo '<option value="'.$value["idProveedor"].'">'.$value["nombre"].'</option>';

                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevaDireccionProveedor">Imagen</label>
                                    <hr>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="nuevaImagen" name="editarImagenProducto" id="editarImagenProducto">
                                            <input type="hidden" name="imagenActualProducto" id="imagenActualProducto">
                                        </div>
                                    </div>
                                    <p class="help-block">Peso máximo de la imagen 2MB</p>
                                    <img src="views/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </div>
                    <?php

                        $editarProductos = new ProductosController();
                        $editarProductos -> ctrEditarProductos();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modalAgregarInventario">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header" style="color: white; background-color:#28a745">
                        <h4 class="modal-title">Agregar Inventario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevoCodigoProducto">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el código" readonly name="nuevoCodigoProducto" id="codigoInventarioProducto">
                                        <input type="hidden" name="idInventarioProducto" id="idInventarioProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDescripcionProducto">Descripción</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese la descripción" readonly name="descripcionInventarioProducto" id="descripcionInventarioProducto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDescripcionProducto">Stock</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="number" min="0" step="1" class="form-control" placeholder="Ingrese la cantidad a ingresar" name="nuevaCantidadInventario" id="nuevaCantidadInventario">
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
                    
                        $insertarInventario1 = new InventariosController();
                        $insertarInventario1 -> ctrInsertarProductos();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php
    
        $eliminarProveedor = new ProductosController();
        $eliminarProveedor -> ctrActualizarProductos();

    ?>