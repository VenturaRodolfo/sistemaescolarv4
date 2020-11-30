<?php // Example 26-5: signup.php
   use Illuminate\Database\Capsule\Manager as Capsule;
   require_once "data.php";
   require_once 'header.php';
 
echo <<<_END
<div class="col-10 offset 1 col-md-10 offset-md-1 mt-1">
      <form method='post' action='api/index.php/signup'>
      <div data-role='fieldcontain'>
        <label></label>
        Please enter your details to sign up
      </div>
      <div data-role='fieldcontain'>
        <label>Nombre</label>
        <input type='text' class="form-control" maxlength='16' placeholder="Nombre" name='user' value='..' required>
      </div>
      <div data-role='fieldcontain'>
        <label>Apellido</label>
        <input type='text' class="form-control" maxlength='16' placeholder="Apellido" name='apellido' value='..' required>
      </div>
      <div data-role='fieldcontain'>
        <label>Password</label>
        <input type='password'class="form-control"  maxlength='16' placeholder="Contraseña" name='pass' value='..' required>
      </div>
      <div data-role='fieldcontain'>
        <label></label>
        <input data-transition='slide' class="form-control" type='button' value='Sign Up' onclick="signup()">
      </div>
    </div>
    </div>
  </body>
</html>
_END;
?>
<script>
function signup(){
    axios.post( `api/index.php/signup/${document.forms[0].user.value}`, {
      user: document.forms[0].user.value,
     apellido: document.forms[0].apellido.value,
     pass: document.forms[0].pass.value,
  })
  .then(resp =>{
    if(resp.data.repetido)
    {

      alert(`${resp.data.error}`)             
            
    }
    else{
    if(resp.data.afirmativo){
        //window.location=`"data.php?wea=${resp.data.wea}"`;
        alert(`Registrado con exito:  ${resp.data.wea}`) 
        setTimeout(`location.href='index.php?user=${resp.data.wea}'` , 500)            
    }
    else{
        alert(`Falta llenar un campo`)
    
      }
    }
  })
  .catch(error =>{
    console.log(error);
  });
          
    }


</script>