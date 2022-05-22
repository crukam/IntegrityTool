<?php

class Router {
    // routing table array
    protected  $routes = array();

    //current routes
    protected $currentControllerAction = array();

    /**
     * Add a route to the routing table
     * 
     * @param string $route  url
     * @param array $controllerAction controller action for the url
     * 
     * @return void
     */
    public function add($route, $controllerAction = []) {
        $route = preg_replace('/\//', '\\/', $route);
        
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/','(?P<\1>\2)',$route);
        
        $route = '/^'.$route.'$/i';
        //return $route;
        $this->routes[$route] = $controllerAction;

    }

    /**
     * Get all routing from the routing table
     */
    public function getRoutes(){
        return $this->routes;
    }

    /**
     * Match the request url to a route in the routing table and set the current controller action
     * @param string $request
     * 
     * @return boolean
     */
    public function matchRequestUrl($request) {
      
        foreach($this->routes as  $route => $controlAction){
            if(preg_match($route,$request,$matches)){
                foreach($matches as $key=>$match){
                    if(is_string($key)){
                        $controlAction[$key] = $match;
                    }
                }
                $this->currentControllerAction = $controlAction;
                return true;
            }
        }
        return false;
    }

    /**
     * Get currentControllerAction array
     * 
     * @param void
     * 
     * @return array
     */
    public function getCurrentControllerAction(){
        return $this->currentControllerAction;
    }
    /**
     * Dispatch request to currentController Action
     * 
     * @param string $request
     * 
     * @return void
     */
    public function dispatchControllerAction($request){
        if($this->matchRequestUrl($request)){
            $controller = str_replace('','',ucwords(str_replace('-','',$this->currentControllerAction['controller'])));
            if(class_exists($controller)){
                $controller_object = new $controller();
                $action = lcfirst(str_replace('','',ucwords(str_replace('-','',$this->currentControllerAction['action']))));

                if(is_callable([$controller_object,$action])){
                    $controller_object->$action();
                } else {
                    echo 'action method '.$action.' not found ';
                }
            } else {
                echo 'controller class' .$controller. 'does not exist';
            }
        } else {
            echo 'request '.$request.' not matching any route';
        }
    }
}