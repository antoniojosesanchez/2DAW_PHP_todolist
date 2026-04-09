<?php

	/**
	 * @author Antonio José Sánchez Bujaldón
	 * @since 2026
	 */

	error_reporting(E_ALL & ~E_WARNING) ;
	
	session_start() ;
    spl_autoload_extensions(".php") ;
    spl_autoload_register() ;
