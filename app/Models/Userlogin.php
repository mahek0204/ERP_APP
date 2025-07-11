<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
// use Spatie\Permission\Traits\HasRoles;

class Userlogin extends Authenticatable
{
    use HasRoles;

    protected $table = 'userlogin'; // if your table is not 'users'

    protected $fillable = [
        'Username',
        'email',
        'password',
        'RoleName',
    ];
}
