<?php
/* Auto load Includes Classes */ 
spl_autoload_register(function ($class) {
    include CLASS_DIR . $class . '.class.php';
});

/* Start session */
Session::start( new SessionStorage );

/* DataBase Config init */
DB::init();

/* PDO Instance of database */
$PDO_CONN = DB::PDOInstance();

/* Classes inits */
$db			= new database( $PDO_CONN ); //ainda vou te excluir
$Storage 	= new PDOStorage( $PDO_CONN );
$FileCart	= new Cart( 'FileCart' );
$DataUtils 	= new DataUtils;
$utils 		= new utils;
$usuarios	= new usuarios( $Storage );	
$arquivos 	= new arquivos( $Storage );
$GroupDAO   = new GroupDAO( $Storage );
$UserDAO	= new UsuarioDAO( $Storage );