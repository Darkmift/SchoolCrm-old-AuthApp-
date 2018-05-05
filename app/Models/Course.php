<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $table = 'courses';
    public $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'user_id',
    ];
    public function updateTimestamp()
    {
        $this->update([
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
