<?php

    class ProveedoresController{

        public static function ctrMostrarProveedores($item, $valor){

            $tabla = "proveedores";

            $respuesta = ProveedoresModel::mdlMostrarProveedores($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrInsertarProveedores(){

            if(isset($_POST["nuevoCodigoProveedor"])){

                if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["nuevoCodigoProveedor"]) ||
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoNitProveedor"]) ||
                   preg_match('/^[a-zA-ZáéíúóÁÉÍÓÚ ]+$/', $_POST["nuevoNombreProveedor"]) ||
                   preg_match('/^[0-9]+$/', $_POST["nuevoTelefonoProveedor"]) ||
                   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoCorreoProveedor"]) ||
                   preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ0-9 ]+$/', $_POST["nuevaDireccionProveedor"])){

                    $tabla = "proveedores";
    
                    $datos = array(
                        "codigo" => $_POST["nuevoCodigoProveedor"],
                        "nit" => $_POST["nuevoNitProveedor"],
                        "nombre" => $_POST["nuevoNombreProveedor"],
                        "telefono" => $_POST["nuevoTelefonoProveedor"],
                        "correo" => $_POST["nuevoCorreoProveedor"],
                        "direccion" => $_POST["nuevaDireccionProveedor"]
                    );
    
                    $respuesta = ProveedoresModel::mdlInsertarProveedores($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Inserción del cliente ".$_POST["nuevoNombreProveedor"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El proveedor ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "proveedores";
        
                                            }
                                        })
        
                            </script>';

                        }else{

                            var_dump($respuestaHistorial);

                        }
    
                    }else{
                        var_dump($respuesta);
                    }
    
    
                }else{
    
                    echo'<script>
    
                        swal.fire({
                              icon: "error",
                              title: "¡El código no puede ir vacía o llevar caracteres especiales!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
    
                                window.location = "proveedores";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        public static function ctrEditarProveedores(){

            if(isset($_POST["editarIdProveedor"])){

                if(preg_match('/^[a-zA-ZáéíúóÁÉÍÓÚ ]+$/', $_POST["editarNombreProveedor"]) ||
                   preg_match('/^[0-9]+$/', $_POST["editarTelefonoProveedor"]) ||
                   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarCorreoProveedor"]) ||
                   preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚ0-9 ]+$/', $_POST["editarDireccionProveedor"])){

                    $tabla = "proveedores";
    
                    $datos = array(
                        "idProveedor" => $_POST["editarIdProveedor"],
                        "nombre" => $_POST["editarNombreProveedor"],
                        "telefono" => $_POST["editarTelefonoProveedor"],
                        "correo" => $_POST["editarCorreoProveedor"],
                        "direccion" => $_POST["editarDireccionProveedor"]
                    );
    
                    $respuesta = ProveedoresModel::mdlEditarProveedores($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Edición del cliente ".$_POST["editarNombreProveedor"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El proveedor ha sido editado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "proveedores";
        
                                            }
                                        })
        
                            </script>';

                        }else{

                            var_dump($respuestaHistorial);

                        }
    
                    }else{
                        var_dump($respuesta);
                    }
    
    
                }else{
    
                    echo'<script>
    
                        swal.fire({
                              icon: "error",
                              title: "¡El código no puede ir vacía o llevar caracteres especiales!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
    
                                window.location = "proveedores";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        static public function ctrActualizarProveedores(){

            if(isset($_GET["idProveedor"])){
    
                $tabla ="proveedores";
                $proveedor = $_GET["nombre"];

                if($_GET["estatus"] == 1){
                    $estatus = 0;
                    $descripcion = "El proveedor ".$proveedor." se ha deshabilitado en la base de datos";
                }else{
                    $estatus = 1;
                    $descripcion = "El proveedor ".$proveedor." se ha habilitado en la base de datos";
                }

                $datos = array(
                    "idProveedor" => $_GET["idProveedor"],
                    "estatus" =>  $estatus
                );
    
                $respuesta = ProveedoresModel::mdlActualizarProveedores($tabla, $datos);
    
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
                            title: "El proveedor ha sido modificado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "proveedores";
    
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