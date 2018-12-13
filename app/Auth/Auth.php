<?php

namespace App\Auth;

use App\Models\User;

class Auth
{
    //if session isset (check=true) return user record ($_SESSION established in attempt() as logging user id)
    public function user()
    {
        if (isset($_SESSION['user'])) {
            return User::find($_SESSION['user']);
        }
        return false;
    }

    //check if session is set
    public function check()
    {
        if (isset($_SESSION['user'])) {
            $active = User::find($_SESSION['user'])->active;
            if ($active) {
                return isset($_SESSION['user']);
            }
        }

    }

    public function role()
    {
        if (isset($_SESSION['user'])) {
            return User::find($_SESSION['user'])->role;
        }
    }

    public function attemptLogin($email, $password)
    {
        //grab user by email
        $user = User::where('email', $email)->where('active', 1)->first();
        if (!$user) {
            //false if fails
            return false;
        }
        if (password_verify($password, $user->password)) {
            // var_dump($user);
            // die();
            //if true verify password
            //set session if true
            $_SESSION['user'] = $user->id;
            return true;
        }
        //if password verify failed
        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}
