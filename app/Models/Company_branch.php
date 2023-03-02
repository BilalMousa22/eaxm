<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company_branch extends Model
{
    use HasFactory ,SoftDeletes;

    public function user()
    {
        return $this->morphOne(User::class, 'actor', 'actor_type', 'actor_id', 'id');
    }

    public function compny()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

}
