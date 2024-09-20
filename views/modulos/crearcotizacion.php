<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Crear Cotización</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Crear Cotización</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="card card-outline card-success">
      <form method="post">
        <div class="car-body">
          <div class="row p-3">
            <div class="col-4">
                <?php
                
                $respuestaInsitucion = InstitucionController::ctrMostrarInstitucion();

                if($respuestaInsitucion["logotipo"] != null){

                    $imagen = $respuestaInsitucion["logotipo"];

                }else{

                    $imagen = "views/img/logotipo/default_logo.png";

                }

                ?>


              <img src="<?php  echo $imagen ?>" width="150px" alt="">
            </div>
            <div class="col-4 text-center">
              <b><?php echo $respuestaInsitucion["razonSocial"] ?></b>
              <p style="margin:0; padding: 0"><?php echo $respuestaInsitucion["direccion"] ?></p>
            </div>
            <div class="col-4 text-center">
              <span style="display: block; font-size: 16px">Cotizaciones</span>
              <b style="display: block; font-size: 20px">Cotizacion No.</b>
              <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                  <?php
                  
                    $itemCotizacion = null;

                    $valorCotizacion = null;

                    $respuestaCotizacion = CotizacionesController::ctrMostrarCotizacionesSinFecha($itemCotizacion, $valorCotizacion);

                    if(!$respuestaCotizacion){
                      echo '<input type="text" class="form-control" name="noCotizacion" value="10001" readonly>';
                    }else{
                      foreach ($respuestaCotizacion as $key => $value) {
                        
                      }
                      $codigo = $value["noCotizacion"];
                      echo '<input type="text" class="form-control" name="noCotizacion" value="'.($codigo + 1).'" readonly>';
                    }

                  ?>
                </div>
                <div class="col-3"></div>
              </div>
            </div>
            <div class="col-12"><br></div>
            <div class="col-4">
            </div>
            <div class="col-4 text-center">
              <span style="display: block;"><b>NIT: </b><?php echo $respuestaInsitucion["nit"] ?></span>
              <span style="display: block;"><?php echo $respuestaInsitucion["razonSocial"] ?></span>
              <span style="display: block;"><?php echo $respuestaInsitucion["correo"] ?></span>
            </div>
            <div class="col-4">

            </div>
            <div class="col-12"><br></div>
            <div class="col-3 text-center"><span>Visitanos en <?php echo $respuestaInsitucion["sitioWeb"] ?></span></div>
            <div class="col-3 text-center">
              <img src="views/img/facebook.jpg" width="20px" alt="">
              <?php echo $respuestaInsitucion["nombre"] ?>
            </div>
            <div class="col-3"></div>
            <div class="col-3">
              <span>PBX: <?php echo $respuestaInsitucion["telefono"] ?></span>
            </div>
            <div class="col-12">
              <br>
            </div>
            <div class="col-4">
              <span style="display:block" class="d-flex mb-1"><b>NIT: </b> <input class="form-control form-control-sm  nitCliente" type="text" name="nitClienteCotizacion" placeholder="Ingrese el nit o codigo del cliente" required>
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalInsertarCliente">
                Agregar
              </button>
              </span>
            </div>
            <div class="col-4">
            <span style="display:block" class="d-flex mb-1"><b>Nombre: </b> <input class="form-control form-control-sm nombreCliente" type="text" name="nombreCliente" placeholder="Nombre del cliente" readonly>
            <input name="idClienteCotizacion" type="hidden" class="idClienteCotizacion"></span>
            </div>
            <div class="col-4">
              <span style="display:block" class="d-flex mb-1"><b>Dirección: </b> <input class="form-control form-control-sm  direccionCliente" type="text" name="direcccionClienteCotizacion" placeholder="Dirección del cliente  " readonly></span>
            </div>
            <div class="col-3">
              <span style="display:block" class="d-flex mb-1"><b>Vendedor: </b> <input class="form-control form-control-sm  vendedorCotizacion" type="text" name="vendedorCotizacion" value="<?php echo $_SESSION["nombre"] ?>" readonly></span>
              <span style="display:block" class="d-flex mb-1"><input type="hidden" name="idVendedorCotizacion" value="<?php echo $_SESSION["id"] ?>"></span>
            </div> 
            <div class="col-12">
              <br>
            </div>
            <div class="col-12">
              <div class="nuevoProducto">
                <b>Detalle</b>
                <hr>
                <div class="productos">

                </div>
                <input type="hidden" id="listaProductos" name="listaProductos">
              </div>
            </div> 
            <div class="col-4">
              <label for="comentarioCotizacion">Comentario</label>
              <textarea name="comentariosCotizacion" id="comentarioCotizacion" class="form-control" rows="3" ></textarea>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
              <div class="d-flex pb-1">
                <b class="col-4">Sub-Total</b>
                <input type="text" id="subTotalCotizacion" readonly class="form-control form-control-sm" required>
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">IVA 12%</b>
                <input type="text" id="ivaCotizacion" readonly class="form-control form-control-sm" required>
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">Descuento %</b>
                <input type="number" id="descuentoCotizacion" class="form-control form-control-sm">
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">Envío</b>
                <input type="number" name="envioCotizacion" id="envioCotizacion" class="form-control form-control-sm">
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">Total</b>
                <input type="text" id="totalCotizacion" name="totalCotizacion" readonly class="form-control form-control-sm" required>
              </div>
              <div class="d-flex pb-1">
                <b class="col-4">Método de Pago</b>
                <select id="metodoPagoCotizacion" name="metodoPagoCotizacion" class="form-control form-control-sm" required>
                  <option value="">Seleccione un metodo de pago</option>
                  <option value="efectivo">Efectivo</option>
                  <option value="deposito">Déposito</option>
                  <option value="credito">Crédito</option>
                </select>
              </div>
              <div class="txtPagar">
              </div>
            </div>
            <div class="col-4">
            </div>
            <div class="col-4"></div>
            <div class="col-4">
              <button type="submit" class="btn btn-success float-right" disabled id="btnGuardarCotizacion"><i class="fas fa-save"></i> Guardar Cotización</button>
            </div>
          </div>
        </div>
        <?php
        
          $crearCotizacion = new CotizacionesController();
          $crearCotizacion -> ctrInsertarCotizacion();

        ?>
      </form>
    </div>

    <div class="row">
      <div class="col-12">
          <div class="card card-outline card-success">
          <div class="card-header">
            <b>Productos</b>
          </div>
            <div class="card-body">
              <table class="table table-bordered table-stripeddt-responsive tablas" id="tablaProductosVentas">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                    $itemInventario = null;
                    $valorInventario = null;

                    $respuestaInventario = InventariosController::ctrMostrarInventario($itemInventario, $valorInventario);

                    foreach($respuestaInventario as $key => $value){

                      $itemProducto = "idProducto";
                      $valorProducto = $value["producto"];

                      $respuestaProducto = ProductosController::ctrMostrarProductos($itemProducto, $valorProducto);

                      if($value["cantidad"] < 0){
                        $stock = "<span class='btn btn-xs btn-info'>En transito</span>";
                      }else{
                        $stock = $value["cantidad"];
                      }

                      echo '
                        <tr>
                          <td>'.($key + 1).'</td>
                          <td>'.$respuestaProducto[0]["codigo"].'</td>
                          <td>'.$respuestaProducto[0]["descripcion"].'</td>
                          <td>'.$stock.'</td>
                          <td><div class="btn-group"><button class="btn btn-xs btn-success agregarProducto recuperarBoton" idProducto="'.$value["idInventario"].'">Agregar</button></div></td>
                        </tr>
                      ';
                      
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modalInsertarCliente">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header" style="color: white; background-color:#0069d9">
                        <h4 class="modal-title">Nuevo Cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoCodigoCliente">Código</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el código" name="nuevoCodigoCliente" id="nuevoCodigoCliente">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nuevoNitCliente">NIT</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-th"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el nit" name="nuevoNitCliente" id="nuevoNitCliente">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevoNombreCliente">Nombre</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el nombre" name="nuevoNombreCliente">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="nuevoTelefonoCliente">Teléfono</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el número de teléfono" name="nuevoTelefonoCliente">
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nuevoCorreoCliente">Correo</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ingrese el correo" name="nuevoCorreoCliente">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nuevaDireccionCliente">Dirección</label>
                                    <div class="input-group mb-3">
                                        <textarea rows="3" class="form-control" name="nuevaDireccionCliente" placeholder="Ingrese la dirección"></textarea>
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
                    
                        $insertarCliente = new ClientesController();
                        $insertarCliente -> ctrInsertarClientes();

                    ?>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->