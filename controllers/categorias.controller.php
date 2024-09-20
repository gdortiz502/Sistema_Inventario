<?php

    class CategoriasController{

        public static function ctrMostrarCategorias($item, $valor){

            $tabla = "categorias";

            $respuesta = CategoriasModel::mdlMostrarCategorias($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrInsertarCategoria(){

            if(isset($_POST["nuevaDescripcionCategoria"])){

                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcionCategoria"])){

                    $tabla = "categorias";
    
                    $datos = $_POST["nuevaDescripcionCategoria"];
    
                    $respuesta = CategoriasModel::mdlInsertarCategoria($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Inserción de la categoría ".$_POST["nuevaDescripcionCategoria"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "La categoría ha sido guardada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "categorias";
        
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
                              title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
    
                                window.location = "categorias";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        public static function ctrEditarCategoria(){

            if(isset($_POST["editarDescripcionCategoria"])){

                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionCategoria"])){

                    $tabla = "categorias";
    
                    $datos = array(
                        "idCategoria" => $_POST["editarIdCategoria"],
                        "descripcion" => $_POST["editarDescripcionCategoria"]
                    );
    
                    $respuesta = CategoriasModel::mdlEditarCategoria($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Edición de la categoría ".$_POST["editarDescripcionCategoria"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "La categoría ha sido editada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "categorias";
        
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
                              title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
    
                                window.location = "categorias";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        static public function ctrActualizarCategoria(){

            if(isset($_GET["idCategoria"])){
    
                $tabla ="categorias";
                $categoria = $_GET["categoria"];

                if($_GET["estatus"] == 1){
                    $estatus = 0;
                    $descripcion = "La categoria ".$categoria;
                }else{
                    $estatus = 1;
                    $descripcion = "La categoria ".$categoria;
                }

                $datos = array(
                    "idCategoria" => $_GET["idCategoria"],
                    "estatus" =>  $estatus
                );
    
                $respuesta = CategoriasModel::mdlActualizarCategoria($tabla, $datos);
    
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
                            title: "La categoría ha sido modificada correctamente correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "categorias";
    
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