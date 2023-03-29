<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'value',
        'payer_id',
        'payee_id'
    ];
    
}