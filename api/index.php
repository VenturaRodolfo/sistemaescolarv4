<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

// Instantiate app
$app = AppFactory::create();
$app->setBasePath("/sistemaescolarv4/api/index.php");

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);
// Add route callbacks
$app->post('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('Hello World');
    return $response;
});
//login
$app->post('/login/{user}', function (Request $request, Response $response, array $args) {

    $data  = json_decode($request->getBody()->getContents(), false);
     $nombre =  ($args['user']);
    $pass =  $data->pass;
    $user = Capsule::table('users')->select(['nombre', 'contra'])->where('nombre', $nombre)->where('contra', $pass)->first();


    $name =  new stdClass();
    if ($user->nombre == $data->user || $user->contra == $data->pass  ){
    $name->afirmativo = true;
    $name->nombre =  $user->nombre;
     
    $name->wea = $nombre;
   

    }else{
        $name->afirmativo  =  false;
    }

    
    $response->getBody()->write(json_encode($name));
    return $response;
});
//calificaciones
$app->post('/cal/{identificacion}', function (Request $request, Response $response, array $args) {

    $data = json_decode($request->getBody()->getContents(), false);


    $name = Capsule::table('users')->where('iduser', $args['identificacion'])->first();

    $msg = new stdClass();

    if($name)
    {
        $msg->name = $name->nombre . " " . $name->apellido;

        $validar = Capsule::table('materias')->where('users_iduser',$args['identificacion'])
        ->first();
        if(!$validar)
        {
            $msg->existe = true;

            $calificaciones = Capsule::table('materias')->insertOrIgnore(
                ['users_iduser' => $data->alumno, 'español' => $data->cal_esp, 'matematicas' => $data->cal_mate, 'historia' => $data->cal_histo]
            );
            if($calificaciones)
            {
                $msg->insert = true;
            }
            else {
                $msg->insert = false;
            }
        }
        else {
            $msg->existe = false;
        }
    }
    else {
        $msg->existe = false;
    }



    $response->getBody()->write(json_encode($msg));
    return $response;
});
$app->post('/actu1/{id}', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody()->getContents(), false);
    $calEspa = $data->cal_esp;
    $name = Capsule::table('users')->where('iduser', $args['id'])->first();

    $msg = new stdClass();

    if($name)
    {
        $msg->name = $name->nombre . " " . $name->apellido;

        $validar = Capsule::table('materias')->where('users_iduser',$args['id'])->first();

           // $msg->existe = true;

           // $calificaciones = Capsule::table('materias')->insertOrIgnore(
              //  ['users_iduser' => $data->alumno, 'español' => $data->cal_esp, 'matematicas' => $data->cal_mate, 'historia' => $data->cal_histo]
              $calificaciones =  Capsule::table('materias')->where('users_iduser', $args['id'])
                ->update(['español' => $calEspa]);
          
            if($calificaciones)
            {
                $msg->confir = true;
            }
            else {
                $msg->confir = false;
            }
        }
        //$msg->existe = false;
    
   /* $calEspa = $data->cal_esp;
    $noti = new stdClass();
    $validar = Capsule::table('materias')->where('users_iduser', $args['id'])
    ->first();
    if(!$validar)
    {
       if (!$calEspa) {
       ///$id = $_GET ["id"];  
       
       /*queryMysql("UPDATE users 
       SET español = '$calEspa'
       WHERE iduser = '$id' ");
       $calificaciones = Capsule::table('materias')->insertOrIgnore(['users_iduser' => $id]);
       Capsule::table('materias')->where('users_iduser', $id)
       ->update(['español' => $calEspa]);
       $noti->espav = true; 
       }     
        else
             {
        $noti->espav = false; 

             } 
    }*/
    

    $response->getBody()->write(json_encode($msg));
    return $response;
});
$app->post('/actu2/{id}', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody()->getContents(), false);
    $calMate = $data->cal_mate;
    $name = Capsule::table('users')->where('iduser', $args['id'])->first();
    
    $msg = new stdClass();

    if($name)
    {
        $msg->name = $name->nombre . " " . $name->apellido;

        $validar = Capsule::table('materias')->where('users_iduser',$args['id'])
        ->first();

           // $msg->existe = true;

           // $calificaciones = Capsule::table('materias')->insertOrIgnore(
              //  ['users_iduser' => $data->alumno, 'español' => $data->cal_esp, 'matematicas' => $data->cal_mate, 'historia' => $data->cal_histo]
              $calificaciones =  Capsule::table('materias')->where('users_iduser', $args['id'])
                ->update(['matematicas' => 
                $calMate]);
          
            if($calificaciones)
            {
                $msg->confir = true;
            }
            else {
                $msg->confir = false;
            }
        }
        $response->getBody()->write(json_encode($msg));
        return $response;
    });
    $app->post('/actu3/{id}', function (Request $request, Response $response, array $args) {
        $data = json_decode($request->getBody()->getContents(), false);
        $calHisto = $data->cal_histo;
        $name = Capsule::table('users')->where('iduser', $args['id'])->first();
    
        $msg = new stdClass();
    
        if($name)
        {
            $msg->name = $name->nombre . " " . $name->apellido;
    
            $validar = Capsule::table('materias')->where('users_iduser',$args['id'])
            ->first();
    
               // $msg->existe = true;
    
               // $calificaciones = Capsule::table('materias')->insertOrIgnore(
                  //  ['users_iduser' => $data->alumno, 'español' => $data->cal_esp, 'matematicas' => $data->cal_mate, 'historia' => $data->cal_histo]
                  $calificaciones =  Capsule::table('materias')->where('users_iduser', $args['id'])
                    ->update(['historia' => $calHisto]);
              
                if($calificaciones)
                {
                    $msg->confir = true;
                }
                else {
                    $msg->confir = false;
                }
            }
            $response->getBody()->write(json_encode($msg));
            return $response;
        });
$app->post('/signup/{user}', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody()->getContents(), false);
   $nombre =  $args['user'];
   $pass =  $data->pass;
   $apellido  = $data->apellido;
   //$user = Capsule::table('users')->select(['nombre', 'contra'])->where('nombre', $nombre)->where('contra', $pass)->first();


   $sig =  new stdClass();
   if ($data->user == "" ||  $data->pass  == "" || $data->apellido == ""  ){
   $name->afirmativo = false;
   }else{
       //$result = Capsule::table('users')->select(['nombre'])->where('nombre',$args['user'])->first();
     //  $result = Capsule::table('users')->select(['apellido'])->where('apellido', $apellido)->first();
    // $result = Capsule::table('users')->where('idaccess', '=' , 2)->first();
       $result = Capsule::table('users')->where('nombre', '=' , $nombre)->first();
    //$comparacion =  $result['nombre'];
if($result){
   if ($result->nombre==$nombre){
   $sig->error = 'That username already exists';
   $sig->repetido =  true;
   }
}
else
{ 
 
 $sig->repetido = false;
$sig->afirmativo  =  true;
$sig->wea = $args['user'];
//$nombredb =  $result->nombre;
$pass =  $data->pass;
$apellido  = $data->apellido;
//$name->nombre =  $user->nombre;
Capsule::table('users')->insert(['nombre' => $args['user'], 'apellido' => $apellido, 'contra' => $pass, 'idaccess'=> '2', ]);
}
}
    $response->getBody()->write(json_encode($sig));
            
            return $response;
        });












// Run application
$app->run();