<?php 
use Illuminate\Database\Capsule\Manager as Capsule;
require "vendor/autoload.php";
require "config/database.php";  

  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

/*function sanitizeString($var)
  {
    //global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc()) 
      $var = stripslashes($var);
    //return real_escape_string($var);
  }
*/
?>
