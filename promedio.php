<?php
   use Illuminate\Database\Capsule\Manager as Capsule;
   require_once 'data.php';
   require_once 'header.php';
   $f[] = $user->nombre;//0
   $f[] = $user->iduser;//1
   $f[] = $user->apellido;//2
   $f[] = $user->idaccess;//6

echo '<br>';
   $user = Capsule::table('materias')->where('users_iduser', '=', $f[1])->first();
   $español = $user->español; 
   $mate = $user->matematicas;
   $historia = $user->historia;
     $prom = $español + $mate + $historia;
      $prom = $prom/3;
 echo'  <center> <div class="card" style="width: 25rem;">
   <div class="card-content">
     <h2>Promedio general de '. $f[0]. '</h2>
     <h6 class="mb-2">promedio:'.$prom .'</h6>';

 echo "<h3> Español: ..." . $español = $user->español ."</h3>";
 echo  "<h3> Matematicas: ..." . $mate = $user->matematicas."</h3>";
  echo "<h3> Historia: ..."  . $historia = $user->historia."</h3>";
  
   echo "<h3> Promedio General: ". $prom."</h3>";
echo "</div>";
echo "</div>";
echo "</div>";
   if ($prom == 10){
        echo "<center><h1>Felicidades!</h1></center>";
        echo '<br>';
        echo '<br>';
   }
   if ($prom == 9){
        echo "<center><h1>Excelente!</h1></center>";
        echo '<br>';
        echo '<br>';
    }
    if ($prom == 8){
        echo "<center><h1>Sigue esforzandote!</h1></center>";
        echo '<br>';
        echo '<br>';
    }
    if ($prom == 7){
        echo "<center><h1>Puedes lograr mucho mas!</h1></center>";
        echo '<br>';
        echo '<br>';
    }
    if ($prom == 6){
        echo "<center><h1>Puedes mejorar mucho mas!</h1></center>";
        echo '<br>';
        echo '<br>';
    }
    if ($prom == 5){
        echo "<center><h1>Saldras mejor la proxima vez!</h1></center>";
        echo '<br>';
        echo '<br>';
    }
    if ($prom == 0){
        echo "<center><h1>Ninguna Calificación ingresada.</h1></center>";
        echo "<center><h1>Sin promedio.</h1></center>";

        echo '<br>';
        echo '<br>';
    }
?>