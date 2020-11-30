<?php // Example 26-4: index.php
   use Illuminate\Database\Capsule\Manager as Capsule;
  require_once 'data.php';
  require_once 'header.php';

  echo "<div class='center'>";
  if(!$loggedin){
if(isset($_GET['user']))
{
  $usuario = $_GET['user'];
  $_SESSION['user'] = $usuario;
}
  }

  if ($loggedin)
  {          
    
 $sql = Capsule::table('users')->select('nombre', 'iduser', 'idaccess')->where('idaccess', '=', 2)->get();
$e = $sql;
    $f[] = $user->nombre;//0
    $f[] = $user->iduser;//1
    $f[] = $user->apellido;//2
    $f[] = $user->idaccess;//6

    
   // print_r($e);
    $access = Capsule::table('users')->where('idaccess', '=' , 2)->first();
    $access = Capsule::table('users')->where('nombre', '=' , $nombre)->first(); 
   // $sql = queryMysql("SELECT * FROM users WHERE idaccess = '2'") or die(mysqli_error($connection));

    $idaccess= $access->idaccess;
 
    if($idaccess == 1 )
    {
      echo " $nombre, Usted esta logueado como Maestro <br>";
      echo "Opciones de maestro: <br>";

      echo   "<a class='button is-success' href='actualizar.php'>actualizar calificaciones</a>";

      echo "<br><br>";
      
      echo   "<a  class='button is-danger' href='borrar.php'>borrar calificaciones</a> <br>"; 

      echo "El siguiente formulario es para que ingreses las calficaciones de los alumnos: "; 

      echo '<center><div class="card" style="width: 40rem;">
      
      <div class="card-content">
      <form action="api/index.php/cal" method= "post">
      <br>
      <p>seleccione nombre del alumno al que desea cambiar la calificación</p>
      <div class="control">
      <div class="select">
      <select value="alumno" name="alumno" >';
        foreach($e as $name){
          echo "<option value=" . $name->iduser.">". $name->nombre . "</option>"; 
         }
      echo '</select>
  </div>
</div>
      <p>Calificacion de español: </p>
      <input type="int" class="form-control" name="cal_esp" placeholder="ingrese calificacion de español"> 

      <p>Calificacion de  matematicas: </p>
      <input type="int" class="form-control"  name="cal_mate" placeholder="ingrese calificacion de matematicas">

      <p>Calificacion de historia: </p>
      <input type="int" class="form-control" name="cal_histo" placeholder="ingrese calificacion de historia ">
      <br>
      <input class="button is-primary" type="button"  value="enviar" onclick="cal()">
    </form>
  </div>
</div> </center>';
/*  error_reporting(E_ALL ^ E_NOTICE,);
//$calEspa  = 0;
//$calMate  = 0;
//$calHisto = 0;
$calEspa = $_GET["cal_esp"];
$calMate = $_GET["cal_mate"];
$calHisto = $_GET["cal_histo"];
$alumno = $_GET["alumno"];
echo "<br>";

/*$confirmar = Capsule::table('materias')->where('users_iduser',$alumno)->first();

if(!$confirmar)
{
     //Capsule::table('materias')->insertOrIgnore(['users_iduser' => $alumno, 'español' => $calEspa, 'matematicas' => $calMate, 'historia' => $calHisto]);
    Capsule::table('materias')->insert(['users_iduser' => $alumno, 'español' => $calEspa, 'matematicas' => $calMate, 'historia' => $calHisto]);

}
else
{
echo '<h1>Ya tiene calificación<./h1>';
}*/
  /*if (!empty($_GET['alumno'])) {
  $id = $_GET['alumno'];  
  //$id = $alumno; 
  //echo  $id;
  Capsule::table('materias')->where('users_iduser', $id)
  ->update(['español' => $calEspa]);
  Capsule::table('materias')->where('users_iduser', $id)
  ->update(['matematicas' => $calMate]);
  Capsule::table('materias')->where('users_iduser', $id)
  ->update(['historia' => $calHisto]);
  echo "<h1>Subida exitosa!</h1>"; 
 /* queryMysql("UPDATE users 
  SET español = '$calEspa', matematicas = '$calMate', historia= '$calHisto'  
  WHERE iduser = '$id' ");
  }*/


    }
    else{
      $mate = Capsule::table('materias')->where('users_iduser', '=', $f[1])->first();
      $j[] = $mate->español;//3
      $j[] = $mate->matematicas;//4
      $j[] = $mate->historia;//5
      echo " $nombre, Usted esta logueado como alumno <br>";
      echo '<h1>Tus calificaciones: </h1>';
      echo '<br> <center> <div class="card" style="width: 25rem;">
      <div class="card-content">
        <h5 class="card-title">Calificaciones de '. $f[0] . '</h5>
        <h6 class="card-subtitle mb-2">Materias: </h6>

             <p>1.-Español:.........'.$j[0].'</p>

          <p>2.-Matematicas:..' . $j[1] . '</p>

           <p>3.-historia:.........' . $j[2]. '</p>';
   echo   "<a  class='button is-danger' href='promedio.php'>Promedio</a> <br>"; 

    }
  }   
  else{
    echo ' please sign up or log in <br>';
    echo"<a data-role='button' data-inline='true' data-icon='user'
    data-transition='slide' href='signup.php'>registrarse</a>";
    echo  "<br>";
    echo"<a data-role='button' data-inline='true' data-icon='user'
    data-transition='slide' href='login.php'>Iniciar sesion</a>";
    echo'
    <meta http-equiv="Refresh" content="0;url=login.php">
    </div></body></html>
    ';


      }           

  echo <<<_END
      </div><br>
    </div>
    <div data-role="footer">
    </div>
  </body>
</html>
_END;
?>
<script>
function cal(){
    axios.post( `api/index.php/cal/${document.forms[0].alumno.value}`, {
     alumno: document.forms[0].alumno.value,
     cal_esp: document.forms[0].cal_esp.value,
     cal_mate: document.forms[0].cal_mate.value,
     cal_histo: document.forms[0].cal_histo.value,
  }).then(resp =>{
    if (resp.data.existe)
    {
      alert(`Calificaciones del alumno subidas:  ${resp.data.name}`)


    }
    else
    {
      alert(`Ya existen las calificaciones del alumno:  ${resp.data.name}`)

    }

  })
  .catch(error =>{
    console.log(error);
  });


}

</script>