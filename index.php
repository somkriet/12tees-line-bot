<?php

/*Return HTTP Request 200*/
 http_response_code(200);
 echo "line bot";

require('../vendor/autoload.php');
$app = new Silex\Application();
$app['debug'] = true;

// $host = 'ec2-3-229-210-93.compute-1.amazonaws.com';
// $dbname = 'dbud41ic7prd1b';
// $user = 'vymkgetnrcudai';
// $pass = 'ffc3459e10c05dbc1a0f7a51058eec466302af9c07a874f74944d4d4b9790902';
// $connection = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);

$dbopts = parse_url(getenv('postgres://vymkgetnrcudai:ffc3459e10c05dbc1a0f7a51058eec466302af9c07a874f74944d4d4b9790902@ec2-3-229-210-93.compute-1.amazonaws.com:5432/dbud41ic7prd1b'));
$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["vymkgetnrcudai"],
                   'password' => $dbopts["ffc3459e10c05dbc1a0f7a51058eec466302af9c07a874f74944d4d4b9790902"],
                   'host' => $dbopts["ec2-3-229-210-93.compute-1.amazonaws.com"],
                   'port' => $dbopts["5432"],
                   'dbname' => ltrim($dbopts["dbud41ic7prd1b"],'/')
                   )
               )
);

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->get('/db/', function() use($app) {
  $st = $app['pdo']->prepare('SELECT name FROM test_table');
  $st->execute();

  $names = array();
  while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['name']);
    $names[] = $row;
  }

  return $app['twig']->render('database.twig', array(
    'names' => $names
  ));
});

$app->run();
 
?>