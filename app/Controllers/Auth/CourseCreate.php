<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Course;
use Respect\Validation\Validator as v;

class CourseCreate extends Controller
{
    public function getCourseCreate($request, $response)
    {
        return $this->view->render($response, 'auth\course_create.twig');
    }

    public function postCourseCreate($request, $response)
    {
        //respect/validation validator object
        $validation = $this->validator->validate($request, [
            'name' => v::notEmpty(),
            'description' => v::notEmpty()->length(40, 2000),
            'start_date' => v::noWhitespace()->notEmpty()->date('Y-m-d'),
            'end_date' => v::noWhitespace()->notEmpty()->date('Y-m-d'),
        ]);
        /////////
        //get uploads
        $uploadedFiles = $request->getUploadedFiles();
        // get image from uploads
        $uploadedFile = $uploadedFiles['image'];
        //image validate chunk end--needed for display of errors
        $this->ImageValidator->failed($uploadedFile);

        if ($validation->failed() || $this->ImageValidator->failed($uploadedFile)) {
            $this->flash->addMessage('courseError', '');
            return $response->withRedirect($this->router->pathFor('auth.course_create'));
        }
        //if form valid create user
        $user = Course::create([
            'name' => $request->getParam('name'),
            'description' => $request->getParam('description'),
            'start_date' => $request->getParam('start_date'),
            'end_date' => $request->getParam('end_date'),
            'user_id' => $this->auth->user()->id,
        ]);
        //Get the PDO object to bind the id as name to image
        $pdo = $this->db2->getPdo();
        $statement = $pdo->prepare("SELECT * FROM courses WHERE name= :name");
        $statement->execute(['name' => $request->getParam('name')]);
        $result = $statement->fetch();
        $id = $result['id'];
        //pass user name and id to image storage function
        $this->ImageValidator->moveUploadedFile($this->container->courseImage_upload_directory, $uploadedFile, $id);

        $this->flash->addMessage('info', 'Course creation successful!');
        //redirect user on succesful registration
        return $response->withRedirect($this->router->pathFor('home'));
    }
}
