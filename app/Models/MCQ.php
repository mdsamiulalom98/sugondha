<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCQ extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->hasOne(mcqSubject::class, 'id', 'subject_id')->select('id', 'name', 'slug');
    }
    public function topic()
    {
        return $this->hasOne(mcqTopic::class, 'id', 'topic_id')->select('id', 'name', 'slug');
    }
}
