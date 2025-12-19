<?php
	
	require_once "autoload.php" ;
	
	use Clases\Sesion;
	use Clases\Request ;
	use Clases\Auth ;
	
	#echo "<pre>".print_r($_SESSION,true)."</pre>";
	
	#index.php?metodo=list&modelo=usuario
	
	$modelo = $_GET["modelo"]??"auth" ;
	$metodo = $_GET["metodo"]??"index" ;
	
	# comprobamos si el usuario se ha logueado
	if (Sesion::active()):
		Sesion::update() ;
		if (($modelo=="auth") and ($metodo=="index")):
			Request::redirectToRoute("main") ;
		endif ;
	else:
		if ($modelo!="auth"):
			Auth::logout() ;
			Request::redirect("/");
		endif ;
	endif ;
	
	# Contruimos el nombre del controlador a partir del modelo
	$nombreControlador = ucfirst("{$modelo}Controller") ;
	
	# Importamos la clase
	#require_once "controladores/{$nombreControlador}.php" ;
	
	# Construimos el nombre de la clase
	$nombreClase = "Controladores\\{$nombreControlador}" ;
	
	# Instanciamos la clase
	$controlador = new $nombreClase ;
	
	# Invocamos el método solicitado
	$controlador->$metodo() ;
	