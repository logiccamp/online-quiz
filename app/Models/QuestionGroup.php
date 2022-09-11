<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionGroup extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function questions(){
        return $this->hasMany(Question::class, "group_id", "id");
    }

    public function category(){
        return $this->hasOne(Category::class, "id", "category_id");
    }
}
