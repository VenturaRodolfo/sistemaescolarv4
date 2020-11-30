<?php
echo <<<_INIT
<!DOCTYPE html> 
<html is-clipped>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'> 
    
    <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel='stylesheet' href='styles.css' type='text/css'>

    <script src="js/jquery-3.4.1.js" ></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script src="node_modules/axios/dist/axios.min.js"></script>>
_INIT;

  require_once 'functions.php';

  $userstr = 'Bienvenido usuario: ';

  if (isset($_SESSION['user']))
  {
    $nombre     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = "Registrado como: $nombre";
  }
  else $loggedin = FALSE;

echo <<<_MAIN
    <title>Escuela: $userstr</title>
  </head>
  <body>
    <div data-role='page'>
      <div data-role='header'>
        <div id='logo' class='center'>Escuela</div>
        <div class='username'>$userstr</div>
      </div>
      <div data-role='content'>

_MAIN;

  if ($loggedin)
  {
echo <<<_LOGGEDIN
        <div class='center'>
          <a class='button is-link' href='index.php?view=$userstr'>Home</a>   
            
          

          <a  class='button is-link' href='logout.php'>Log out</a>
        </div>
_LOGGEDIN;

  }
?>
