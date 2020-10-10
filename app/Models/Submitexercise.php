<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submitexercise extends Model
{
    use HasFactory;
    public function user() {
        return $this -> belongsTo('App\Models\User', 'student_id');
    }
}
