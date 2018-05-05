
<?php

// $result = Capsule::select('select * from users where id =' . $_SESSION['user']);
// $sessionUserArray = "";
// $sessionUserArray = (object) $sessionUserArray;
// foreach ($result as $key => $value) {
//     // var_dump($key);
//     // var_dump($result[$key]->name);
//     // var_dump($result[$key]->email);
//     foreach ($result[$key] as $key => $value) {
//         $sessionUserArray->$key = $value;
//     }
// }
// $sessionUserArray;
// var_dump($sessionUserArray);
// die();
// return User::where('email', $email)->first();
//var_dump(Capsule::select('select * from users where id =' . $_SESSION['user'], array(1)));
// var_dump($sessionUserArray->name);
// die();
//return $sessionUserArray;
//return Capsule::select('select * from users where id =' . $_SESSION['user'], array(1));

//return user record
// public function user()
// {
//     // var_dump(json_encode(user::find($_SESSION['user'])));
//     // die();
//     return user::find($_SESSION['user']);
// }