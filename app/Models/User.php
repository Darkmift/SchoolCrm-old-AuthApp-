<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'users';
    public $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
        'updated_at',
    ];
    public function setPassword($password)
    {
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
