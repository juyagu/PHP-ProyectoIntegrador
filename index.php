<?php
require_once("conf.inc.php");

if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['accion'] == 'registro'){
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $pass = md5($_POST['pwd']);
        $existe = "";
        $query = $db->prepare("select nombre from usuarios where email = ?");
        $query->execute(array($email));
        $existe = $query->fetch(PDO::FETCH_ASSOC);
        if($existe){
           header("Location: views/mensaje.php?mensaje=El usuario ya se encuentra registrado"); 
        } else {
            $queryRegistro = $db->prepare("insert into usuarios (email,nombre,apellido,pass) values (:email,:nombre,:apellido,:pwd)");
            $insert = $queryRegistro->execute(array(":email"=>$email,":nombre"=>$nombre,":apellido"=>$apellido,":pwd" =>$pass));
            if($insert){
                header("Location: views/mensaje.php?mensaje=Solicitud exitosa.Registro pendiente de aprobacion."); 
            }
        }
    }
    
    if($_POST['accion'] == 'ingresar'){
        $email = $_POST['email_ingreso'];
        $pwd = md5($_POST['password_ingreso']);
        $query = $db->prepare("select  u.email,u.nombre,u.apellido,u.habilitado,p.detalle perfil from usuarios u"
                . " join perfiles p"
                . " on u.perfil = p.id_perfil "
                . " where email = ?"
                . " and pass = ?");
        $query->execute(array($email,$pwd));
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        if(!$usuario){
            header("Location: views/mensaje.php?mensaje=El usuario no se encuentra registrado"); 
        }
        else if($usuario && $usuario['habilitado'] == 0){
            header("Location: views/mensaje.php?mensaje=El usuario no se encuentra habilitado"); 
        } else if ($usuario && $usuario['habilitado'] == 1){
            $_SESSION['login'] = true;
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['apellido'] = $usuario['apellido'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['perfil'] = $usuario['perfil'];
            header("Location: views/welcome.php"); 
        }
    }
    
    
}
?>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Proyecto Integrador</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon">
    </head>
    <body>

        <div class="container-fluid main">
            <div id="top"><img src="imagenes/top.png" alt="encabezado" width="980" height="80"></div>

            <div class="container">    
                <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                    <div class="panel panel-info" >
                        <div class="panel-heading">
                            <div class="panel-title">Login</div>
                            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Olvido su contraseña?</a></div>
                        </div>     
                        <div style="padding-top:30px" class="panel-body" >
                            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <form id="loginform" class="form-horizontal" role="form" method="post">
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="login-username" type="text" class="form-control" name="email_ingreso" value="" placeholder="email">                                        
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="login-password" type="password" class="form-control" name="password_ingreso" placeholder="contraseña">
                                </div>
                                <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                            <input id="login-remember" type="checkbox" name="remember" value="1"> Recuérdame
                                        </label>
                                    </div>
                                </div> 
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                        <button id="btn-login" type="submit" class="btn btn-success">Login  </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            No estas registrado? 
                                            <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                                Registrate aca!
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="accion" value="ingresar" />
                            </form>     
                        </div>                     
                    </div>  
                </div>
                <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Registro</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Ingresar</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" method="post">
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Apellido</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="apellido" placeholder="Apellido">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="pwd" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 col-md-offset-9">
                                        <button class="btn btn-success">Registrarme</button>
                                    </div>
                                </div>
                                <input type="hidden" value="registro" id="input_registro" name="accion" />
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div id="pie">
            <?php require_once(ROOT_PATH . '/proyecto/views/pie.php') ?>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="j../s/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

    </body>
</html>
