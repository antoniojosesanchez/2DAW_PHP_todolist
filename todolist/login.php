<?php

    require_once "autoload.php" ;

    use Clases\Request;
    use todolist\clases\Auth;

    #if (Sesion::active()) Request::redirect("main.php") ;

    if (!empty($_POST)):

        $email = $_POST["email"]??null ;
        $pass = $_POST["password"]??null ;

        if (($email != null) and ($pass != null)):
            if (Auth::login($email, $pass)):
                Request::redirect("main.php") ;
            else:
                $mensaje = "El email o la contraseña son incorrectos." ;
            endif;
        else:
            $mensaje = "El email y la contraseña son obligatorios." ;
        endif ;

    endif ;

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Bases de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <div class="card p-4 mt-4 shadow" style="width:32rem; margin:auto">
            <h1 class="card-title text-center">📋 Todo List</h1>
            <div class="card-body">
               <form method="post">
                   <input class="form-control" type="email" name="email"
                          value="david@email.com"
                          placeholder="email@email.com" autofocus required /><br/>

                   <input class="form-control" type="password" name="password"
                          placeholder="Introduce tu contraseña" required /><br/>

                   <?php if(isset($mensaje)): ?>
                       <div class="alert alert-danger"><?= $mensaje ?></div>
                   <?php endif ; ?>

                   <button class="btn btn-primary w-100">Entrar</button>
               </form>
            </div>
        </div>
    </div>
</body>
</html>
