<?php

/*Return HTTP Request 200*/
 http_response_code(200);
 echo "line bot";

require('../vendor/autoload.php');

$dbopts = parse_url(getenv('postgres://egdoqklyfxxuoh:df2eefada1fc9775f1d6164f3a419146822110833a003d097180c0b0806831ba@ec2-3-231-46-238.compute-1.amazonaws.com:5432/dc1e9799lr8vv5'));
$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
                   )
               )
);
 
?>