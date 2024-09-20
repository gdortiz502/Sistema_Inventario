<?php

    class InventariosController{

        public static function ctrMostrarInventario($item, $valor){

            $tabla = "inventario";

            $respuesta = InventariosModel::mdlMostrarInventario($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrInsertarProductos(){

            if(isset($_POST["idInventarioProducto"])){

                $tabla = "inventario";

                $datos = array(
                    "producto" => $_POST["idInventarioProducto"],
                    "cantidad" => $_POST["nuevaCantidadInventario"]
                );

                $respuesta = InventariosModel::mdlInsertarInventario($tabla, $datos);

                if($respuesta == "ok"){

                    $tablaHistorial = "historial";

                    $datosHistorial = array(
                        "descripcion" => "Inserción de ".$_POST["nuevaCantidadInventario"]." ". $_POST["descripcionInventarioProducto"]. " al inventario." ,
                        "usuario" => $_SESSION["id"]
                    );

                    $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                    if($respuestaHistorial == "ok"){

                        echo'<script>

                        swal.fire({
                            icon: "success",
                            title: "El inventario ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "inventario";
    
                                        }
                                    })
    
                        </script>';

                    }else{

                        var_dump($respuestaHistorial);

                    }

                }else{
                    var_dump($respuesta);
                }

            }

        }

        public static function ctrAgregarInventario(){

            if(isset($_POST["idInventarioAgregar"])){

                $tabla = "inventario";

                $datos = array(
                    "idInventario" => $_POST["idInventarioAgregar"],
                    "cantidad" => $_POST["nuevaCantidadProductoInventario"]
                );

                $respuesta = InventariosModel::mdlAgregarInventario($tabla, $datos);

                if($respuesta == "ok"){

                    $tablaHistorial = "historial";

                    $datosHistorial = array(
                        "descripcion" => "Inserción de ".$_POST["nuevaCantidadProductoInventario"]." ". $_POST["nuevaDescripcionProductoInventario"]. " al inventario." ,
                        "usuario" => $_SESSION["id"]
                    );

                    $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                    if($respuestaHistorial == "ok"){

                        echo'<script>

                        swal.fire({
                            icon: "success",
                            title: "El inventario ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "inventario";
    
                                        }
                                    })
    
                        </script>';

                    }else{

                        var_dump($respuestaHistorial);

                    }

                }else{
                    var_dump($respuesta);
                }

            }

        }

        public static function ctrRestarInventario(){

            if(isset($_POST["idInventarioRestar"])){

                $tabla = "inventario";

                $datos = array(
                    "idInventario" => $_POST["idInventarioRestar"],
                    "cantidad" => $_POST["editarCantidadProductoInventario"]
                );

                $respuesta = InventariosModel::mdlRestarInventario($tabla, $datos);

                if($respuesta == "ok"){

                    $tablaHistorial = "historial";

                    $datosHistorial = array(
                        "descripcion" => "Eliminacion de ".$_POST["editarCantidadProductoInventario"]." ". $_POST["editarDescripcionProductoInventario"]. " al inventario." ,
                        "usuario" => $_SESSION["id"]
                    );

                    $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                    if($respuestaHistorial == "ok"){

                        echo'<script>

                        swal.fire({
                            icon: "success",
                            title: "El inventario ha sido guardado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "inventario";
    
                                        }
                                    })
    
                        </script>';

                    }else{

                        var_dump($respuestaHistorial);

                    }

                }else{
                    var_dump($respuesta);
                }

            }

        }

    }