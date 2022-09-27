<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'quizze_id',
    ];
    public function answer(){
        return $this->hasOne(Answer::class,'question_id');
    }
}
