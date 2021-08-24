<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endtime extends Model
{
    use HasFactory;

    /**
     * Get the appointment for this time record.
     */
    public function date()
    {
        return $this->hasOne(Date::class);
    }
}
