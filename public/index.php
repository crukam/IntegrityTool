<?php

require('../Core/Router.php');
require('../App/Controllers/Professionnals.php');
require('../App/Controllers/UserProfessionnalReviews.php');
require('../App/Controllers/Users.php');

$router = new Router();

$router->add('',['controller'=>'Home', 'action'=>'index']);
$router->add('/professionnals/index',['controller'=>'Professionals', 'action'=>'index']);
$router->add('/professionnals/add-new',['controller'=>'Professionals', 'action'=>'addNew']);
$router->add('/users/index',['controller'=>'Users','action'=>'index']);
$router->add('/users/add-new',['controller'=>'Users','action'=>'addNew']);
$router->add('/user-professional-reviews/index',['controller'=>'UserProfessionalReviews','action'=>'index']);
$router->add('/user-professional-reviews/add-new',['controller'=>'UserProfessionalReviews','action'=>'addNew']);
$router->add('{controller}/{action}');
//$router->add('{controller}/{id:\d+}/{action}');
//$router->add('/userProfessionalReviews/{action}/{id:\d+}');

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
   $router->dispatchControllerAction($_SERVER['QUERY_STRING']);
echo'</pre>';
//echo(get_class($router));