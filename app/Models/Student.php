<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $table = 'students';
    public $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'updated_at',
        'added_by',
    ];
    public function setPassword($password)
    {
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
