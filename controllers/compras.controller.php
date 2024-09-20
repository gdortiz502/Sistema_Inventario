<?php

    class ComprasController{

        public static function ctrMostrarCompras($item, $valor){

            $tabla = "compras";

            $respuesta = ComprasModel::mdlMostrarCompras($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrInsertarCompra(){

            if(isset($_POST["nuevoUuidCompra"])){

                if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["nuevoUuidCompra"]) ||
                   preg_match('/^[0-9]+$/', $_POST["nuevoNoFacturaCompra"]) || 
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoNoSerieCompra"]) ||
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ- ]+$/', $_POST["nuevaDescripcionCompra"]) ||
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ- ]+$/', $_POST["nuevoComentarioCompra"])){

                    $tabla = "compras";

                    $datos = array(
                        "descripcion" => $_POST["nuevaDescripcionCompra"],
                        "proveedor" => $_POST["nuevoProveedorCompra"],
                        "uuid" => $_POST["nuevoUuidCompra"],
                        "noSat" => $_POST["nuevoNoFacturaCompra"],
                        "serie" => $_POST["nuevoNoSerieCompra"],
                        "fecha" => $_POST["nuevaFechaCompra"],
                        "total" => $_POST["nuevoTotalCompra"],
                        "usuario" => $_SESSION["id"],
                        "comentario" => $_POST["nuevoComentarioCompra"]
                    );

                    $respuesta = ComprasModel::mdlInsertarCompra($tabla, $datos);

                    if($respuesta == "ok"){

                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Registro de compra con No. de factura ".$_POST["nuevoNoFacturaCompra"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "La compra ha sido insertada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "compras";
        
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

        public static function ctrEditarCompra(){

            if(isset($_POST["editarUuidCompra"])){

                if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["editarUuidCompra"]) ||
                   preg_match('/^[0-9]+$/', $_POST["editarNoFacturaCompra"]) || 
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarNoSerieCompra"]) ||
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ- ]+$/', $_POST["editarDescripcionCompra"]) ||
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ- ]+$/', $_POST["editarComentarioCompra"])){

                    $tabla = "compras";

                    $datos = array(
                        "descripcion" => $_POST["editarDescripcionCompra"],
                        "proveedor" => $_POST["editarProveedorCompra"],
                        "uuid" => $_POST["editarUuidCompra"],
                        "noSat" => $_POST["editarNoFacturaCompra"],
                        "serie" => $_POST["editarNoSerieCompra"],
                        "fecha" => $_POST["editarFechaCompra"],
                        "total" => $_POST["editarTotalCompra"],
                        "comentario" => $_POST["editarComentarioCompra"],
                        "idCompra" => $_POST["editarIdCompra"]
                    );

                    $respuesta = ComprasModel::mdlEditarCompra($tabla, $datos);

                    if($respuesta == "ok"){

                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Edicion de compra con No. de factura ".$_POST["editarNoFacturaCompra"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "La compra ha sido editada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "compras";
        
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

        static public function ctrActualizarCompras(){

            if(isset($_GET["idCompra"])){
    
                $tabla = "compras";
                $noFactura = $_GET["noFactura"];

                if($_GET["estatus"] == 1){
                    $estatus = 0;
                    $descripcion = "La factura No. ".$noFactura." se ha deshabilitado en la base de datos";
                }else{
                    $estatus = 1;
                    $descripcion = "El factura No. ".$noFactura." se ha habilitado en la base de datos";
                }

                $datos = array(
                    "idCompra" => $_GET["idCompra"],
                    "estatus" =>  $estatus
                );
    
                $respuesta = ComprasModel::mdlActualizarCompra($tabla, $datos);
    
                if($respuesta == "ok"){
    
                    $tablaHistorial = "historial";

                    $datosHistorial = array(
                        "descripcion" => $descripcion,
                        "usuario" => $_SESSION["id"]
                    );

                    $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                    if($respuestaHistorial == "ok"){

                        echo'<script>

                        swal.fire({
                            icon: "success",
                            title: "La compra ha sido modificado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "compras";
    
                                        }
                                    })
    
                        </script>';

                    }else{

                        echo '<script>alert('.$respuesta.')</script>';

                    }
                }else{

                    echo '<script>alert('.$respuesta.')</script>';

                }
            }
            
        }


    }