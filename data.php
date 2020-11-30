<?php
@ob_start();
session_start();
use Illuminate\Database\Capsule\Manager as Capsule;
require_once 'functions.php';
require "vendor/autoload.php";
require "config/database.php";  
if (isset($_SESSION['user'])) {
    $users    = $_SESSION['user'];
    $user = Capsule::table('users')->where('nombre', '=', $users)->first();
    $loggedin = TRUE;
    //echo $user->nombre;

    //return false;
//$sql = queryMysql("SELECT * FROM users WHERE nombre='$user'");

   // $f = mysqli_fetch_array($sql);
    $name = $user->nombre;
    $apellido= $user->apellido;
    $daccess = $user->idaccess;

} else $loggedin = FALSE;

//Comprobamos si esta definida la sesión 'tiempo'.
if (isset($_SESSION['tiempo'])) {

    //Tiempo en segundos para dar vida a la sesión.
    $innactive = 1200; //20 min.

    //Calculamos tiempo de vida inactivo.
    $lifeTime = time() - $_SESSION['tiempo'];

    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if ($lifeTime > $innactive) {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();
        //Redirigimos pagina.
        header("Location: login.php");

        exit();
    }
} else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}
 
?>

