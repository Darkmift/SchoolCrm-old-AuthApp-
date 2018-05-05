<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Student;
use Respect\Validation\Validator as v;

class SignUp extends Controller
{
    public function getSignUp($request, $response)
    {
        return $this->view->render($response, 'auth\signup.twig');
    }

    public function postSignUp($request, $response)
    {
        // $fucku = $this->DBController->userList();
        // $users = ['users' => $fucku];
        // var_dump($users);
        // die();
        //respect/validation validator object
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->emailAvailable(),
            'name' => v::notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
            // 'image' => v::mimetype('image/png')->validate($request->getUploadedFiles())
        ]);

        /////////
        //get uploads
        $uploadedFiles = $request->getUploadedFiles();
        // get image from uploads
        $uploadedFile = $uploadedFiles['image'];
        //image validate chunk end
        $this->ImageValidator->failed($uploadedFile);

        if ($validation->failed() || $this->ImageValidator->failed($uploadedFile)) {
            $this->flash->addMessage('signupError', '');
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }
        //authcontrollersignup chunk 1 sent to graveyard

        //if form valid create user
        $user = Student::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);
        //Get the PDO object to bind the id as name to image
        $pdo = $this->db2->getPdo();
        $statement = $pdo->prepare("SELECT * FROM users WHERE name= :name");
        $statement->execute(['name' => $request->getParam('name')]);
        $result = $statement->fetch();
        $id = $result['id'];
        //pass user name and id to image storage function
        $this->ImageValidator->moveUploadedFile($this->container->upload_directory_users, $uploadedFile, $id);

        $this->flash->addMessage('info', 'Registration successful!');

        //create session for new registered user so he may be redirected automatically to home.twig
        $this->auth->attemptLogin($user->email, $request->getParam('password'));

        //redirect user on succesful registration
        return $response->withRedirect($this->router->pathFor('home'));
    }
}
