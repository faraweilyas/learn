<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    public function complete() : bool
    {
        $this->completed = true;
        return $this->save();
    }
}
