<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table='role';

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
