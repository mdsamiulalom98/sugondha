<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mcqTopic extends Model
{
    protected $guarded = [];
     public function subject()
    {
        return $this->hasOne(mcqSubject::class, 'id', 'subject_id')->select('id', 'name', 'slug');
    }
}
