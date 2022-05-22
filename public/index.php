<?php

require('../Core/Router.php');

$router = new Router();

$router->add('',['controller'=>'Home', 'action'=>'index']);
$router->add('/professionnals',['controller'=>'Professional', 'action'=>'index']);
$router->add('/professionnals/add',['controller'=>'Professional', 'action'=>'add']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('/userProfessionalReviews/{action}/{id:\d+}');

echo '<pre>';
    print_r($router->getRoutes());
    //print_r($router->matchRequestUrl());
    //print_r($router->getCurrentControllerAction());
    //if($router->matchRequestUrl($_SERVER['QUERY_STRING'])){
      //  print_r($router->matchRequestUrl($_SERVER['QUERY_STRING']));
    //} else {
      //  echo 'route no found';
    //}
    //$router->matchRequestUrl($_SERVER['QUERY_STRING']); print(PHP_EOL);
    //print_r($router->getCurrentControllerAction());
    //print_r($_SERVER['QUERY_STRING']); print(PHP_EOL);
    //print_r($router->add($_SERVER['QUERY_STRING'],[]));
   // print(PHP_EOL);
echo'</pre>';
//echo(get_class($router));