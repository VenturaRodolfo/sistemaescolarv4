<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php // Example 26-3: setup.php
use Illuminate\Database\Capsule\Manager as Capsule;
   require_once 'functions.php';
   require_once 'createdb.php';
   require "vendor/autoload.php";
   require "config/database.php";

  Capsule::schema()->create('users', function ($table) {
    $table->integer('iduser')->autoIncrement();
    $table->string('nombre')->unique();
    $table->string('apellido');
    $table->string('contra');
    $table->integer('idaccess');
  });

    Capsule::schema()->create('materias', function ($table) {
    $table->foreignId('users_iduser');
    $table->integer('español');
    $table->integer('matematicas');
    $table->integer('historia');
});
Capsule::table('users')->insert(['nombre' => 'Uriel', 'apellido' => 'Ceron', 'contra' => '123456', 'idaccess' => '1']);
Capsule::table('users')->insert(['nombre' => 'Rodolfo', 'apellido' => 'Ventura', 'contra' => '123', 'idaccess' => '2']);

       /* createTable('users',
                    1 'iduser INT(10) NOT NULL AUTO_INCREMENT,
                    2 nombre TEXT,
                    3 apellido TEXT,
                    4 contra INT(16),
                    5 idaccess INT(1),
                    
                    
                    1 español INT(2), 
                    2 matematicas INT(2),
                    3 historia INT(2),
                    
                    another table from teachers
                    PRIMARY KEY (iduser),
                     INDEX(nombre(6))');

queryMysql("INSERT INTO users(nombre, apellido, contra, idaccess, español, matematicas, historia) VALUES('Uriel', 'Ceron', '123456', '1', '', '', '')")
*/ ?> 
 <br>...done.
  </body>
</html>
