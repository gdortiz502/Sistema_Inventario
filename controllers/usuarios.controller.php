<?php

    class UsuariosController{

        public static function ctrIngresoUsuarios(){

            if(isset($_POST["ingUsuario"])){

                if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

                    $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    
                    $tabla = "usuarios";

                    $item = "usuario";

                    $valor = $_POST["ingUsuario"];

                    $respuesta = UsuariosModel::mdlMostrarUsuarios($tabla, $item, $valor);

                    if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

                        if($respuesta["estatus"] == 1){
    
                            $_SESSION["iniciarSesion"] = "ok";
                            $_SESSION["id"] = $respuesta["idUsuario"];
                            $_SESSION["nombre"] = $respuesta["nombre"];
                            $_SESSION["usuario"] = $respuesta["usuario"];
                            $_SESSION["password"] = $respuesta["password"];
                            $_SESSION["direccion"] = $respuesta["direccion"];
                            $_SESSION["telefono"] = $respuesta["telefono"];
                            $_SESSION["correo"] = $respuesta["correo"];
                            $_SESSION["perfil"] = $respuesta["nivel"];
                            $_SESSION["foto"] = $respuesta["imagen"];
    
                            echo '<script>
    
                                window.location = "inicio";
    
                            </script>';
			
                        }else{
    
                            echo '<br>
                                <div class="alert alert-danger">El usuario aún no está activado</div>';
    
                        }		
    
                    }else{
    
                        echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
    
                    }

                }

            }

        }

        public static function ctrMostrarUsuarios($item, $valor){

            $tabla = "usuarios";

            $respuesta = UsuariosModel::mdlMostrarUsuarios($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrMostrarNivelesUsuario($item, $valor){

            $tabla = "nivelusuarios";

            $respuesta = UsuariosModel::mdlMostrarUsuarios($tabla, $item, $valor);

            return $respuesta;

        }

        public static function ctrInsertarUsuario(){

            if(isset($_POST["nuevoCodigoUsuario"])){

                if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["nuevoCodigoUsuario"]) ||
                   preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreUsuario"]) ||
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuarioUsuario"]) || 
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPasswordUsuario"]) ||
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevaDireccionUsuario"]) ||
                   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoCorreoUsuario"])){

                    $tabla = "usuarios";

                    $ruta = "views/img/users/user_default.jpg";

                    if(isset($_FILES["nuevaImagenUsuario"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["nuevaImagenUsuario"]["tmp_name"]);

                        $nuevoAncho = 500;
                        $nuevoAlto = 500;

                        /*=============================================
                        CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                        =============================================*/

                        $directorio = "views/img/users/".$_POST["nuevoCodigoUsuario"];

                        mkdir($directorio, 0755);

                        /*=============================================
                        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                        =============================================*/

                        if($_FILES["nuevaImagenUsuario"]["type"] == "image/jpeg"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/users/".$_POST["nuevoCodigoUsuario"]."/".$aleatorio.".jpg";

                            $origen = imagecreatefromjpeg($_FILES["nuevaImagenUsuario"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $ruta);

                        }

                        if($_FILES["nuevaImagenUsuario"]["type"] == "image/png"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/users/".$_POST["nuevoCodigoUsuario"]."/".$aleatorio.".png";

                            $origen = imagecreatefrompng($_FILES["nuevaImagenUsuario"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $ruta);

                        }

                    }
    
                    $encriptar = crypt($_POST["nuevoPasswordUsuario"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $datos = array(
                        "codigo" => $_POST["nuevoCodigoUsuario"],
                        "nombre" => $_POST["nuevoNombreUsuario"],
                        "usuario" => $_POST["nuevoUsuarioUsuario"],
                        "password" => $encriptar,
                        "direccion" => $_POST["nuevaDireccionUsuario"],
                        "telefono" => $_POST["nuevoTelefonoUsuario"],
                        "correo" => $_POST["nuevoCorreoUsuario"],
                        "nivel" => $_POST["nuevoNivelUsuario"],
                        "imagen" => $ruta
                    );
    
                    $respuesta = UsuariosModel::mdlInsertarUsuario($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Inserción del usuario ".$_POST["nuevoNombreUsuario"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El usuario ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "usuarios";
        
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
    
                                window.location = "productos";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        public static function ctrEditarUsuario(){

            if(isset($_POST["editarIdUsuario"])){

                if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreUsuario"]) ||
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarDireccionUsuario"]) ||
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarCorreoUsuario"])){

                    $tabla = "usuarios";

                    $ruta = $_POST["editarImagenActualUsuario"];

                    if(isset($_FILES["editarImagenUsuario"]["tmp_name"]) && !empty($_FILES["editarImagenUsuario"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["editarImagenUsuario"]["tmp_name"]);

                        $nuevoAncho = 500;
                        $nuevoAlto = 500;

                        /*=============================================
                        CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                        =============================================*/

                        $directorio = "views/img/users/".$_POST["editarCodigoUsuario"];

                        
                        
                        /*=============================================
                        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                        =============================================*/

                        if($_FILES["editarImagenUsuario"]["type"] == "image/jpeg"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/users/".$_POST["editarCodigoUsuario"]."/".$aleatorio.".jpg";

                            $origen = imagecreatefromjpeg($_FILES["editarImagenUsuario"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $ruta);

                        }

                        if($_FILES["editarImagenUsuario"]["type"] == "image/png"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/users/".$_POST["editarCodigoUsuario"]."/".$aleatorio.".png";

                            $origen = imagecreatefrompng($_FILES["editarImagenUsuario"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $ruta);

                        }

                    }

                    $password = $_POST["passwordActual"];

                    if(isset($_POST["editarPasswordUsuario"]) && $_POST["editarPasswordUsuario"] != ""){

                        $password = crypt($_POST["editarPasswordUsuario"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    }
    
                    $datos = array(
                        "idUsuario" => $_POST["editarIdUsuario"],
                        "nombre" => $_POST["editarNombreUsuario"],
                        "password" => $password,
                        "telefono" => $_POST["editarTelefonoUsuario"],
                        "correo" => $_POST["editarCorreoUsuario"],
                        "direccion" => $_POST["editarDireccionUsuario"],
                        "nivel" => $_POST["editarNivelUsuario"],
                        "imagen" => $ruta
                    );
    
                    $respuesta = UsuariosModel::mdlEditarUsuario($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Edición del usuario ".$_POST["editarNombreUsuario"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El usuario ha sido editado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "usuarios";
        
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
    
                                window.location = "usuarios";
    
                                }
                            })
    
                      </script>';
    
                }

            }

        }

        public static function ctrModificarUsuario(){
            if(isset($_POST["editarIdUsuario"])){

                if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreUsuario"]) ||
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarDireccionUsuario"]) ||
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarCorreoUsuario"])){

                    $tabla = "usuarios";

                    $ruta = $_POST["editarImagenActualUsuario"];

                    if(isset($_FILES["editarImagenUsuario"]["tmp_name"]) && !empty($_FILES["editarImagenUsuario"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["editarImagenUsuario"]["tmp_name"]);

                        $nuevoAncho = 500;
                        $nuevoAlto = 500;

                        
                        
                        /*=============================================
                        DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                        =============================================*/

                        if($_FILES["editarImagenUsuario"]["type"] == "image/jpeg"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/users/".$_POST["editarCodigoUsuario"]."/".$aleatorio.".jpg";

                            $origen = imagecreatefromjpeg($_FILES["editarImagenUsuario"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $ruta);

                        }

                        if($_FILES["editarImagenUsuario"]["type"] == "image/png"){

                            /*=============================================
                            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            =============================================*/

                            $aleatorio = mt_rand(100,999);

                            $ruta = "views/img/users/".$_POST["editarCodigoUsuario"]."/".$aleatorio.".png";

                            $origen = imagecreatefrompng($_FILES["editarImagenUsuario"]["tmp_name"]);						

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $ruta);

                        }

                    }

                    $password = $_POST["passwordActual"];

                    if(isset($_POST["editarPasswordUsuario"]) && $_POST["editarPasswordUsuario"] != ""){

                        $password = crypt($_POST["editarPasswordUsuario"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    }
    
                    $datos = array(
                        "idUsuario" => $_POST["editarIdUsuario"],
                        "nombre" => $_POST["editarNombreUsuario"],
                        "password" => $password,
                        "telefono" => $_POST["editarTelefonoUsuario"],
                        "correo" => $_POST["editarCorreoUsuario"],
                        "direccion" => $_POST["editarDireccionUsuario"],
                        "nivel" => $_POST["editarNivelUsuario"],
                        "imagen" => $ruta
                    );
    
                    $respuesta = UsuariosModel::mdlEditarUsuario($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        $tablaHistorial = "historial";

                        $datosHistorial = array(
                            "descripcion" => "Edición del usuario ".$_POST["editarNombreUsuario"],
                            "usuario" => $_SESSION["id"]
                        );

                        $respuestaHistorial = HistorialModel::mdlInsertarHistorial($tablaHistorial, $datosHistorial);

                        if($respuestaHistorial == "ok"){

                            echo'<script>
    
                            swal.fire({
                                icon: "success",
                                title: "El usuario ha sido editado correctamente, vuelva a iniciar sesion para aplicar los cambios.",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                            if (result.value) {
        
                                            window.location = "perfil";
        
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
    
                                window.location = "usuarios";
    
                                }
                            })
    
                      </script>';
    
                }

            }
        }

        static public function ctrActualizarUsuario(){

            if(isset($_GET["idUsuario"])){
    
                $tabla ="usuarios";
                $usuario = $_GET["nombre"];

                if($_GET["estatus"] == 1){
                    $estatus = 0;
                    $descripcion = "El usuario ".$usuario." se ha deshabilitado en la base de datos";
                }else{
                    $estatus = 1;
                    $descripcion = "El usuario ".$usuario." se ha habilitado en la base de datos";
                }

                $datos = array(
                    "idUsuario" => $_GET["idUsuario"],
                    "estatus" =>  $estatus
                );
    
                $respuesta = UsuariosModel::mdlActualizarUsuario($tabla, $datos);
    
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
                            title: "El usuario ha sido modificado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                        if (result.value) {
    
                                        window.location = "usuarios";
    
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