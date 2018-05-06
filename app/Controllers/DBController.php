<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Course;

class DBController extends Controller
{
    public function getUserList()
    {
        $users = array('users' => $this->db2->select('SELECT id,name,role,email,phone FROM users where role >= "2" AND active="1";'));
        $parsedUsers = array();
        foreach ($users as $key => $value) {
            foreach ($value as $subkey => $subvalue) {
                $parsedUsers[$subkey] = $subvalue;
            }
        }
        return $parsedUsers;
    }
    public function getCoursesList()
    {
        $courses = array('courses' => $this->db2->select('SELECT id,name,description,start_date,end_date FROM courses WHERE active="1"', [1]));
        $parsedCourses = array();
        foreach ($courses as $key => $value) {
            foreach ($value as $subkey => $subvalue) {
                $parsedCourses[$subkey] = $subvalue;
            }
        }
        return $parsedCourses;
    }
    public function getSalesList()
    {
        $users = array('sales' => $this->db2->select('SELECT id,name,role,email,phone FROM users where role = "1" AND active="1"'));
        $parsedUsers = array();
        foreach ($users as $key => $value) {
            foreach ($value as $subkey => $subvalue) {
                $parsedUsers[$subkey] = $subvalue;
            }
        }
        return $parsedUsers;
    }
    public function getStudentsList()
    {
        $users = array('students' => $this->db2->select('SELECT id,name,email,phone FROM students WHERE active="1"'));
        $parsedUsers = array();
        foreach ($users as $key => $value) {
            foreach ($value as $subkey => $subvalue) {
                $parsedUsers[$subkey] = $subvalue;
            }
        }
        return $parsedUsers;
    }
    public function showDetails($request, $response, $args)
    {
        $id = $args['id'];
        $table = $args['table'];
        $output = [];
        $enrollemnts = [];
        switch ($table) {
            case 'courses':
                $pdo = $this->db2->getPdo();
                //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $pdo->prepare(
                    "SELECT enrollments.id, courses.name, students.name,enrollments.user_id
                        from courses
                            INNER JOIN enrollments on courses.id = enrollments.course_id
                            INNER JOIN students on students.id = enrollments.student_id
                            INNER JOIN users c_user on courses.user_id = c_user.id
                            INNER JOIN users s_user on students.user_id = s_user.id
                            INNER JOIN users e_user on enrollments.user_id = e_user.id
                        where students.active = 1 and courses.active = 1 and enrollments.active = 1 and courses.id=:id");
                $statement->execute(['id' => $id]);
                $enrollemnts = $statement->fetchAll();
                $output = $this->db2->select("SELECT id,name,description,start_date,end_date FROM $table WHERE id =$id");
                break;
            case 'users':
                $output = $this->db2->select("SELECT `id`,`name`,`role`,`email`,`phone` FROM $table WHERE id =$id");
                break;
            case 'students':
                //fetch student enrollemnts
                $pdo = $this->db2->getPdo();
                $statement = $pdo->prepare(
                    "SELECT enrollments.id, courses.name, students.name
                        from courses
                            INNER JOIN enrollments on courses.id = enrollments.course_id
                            INNER JOIN students on students.id = enrollments.student_id
                            INNER JOIN users c_user on courses.user_id = c_user.id
                            INNER JOIN users s_user on students.user_id = s_user.id
                            INNER JOIN users e_user on enrollments.user_id = e_user.id
                        where students.active = 1 and courses.active = 1 and enrollments.active = 1 and students.id=:id");
                $statement->execute(['id' => $id]);
                $enrollemnts = $statement->fetchAll();
                $output = $this->db2->select("SELECT `id`,`name`,`email`,`phone` FROM $table WHERE id =$id");
                break;
        }
        $data['logged'] = array(
            'id' => $this->auth->user()->id,
            'role' => $this->auth->user()->role);
        $data['enrollments'] = $enrollemnts;
        $data['selectedEntity'] = $output;
        return $response->getBody()->write(json_encode($data));
    }

    public function updateEntry($request, $response, $args)
    {
        $id = $request->getParam('id');
        $table = $request->getParam('type');
        $action = $request->getParam('action');
        $tester = "";
        switch ($action) {
            case 'enroll':
                $tester = "enroll!!";
                break;
            case 'update':
                $tester = "update!!";
                break;
            case 'del':
                $tester = "delete!!";
                $output = json_encode($this->db2->update("UPDATE $table SET `active`='0' WHERE id=$id"));
                break;
        }
        //$csrf = array("csrf_name_value" => $this->container->csrf->getTokenName(), "csrf_value_value" => $this->container->csrf->getTokenValue());
        $derp = array($id, $table, $action, $tester);
        return $response->getBody()->write(json_encode($derp), $output);
    }

    public function getEnrollments($request, $response, $args)
    {
        $id = (int) $request->getParam('id');
        $table = $request->getParam('type');
        switch ($table) {
            case 'students':
                $pdo = $this->db2->getPdo();
                $statement = $pdo->prepare(
                    "SELECT enrollments.id, courses.name, students.name
                    from courses
                        INNER JOIN enrollments on courses.id = enrollments.course_id
                        INNER JOIN students on students.id = enrollments.student_id
                        INNER JOIN users c_user on courses.user_id = c_user.id
                        INNER JOIN users s_user on students.user_id = s_user.id
                        INNER JOIN users e_user on enrollments.user_id = e_user.id
                    where students.active = 1 and courses.active = 1 and enrollments.active = 1 and students.id=:id"
                );
                $statement->execute(['id' => $id]);
                $statement = $statement->fetchAll();
                break;
            case 'courses':
                $statement = Course::select(
                    "SELECT enrollments.id, courses.name, students.name,enrollments.user_id
                from courses
                    INNER JOIN enrollments on courses.id = enrollments.course_id
                    INNER JOIN students on students.id = enrollments.student_id
                    INNER JOIN users c_user on courses.user_id = c_user.id
                    INNER JOIN users s_user on students.user_id = s_user.id
                    INNER JOIN users e_user on enrollments.user_id = e_user.id
                where students.active = 1 and courses.active = 1 and enrollments.active = 1 and courses.id=$id"
                );
                break;
        }
        return $response->getBody()->write(
            //var_dump($query)
            json_encode($statement)
        );
    }

}
