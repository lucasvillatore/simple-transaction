<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'message',
        'status',
        'user_id'
    ];
    
}