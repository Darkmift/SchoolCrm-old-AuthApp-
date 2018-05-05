<?php

var_dump($request->getParam('name'));
return 'HomeController';
return var_dump($container);
$user=$this->db->table('users')->find(1);
$user=$this->db->table('users')->where('id',1)->get();
$user=$this->db->table('users')->where('name','alex')->get();
//broken/null
$user=$this->db->select('select * from users where id = ?', array(1));
$user=$this->db->pluck('name', 'id');
//model query
$user=User::find(1);
$user=User::where('email','alex@codecourse.com')->first();
var_dump($user->email);
die();
User::create([
    'name' => 'TEST02',
    'email' => 'TEST02@email.com',
    'password' => '12345',
]);

//authcontrollersignup chunk 1
if ($uploadedFile->getSize() == 0) {
    $_SESSION['errors']['image'] = 'Please add image';
    $this->uploadStatus = false;
} else {
    if ($uploadedFile->getClientMediaType() !== "image/jpeg") {
        $_SESSION['errors']['image'] = '"' . $uploadedFile->getClientFilename() . '" is wrong file format!';
        $this->uploadStatus = false;
    } else {
        if ($uploadedFile->getSize() > 1048576) {
            $_SESSION['errors']['image'] = '"' . $uploadedFile->getClientFilename() . '" is too large (' . $uploadedFile->getSize() . ')!';
            $this->uploadStatus = false;
        }
    }
}
///////

if ($validation->failed() || $this->uploadStatus == false) {
    return $response->withRedirect($this->router->pathFor('auth.signup'));
}
