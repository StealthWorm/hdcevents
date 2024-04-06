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

    // uma diretiva que indica para o laravel que tudo que esta sendo enviado no POST do form pode ser atualizado
    // o array vazio indica que todos poderão ser alterados
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User'); // um event pertence a apenas um usuario
    }

    // retorna os usuarios que participam do evento, acessado no show.blade.php para verificar o count
    public function users()
    {
        return $this->belongsToMany('App\Models\User'); // um event pertence a vários usuarios
    }
}
