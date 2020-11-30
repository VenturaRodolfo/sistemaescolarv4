<?php
use Illuminate\Database\Capsule\Manager as Capsule;

require_once "data.php";


echo ("
        <title>Actualizar/editar</title>
    </head>
    <body>
");

if ($loggedin) {

    $access = Capsule::table('users')->select(['idaccess'])->where('idaccess', '=', 1)->first();
    //$access = Capsule::table('users')->count();
    $sql = Capsule::table('users')->select('nombre', 'iduser', 'idaccess')->where('idaccess', '=', 2)->get();
    $w = $sql; 
    //$sql = Capsule::table('users')->count();
    $idaccess= $access->idaccess;

    //$sql = queryMysql("SELECT * FROM users WHERE idaccess = '2'") or die(mysqli_error($connection));
    if ($idaccess == 1) {
        require_once "header.php";

    //while ($f = mysqli_fetch_array($sql)) 
    foreach($w as $actu){
    
        echo '
        <div class="columns is-mobile is-centered">
        <div class="column is-three-fifths is-offset-one-fifth">
       <br>
         <div class="card" style="width: 25rem;">
        <div class="card-body">
          <h5 class="card-title">Calificaciones de '. $actu->nombre . '</h5>
          <h6 class="card-subtitle mb-2 text-muted">Materias: </h6>
             <ol>
              <li>
                <p>Español:</p>
                </li>
            <form action="api/index.php/actu1" method="POST"> 
            <input type="int" class="form-control" name="cal_esp" placeholder="ingrese calificacion de español"> 
            <button type="button" class="btn btn-dark" name= "id" value="' . $actu->iduser .' "onclick="actu()">Enviar</button>
            
            </form>';

          echo'  <li>
                    <p>Matematicas:</p>
                </li>
                <form action="api/index.php/actu2" method="POST"> 
                <input type="int" class="form-control" name="cal_mate" placeholder="ingrese calificacion de matematicas"> 
                <button type="button" class="btn btn-dark" name= "id" value=" '. $actu->iduser .' "onclick="actu1()">Enviar</button>
            
                </form>';

          echo'  <li>
                <p>Historia:</p>
            </li>
            <form action="api/index.php/actu3" method="POST"> 
            <input type="int" class="form-control" name="cal_histo" placeholder="ingrese calificacion de historia"> 
            <button type="button" class="btn btn-dark" name= "id" value="' . $actu->iduser .' "onclick="actu2()">Enviar</button>
            

            </form>';


         echo' </ol>
        
            </div>  
         </div> 
         </div>
         </div> 
      </div>'; 
      
        }
    }
}
?>
<script>
function actu(){
    axios.post(`api/index.php/actu1/${document.forms[0].id.value}`, {
         id: document.forms[0].id.value,
        cal_esp: document.forms[0].cal_esp.value,
        })
        .then(resp =>{
                    if(resp.data.confir){
                alert(`Calificaciones de:  ${resp.data.name} Subidas`)
            }
            else
            {
                alert(`No se pudo subir:(`)
            }
        
        })
        .catch(error =>{
            console.log(error);
        });
}
</script>
<script>
        function actu1(){
axios.post(`api/index.php/actu2/${document.forms[1].id.value}`, {
     id: document.forms[1].id.value,
     cal_mate: document.forms[1].cal_mate.value,
  })
  .then(resp =>{
                    if(resp.data.confir){
                alert(`Calificaciones de:  ${resp.data.name} Subidas`)
            }
            else
            {
                alert(`No se pudo subir:(`)
            }
        
        })
        .catch(error =>{
            console.log(error);
        });
}

</script>

<script>
        function actu2(){
axios.post(`api/index.php/actu3/${document.forms[2].id.value}`, {
     id: document.forms[2].id.value,
     cal_histo: document.forms[2].cal_histo.value,
  })
  .then(resp =>{
                    if(resp.data.confir){
                alert(`Calificaciones de:  ${resp.data.name} Subidas`)
            }
            else
            {
                alert(`No se pudo subir:(`)
            }
        
        })
        .catch(error =>{
            console.log(error);
        });
}


</script>  