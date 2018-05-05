<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        //check if user is signed in
        if (!$this->container->auth->check()) {
            $this->container->flash->addmessage('error', 'you must sign in to continue');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }
        $response = $next($request, $response);
        return $response;
    }
}
