<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
