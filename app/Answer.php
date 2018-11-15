<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function users() {
        return $this->belongsTo(User::class);
    }
}
