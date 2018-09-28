<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Empleado extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'empleados';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'cedula',
        'nombres',
        'apellidos',
        'direccion',
        'correo'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    /**protected $hidden = [
        'password',
    ];
    **/
}
