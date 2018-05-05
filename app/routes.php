<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
$app->get('/home', function ($request, $response) {
    return $this->view->render($response, 'home.twig');
});
$app->group('', function () {
    //signup
    $this->get('/auth/signup', 'SignUp:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'SignUp:postSignUp');

    //signin
    $this->get('/auth/signin', 'SignIn:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'SignIn:postSignin');

})->add(new GuestMiddleware($container));

$app->group('', function () {
    //calls controller from app.php $container['HomeController']
    $this->get('/', 'HomeController:index')->setName('home');
    $this->post('/', 'HomeController:operationBtns')->setName('home.Display');

    //user creation
    $this->get('/auth/user_create', 'CreateUser:getUserSignUp')->setName('auth.user_create');
    $this->post('/auth/user_create', 'CreateUser:postUserSignUp');

    //course creation
    $this->get('/auth/course_create', 'CourseCreate:getCourseCreate')->setName('auth.course_create');
    $this->post('/auth/course_create', 'CourseCreate:postCourseCreate');

    //signout
    $this->get('/auth/signout', 'SignOut:getSignOut')->setName('auth.signout');

    //password change
    $this->get('/auth/password/change', 'PasswordChange:getChangedPassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordChange:postChangedPassword');

    //ajax routes
    //show user/student/course details
    $this->get('/{table}/{id}', 'DBController:showDetails');

    //update/delete db entry
    $this->get('/updateEntry', 'DBController:updateEntry');

    //update/delete db entry
    $this->get('/getEnrollments', 'DBController:getEnrollments');

    //user update
    $this->get('/user_update', 'UserUpdate:populateForm')->setName('auth.user_update');
    $this->post('/user_update', 'UserUpdate:populateForm');
    $this->post('/user_update_submit', 'UserUpdate:submitForm')->setName('auth.user_update_submit');
    $this->post('/user_update_image', 'UserUpdate:ChangeImage')->setName('auth.user_update_image_submit');
    //course update
    $this->get('/course_update', 'CourseUpdate:populateForm')->setName('auth.course_update');
    $this->post('/course_update', 'CourseUpdate:populateForm');
    $this->post('/course_update_submit', 'CourseUpdate:submitForm')->setName('auth.course_update_submit');
    $this->post('/course_update_image', 'CourseUpdate:ChangeImage')->setName('auth.course_update_image_submit');

    //enroll management user
    $this->post('/user_enroll_management', 'UserUpdate:enrollmentManagmentForUser');
    //enroll management coursee
    $this->post('/course_enroll_management', 'CourseUpdate:enrollmentManagmentForCourse');
})->add(new AuthMiddleware($container));
