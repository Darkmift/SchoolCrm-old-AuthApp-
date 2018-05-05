<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;

class PasswordChange extends Controller
{
    public function getChangedPassword($request, $response)
    {
        return $this->view->render($response, 'auth/password/change.twig');
    }
    public function postChangedPassword($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password' => v::noWhitespace()->notEmpty(),
        ]);
        if ($validation->failed()) {
            $this->flash->addMessage('passwordChange', '');
            return $response->withRedirect($this->router->pathFor('auth.password.change'));
        }
        $this->auth->user()->setPassword($request->getParam('password'));
        $this->flash->addMessage('success','your password was changed');
        return $response->withRedirect($this->router->pathFor('home'));
    }
}
