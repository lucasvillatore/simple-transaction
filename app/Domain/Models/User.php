<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        "name",
        "taxpayer_id",
        "email",
        "password",
        "type",
        "balance"
    ];
    
}