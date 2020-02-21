<?php
/*Return HTTP Request 200*/
 // http_response_code(200);
 // echo "line bot";

require('../vendor/autoload.php');

$app->get('/cowsay', function() use($app) {
  $app['monolog']->addDebug('cowsay');
  return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
});

?>