<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\Permission\Traits\HasRoles;

//class User extends Model
class User extends Authenticatable
{

    use Notifiable;
    use HasRoles;

    protected $fillable = [ 
	'name', 'provider_id', 'email', 'password',

    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function addNew($input)
    {

        $check = static::where('provider_id',$input['provider_id'])->first();
        if(is_null($check)){
            return static::create($input);
        }
        return $check;
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

}
