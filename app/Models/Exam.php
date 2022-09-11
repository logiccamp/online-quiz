<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ExamSession(){
        return $this->hasMany(ExamSession::class, "exam_id", "id");
    }

    public function Student(){
        return $this->belongsTo(User::class, "student_id", "id");
    }
}
