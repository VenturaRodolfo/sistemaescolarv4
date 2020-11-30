<?php
    use Illuminate\Database\Capsule\Manager as Capsule;

    require_once 'data.php';
    require_once "header.php";
  
    $error = $nombre = $pass = "";
    echo'

    <title>Login</title>

</head>

<body>
    <!-- project start -->
    <div class="container-fluid">
    ';
   /**$user = Capsule::table('users')->select(['nombre'])->get();
    $passw = Capsule::table('users')->select(['contra'])->get();
    foreach ($user as $u) {
        echo $u->$user;
        echo $u->$passw;
            }*/
if(!$loggedin)
{

   /* if (isset($_POST['user']))
    {
        $nombre =  ($_POST['user']);
        $pass = ($_POST['pass']);

        if($nombre == "" || $pass == "")
            $error = 'Not all fields were entered';
        else
        {    
           
            $user = Capsule::table('users')->select(['nombre', 'contra'])->where('nombre', $nombre)->where('contra', $pass)->first();
            //$user = Capsule::table('users')->count();
          //$result = queryMySQL("SELECT nombre, contra from users WHERE nombre = '$nombre' AND contra = '$pass'");
                    
            if (!$user)
            {
                //echo $nombre;
                //echo $pass;
                $error = "Invalid account or password";
            }
            else
            {

                $_SESSION['user'] = $nombre;
                $_SESSION['pass'] = $pass;
                die("
                <div class='check'>
                    <meta http-equiv='Refresh' content='3;url=index.php'>
                    <h1>You have successfully logged in. You will be redirected in a few seconds.<h1>
                    <h1>Otherwise <a href='index.php' class='link'>click here</a></h1>
                </div>
                </div></body></html>");
            }
          //mysqli_free_result($user);
        }
    }*/

    echo <<<_END
    <div class="row">
    <div class="col-10 offset 1 col-md-10 offset-md-1 mt-2 login shadow animate__animated animate__fadeIn animate__slow">
        <form method='post' action='api/index.php/login'>
            <label></label>
            <h3>Please enter your details to log in.</h3>
            <br>
            <span class='error'><h4>$error</h4></span>
            <div class="form-group">
                <label for="user">Username</label>
                <input type="user" name="user" class="form-control" placeholder="Enter user" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="pass" class="form-control" placeholder="Password" required>
            </div>
            <input id="send" class="mt-3 button is-primary" type='button' value='Iniciar sesión' onclick="login()">
            <a  class="mt-3 button is-primary" href="signup.php">Registrarse<a/>
            <br>
            <p style="color:'white';"></p>
        </form>
    </div>
</div>
</div>
<!-- project end-->
</body>

</html>
_END;
}
else
{
    echo'
    <meta http-equiv="Refresh" content="0;url=index.php">
    </div></body></html>
    ';
}


//mysqli_close($connection);
?>

<script>

function login(){
    axios.post( `api/index.php/login/${document.forms[0].user.value}`, {
        user: document.forms[0].user.value,
     pass: document.forms[0].pass.value,
  })
  .then(resp =>{
    if(resp.data.afirmativo){
        //window.location=`"data.php?wea=${resp.data.wea}"`;
        alert(`Bienvenido:  ${resp.data.nombre}`)
           
        setTimeout(`location.href='index.php?user=${resp.data.wea}'` , 500)
             
    }
    else{
        alert(`Contraseña o nombre incorrecto`)

    }
  })
  .catch(error =>{
    console.log(error);
  });
          
    }


</script>

