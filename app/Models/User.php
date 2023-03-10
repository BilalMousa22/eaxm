<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function actor()
    {
        return $this->MorphTo();
    }


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
