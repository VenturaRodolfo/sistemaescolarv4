
<?php
use Illuminate\Database\Capsule\Manager as Capsule;
require_once 'data.php';
echo ("
        <title>Borrar</title>
    </head>
    <body>
");



if ($loggedin) {
  
  $access = Capsule::table('users')->select(['idaccess'])->where('idaccess', '=', 1)->first();
  $sql = Capsule::table('users')->select(['idaccess'])->where('idaccess', '=', 2)->first();
  $Al = Capsule::table('users')->select('nombre', 'apellido', 'iduser', 'idaccess')->where('idaccess', '=', 2)->get();
  

    $J = $Al; 
  $idaccess= $access->idaccess;

    //$sql = queryMysql("SELECT * FROM users WHERE idaccess = '2'") or die(mysqli_error($connection));
    if ($idaccess == 1) {
        require_once 'header.php';
        $colnum = $sql->idaccess;
        if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        Capsule::table('materias')->where('users_iduser', $id)
        ->update(['español' => 0]);
        Capsule::table('materias')->where('users_iduser', $id)
        ->update(['matematicas' => 0 ]);
        Capsule::table('materias')->where('users_iduser', $id)
        ->update(['historia' => 0]);
        

        //queryMysql("UPDATE users 
        //SET español = '0', matematicas = '0', historia= '0'  
        //WHERE iduser = '$id'");
        
        die('<h1 text-align:center;">Calificaciones del alumno borradas </h1>
            <meta http-equiv="Refresh" content="3;url=index.php">
            </div></body></html>');
        }

    echo '
        <div class="container-fluid">
        <div class="row" style="padding: 1em;">
            <div class="col-12 col-md-4 offset-md-4 mt-5">
            ';

    if ($colnum == 0) {
        echo '<h1 style="text-align:center;">No hay alumnos</h1>';
    }

    //while ($J) {
    foreach($J as $borrarAl)
    {
    //echo $borrarAl->iduser;
     echo '
    <br>
    <font size="5" class="fonttxt">'. $borrarAl->apellido . " " . $borrarAl->nombre . '</font>  <a type="button" style="float:right; color: white;" data-toggle="modal" data-target="#modalEdicion' . $borrarAl->iduser . '" class="button is-primary">Delete</a>

    
    <br>
    <br
<!-- Modal -->

<div class="modal" id="modalEdicion' . $borrarAl->iduser . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div onclick="refs.modalEdicion.close()" class="modal-background"></div>
        <button type="button"  data-dismiss="modal" class="delete is-large">
        <span aria-hidden="true">&times;</span>
        </button>  
        <div class="modal-content">
            <h5 class="modal-title"id="exampleModalLabel">Está seguro de eliminar las calificaciones de ' . $borrarAl->nombre . '?</h5>          
            <div class="modal-body">
            <h4 class="error">¿Seguro que desea borrar todas la calificaciones de este alumno? <br> recuerde que esto sera permanente y tendra que volver a ingresar las calificaciones</h4>
        </div>
        <div class="modal-footer">
        
           
            <a type="button" style="float:right;"  href="borrar.php? id=' . $borrarAl->iduser .'&del=español" class="button is-primary linkdel">Delete</a>
            </div>
        </div>
    </div>
                ';
    }
    //mysqli_free_result($sql);
    echo '
            </div>
            </div>
            <br>
            <br>
        </div>

    </body>
    ';
    }
    else {
        echo "
        <meta http-equiv='Refresh' content='0;url=login.php'>
        </body>
        </html>
        ";
    }
}
else {
    echo "
    <meta http-equiv='Refresh' content='0;url=login.php'>
    </body>
    </html>
    ";
}

//mysqli_close($connection);
?>
<script>





</script>