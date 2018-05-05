<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Respect\Validation\Validator as v;

class CourseUpdate extends Controller
{
    public function populateForm($request, $response)
    {
        $id = $request->getParam('id');
        $table = $request->getParam('type');
        //get enrolled in this course
        $pdo = $this->db2->getPdo();
        $statement = $pdo->prepare(
            "SELECT
                enrollments.id as enrollID,
                students.name as studentName,
                courses.id as 'courseID',
                students.id as 'studentID'
            from courses
                INNER JOIN enrollments on courses.id = enrollments.course_id
                INNER JOIN students on students.id = enrollments.student_id
                INNER JOIN users c_user on courses.user_id = c_user.id
                INNER JOIN users s_user on students.user_id = s_user.id
                INNER JOIN users e_user on enrollments.user_id = e_user.id
            where students.active = 1 and courses.active = 1 and enrollments.active = 1 and courses.id= :id"
        );
        $statement->execute(['id' => $id]);
        $output = $statement->fetchAll();

        //get all students
        $studentList = $this->db2->select("SELECT id as studentID,name as studentName FROM students WHERE active = 1");
        //unset courses which student is enrolled in

        foreach ($output as $key => $value) {
            for ($i = 0; $i < count($studentList); $i++) {
                if (
                    isset($output[$key]['studentID']) &&
                    isset($studentList[$i]->studentID) &&
                    ($output[$key]['studentID'] === $studentList[$i]->studentID)
                ) {
                    unset($studentList[$i]);
                }
            }
        }
        // die();
        $userList = array(
            'course' => $this->db2->select("SELECT * FROM courses WHERE id =$id"),
            'enrollments' => $output,
            'studentsToEnrollIn' => $studentList,
        );
        if (count($output) === 0) {
            $userList["empty"] = 'empty';
        }
        return $this->view->render($response, 'auth\course_update.twig', $userList);
    }

    public function submitForm($request, $response)
    {
        $id = $request->getParam('id');
        $table = $request->getParam('type');

        //respect/validation validator object
        $validation = $this->validator->validate($request, [
            'name' => v::notEmpty(),
            'description' => v::notEmpty()->length(40, 2000),
            'start_date' => v::noWhitespace()->notEmpty()->date('Y-m-d'),
            'end_date' => v::noWhitespace()->notEmpty()->date('Y-m-d'),
        ]);
        /////////

        if ($validation->failed()) {
            $this->flash->addMessage('courseError', '');
            $args = ['id' => $id, 'type' => $table];
            return $response->withRedirect($this->router->pathFor('auth.course_update', [], $args));
        }
        //if form valid create user
        $user = Course::where('id', $id)
            ->update([
                'name' => $request->getParam('name'),
                'description' => $request->getParam('description'),
                'start_date' => $request->getParam('start_date'),
                'end_date' => $request->getParam('end_date'),
            ]);

        $this->flash->addMessage('info', 'Course creation successful!');
        //redirect user on succesful registration
        return $response->withRedirect($this->router->pathFor('home'));
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
            return $response->withRedirect($this->router->pathFor('auth.course_update', [], $args));
        }
        //Get the PDO object to bind the id as name to image
        $pdo = $this->db2->getPdo();
        $statement = $pdo->prepare("SELECT id,name FROM $table WHERE id= :id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();
        $id = $result["id"];
        $name = $result["name"];
        //pass user name and id to image storage function
        if ($table == "courses") {
            $this->ImageValidator->moveUploadedFile($this->container->courseImage_upload_directory, $uploadedFile, $id);
        }
        $this->flash->addMessage('info', 'Image changed for ' . $name . ' successful!');
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function enrollmentManagmentForCourse($request, $response)
    {
        //eid is enrollid if unenroll or ccourse id if enroll
        $eid = $request->getParam('eid');
        $sid = $request->getParam('sid');
        $cname = $request->getParam('sname');
        $sname = $request->getParam('cname');
        $action = $request->getParam('action');
        echo '<pre>';
        echo 'sname: ' . $sname;
        echo ' sid: ' . $sid . '<hr>';
        echo ' cname: ' . $cname;
        echo ' eid: ' . $eid;
        echo '</pre>';
        // die();
        //var_dump($sname, $cname, $eid, $sid, $action);
        if ($action == 'unEnroll') {
            Enrollment::where('id', $eid)
                ->update([
                    'active' => 0,
                ]);
            $this->flash->addMessage('info', $sname . ' was removed from: ' . $cname . ' successfully');
        }
        //die($sname . ' removed from ' . $cname);
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
