<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';
    // define que o tipo do dado items que vem do forms será um array
    protected $casts = [
        'items' => 'array'
    ];
    // a data vai vir do form também, porem precisamos especificar que será um dateTime
    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo('App\Models\User'); // um event pertence a apenas um usuario
    }
}
