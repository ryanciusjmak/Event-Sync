<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'city', 'private', 'image', 'items', 'date'
    ];
    

    // Outros métodos do modelo aqui...
    protected $casts = [
        'items' => 'array'
    ];

    // tudo que for enviado pelo method post  pode ser atualizado
    protected $guarded = []; 

    protected $dates = ['date'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
