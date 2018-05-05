<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\User;
use Respect\Validation\Validator as v;

class UserUpdate extends Controller
{
    public function populateForm($request, $response)
    {
        $id = $request->getParam('id');
        $table = $request->getParam('type');
        if ($table == "users") {
            $userList = array('user' => $this->db2->select("SELECT id,name,email,phone,role FROM $table WHERE id =$id"));
        }
        if ($table == "students") {
            $pdo = $this->db2->getPdo();
            $statement = $pdo->prepare(
                "SELECT
                enrollments.id as enrollID,
                courses.name as courseName,
                courses.id as 'courseID',
                students.id as 'studentID'
            FROM
                courses
            INNER JOIN enrollments ON courses.id = enrollments.course_id
            INNER JOIN students ON students.id = enrollments.student_id
            INNER JOIN users c_user ON
                courses.user_id = c_user.id
            INNER JOIN users s_user ON
                students.user_id = s_user.id
            INNER JOIN users e_user ON
                enrollments.user_id = e_user.id
            WHERE
                students.active = 1 AND courses.active = 1 AND enrollments.active = 1 AND students.id = :id"
            );
            $statement->execute(['id' => $id]);
            $output = $statement->fetchAll();
            //get all courses
            $courseList = $this->db2->select("SELECT id as courseID,name as courseName FROM courses WHERE active = 1");
            //unset courses which student is enrolled in

            foreach ($output as $key => $value) {
                for ($i = 0; $i < count($courseList); $i++) {
                    if (
                        isset($output[$key]['courseID']) &&
                        isset($courseList[$i]->courseID) &&
                        ($output[$key]['courseID'] === $courseList[$i]->courseID)
                    ) {
                        unset($courseList[$i]);
                    }
                }
            }

            if (count($output) === 0) {
                $userList["empty"] = 'empty';
            }

            $userList = array(
                'student' => $this->db2->select("SELECT id,name,email,phone FROM $table WHERE id =$id"),
                'enrollments' => $output,
                'courseToEnrollIn' => $courseList,
            );
        }
        return $this->view->render($response, 'auth/user_update.twig', $userList);
    }

    public function submitForm($request, $response)
    {
        $id = $request->getParam('id');
        $table = $request->getParam('type');
        //respect/validation validator object
        $pw = $request->getParam('password');
        if ($pw) {
            $pwValidation = $this->validator->validate($request, [
                'password' => v::noWhitespace(),
            ]);
        }
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty(),
            'name' => v::notEmpty()->alpha(),
            'phone' => v::notEmpty()->PhoneValid(),
            'role' => v::notEmpty(),
        ]);
/////////
        if ($validation->failed()) {
            $this->flash->addMessage('userCreateError', '');
            $args = ['id' => $id, 'type' => $table];
            return $response->withRedirect($this->router->pathFor('auth.user_update', [], $args));
        }
//if form valid create user
        $role = $request->getParsedBodyParam("role");
        switch ($role) {
            case 'S':
                Student::where('id', $id)
                    ->update([
                        'name' => $request->getParam('name'),
                        'email' => $request->getParam('email'),
                        'phone' => $request->getParam('phone'),
                    ]);
                if ($pw) {
                    Student::where('id', $id)
                        ->update([
                            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
                        ]);
                }
                $this->flash->addMessage('info', 'Update of ' . $request->getParam('name') . ' successful!');
                return $response->withRedirect($this->router->pathFor('home'));
                break;
            case '1';
            case '2':
                echo 'sales/admin';
                User::where('id', $id)
                    ->update([
                        'name' => $request->getParam('name'),
                        'email' => $request->getParam('email'),
                        'phone' => $request->getParam('phone'),
                        'role' => $request->getParam("role"),
                    ]);
                if ($pw) {
                    User::where('id', $id)
                        ->update([
                            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
                        ]);
                }
                $this->flash->addMessage('info', 'Update of ' . $request->getParam('name') . ' successful!');
                return $response->withRedirect($this->router->pathFor('home'));
                break;
            default:
                die('Go away.');
                break;
        }

    }

    public function ChangeImage($request, $response)
    {
        $id = $request->getParam('id');
        $table = $request->getParam('type');
        /////////
        //get uploads
        $uploadedFiles = $request->getUploadedFiles();
        // get image from uploads
        $uploadedFile = $uploadedFiles['image'];
        //image validate chunk end
        $this->ImageValidator->failed($uploadedFile);

        if ($this->ImageValidator->failed($uploadedFile)) {
            $this->flash->addMessage('imageUpdateError', '');
            $args = ['id' => $id, 'type' => $table];
            return $response->withRedirect($this->router->pathFor('auth.user_update', [], $args));
        }
        //Get the PDO object to bind the id as name to image
        $pdo = $this->db2->getPdo();
        $statement = $pdo->prepare("SELECT id,name FROM $table WHERE id= :id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();
        $id = $result["id"];
        $name = $result["name"];
        //pass user name and id to image storage function
        if ($table == "students") {
            $this->ImageValidator->moveUploadedFile($this->container->upload_directory_students, $uploadedFile, $id);
        }
        if ($table == "users") {
            $this->ImageValidator->moveUploadedFile($this->container->upload_directory_users, $uploadedFile, $id);
        }
        $this->flash->addMessage('info', 'Image changed for ' . $name . ' successful!');
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function enrollmentManagmentForUser($request, $response)
    {
        //eid is enrollid if unenroll or ccourse id if enroll
        $eid = $request->getParam('eid');
        $sid = $request->getParam('sid');
        $sname = $request->getParam('sname');
        $cname = $request->getParam('cname');
        $action = $request->getParam('action');
        // var_dump($sname, $cname);
        // die();
        if ($action == 'unEnroll') {
            Enrollment::where('id', $eid)
                ->update([
                    'active' => 0,
                ]);
            $this->flash->addMessage('info', $sname . ' was removed from: ' . $cname . ' successfully');
        }
        if ($action == 'enroll') {
            $pdo = $this->db2->getPdo();
            $statement = $pdo->prepare("SELECT
                `id`,
                `active`
            FROM
                `enrollments`
            WHERE
                `student_id` = :sid AND `course_id` = :eid");
            $statement->execute([
                'sid' => $sid,
                'eid' => $eid,
            ]);
            $result = $statement->fetch();
            $enrollexists = $result['active'];
            $enrollId = $result['id'];
            if (is_null($enrollexists)) {
                Enrollment::create([
                    'student_id' => $sid,
                    'course_id' => $eid,
                    'user_id' => $this->auth->user()->id,
                ]);
                $this->flash->addMessage('info', $sname . ' was enrolled to: ' . $cname . ' successfully');
            } else {
                Enrollment::where('id', $enrollId)
                    ->update([
                        'active' => 1,
                    ]);
                $this->flash->addMessage('info', $sname . ' was re-enrolled to: ' . $cname . ' successfully');
            }

        }
        return $response->withRedirect($this->router->pathFor('home'));
        // die('enrollment deaactivated');
    }
}