<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Respect\Validation\Validator as v;

class CreateUser extends Controller
{
    public function getUserSignUp($request, $response)
    {
        return $this->view->render($response, 'auth/user_create.twig');
    }

    public function postUserSignUp($request, $response)
    {
        //respect/validation validator object
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->emailAvailable(),
            'name' => v::notEmpty()->alpha(),
            'phone' => v::notEmpty()->PhoneValid(),
            'password' => v::noWhitespace()->notEmpty(),
            'role' => v::notEmpty(),
        ]);

        /////////
        //get uploads
        $uploadedFiles = $request->getUploadedFiles();
        // get image from uploads
        $uploadedFile = $uploadedFiles['image'];
        //image validate chunk end
        $this->ImageValidator->failed($uploadedFile);

        if ($validation->failed() || $this->ImageValidator->failed($uploadedFile)) {
            $this->flash->addMessage('userCreateError', '');
            return $response->withRedirect($this->router->pathFor('auth.user_create'));
        }

        //if form valid create user
        $role = $request->getParsedBodyParam("role");
        switch ($role) {
            case 'S':
                echo 'student';
                $user = Student::create([
                    'name' => $request->getParam('name'),
                    'email' => $request->getParam('email'),
                    'phone' => $request->getParam('phone'),
                    'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
                ]);
                //Get the PDO object to bind the id as name to image
                $pdo = $this->db2->getPdo();
                $statement = $pdo->prepare("SELECT * FROM students WHERE name= :name");
                $statement->execute(['name' => $request->getParam('name')]);
                $result = $statement->fetch();
                $id = $result['id'];
                //pass user name and id to image storage function
                $this->ImageValidator->moveUploadedFile($this->container->upload_directory_students, $uploadedFile, $id);
                break;
            case '1';
            case '2':
                echo 'sales/admin';
                $user = User::create([
                    'name' => $request->getParam('name'),
                    'email' => $request->getParam('email'),
                    'phone' => $request->getParam('phone'),
                    'role' => $request->getParam("role"),
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
                break;
            default:
                die('Go away.');
                break;
        }

        $this->flash->addMessage('info', 'Registration successful!');

        //create session for new registered user so he may be redirected automatically to home.twig
        //$this->auth->attemptLogin($user->email, $request->getParam('password'));

        //redirect user on succesful registration
        return $response->withRedirect($this->router->pathFor('home'));
    }
}
