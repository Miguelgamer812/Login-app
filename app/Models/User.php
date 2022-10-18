<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Para que un mutteitor funcione usamos la siguente sintaxis setNombre(Nombre del atributo que quiero modificar)Attribute
    public function setPaswordAttribute($value){ //El valor que nosotros ingresemos es el que se va a guardar en el campo password de la base de datos
        $this->attributes['password']= bcrypt($value); //Con esto elocuent va a hacer un llamado de set attribute para que pueda aplicarle esta opereción
    }//bcript sirve para encriptar en laravel
}
