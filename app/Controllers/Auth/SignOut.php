<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;

class SignOut extends Controller
{
    public function getSignOut($request, $response)
    {
        //sign out
        $this->auth->logout();
        //redirect
        return $response->withRedirect($this->router->pathFor('home'));
    }
}
