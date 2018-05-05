<?php

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        // var_dump('middleware');
        // if(Validator::failed()){
        //  $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        //  unset($_SESSION['errors']);
        // }

        // if (empty($_SESSION['errors'])) {
        //     $_SESSION['errors'] = true;
        // }

        if (isset($_SESSION['errors'])) {
            $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }

        $response = $next($request, $response);
        return $response;
    }
}
