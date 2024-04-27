<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

	protected $fillable = [
		'number_id',
		'name',
		'last_name',
		'email',
		'password',
	];

	//se usa para los accedores (get)
	protected $appends = ['full_name'];

	protected $hidden = [
		'password',
		'remember_token',
	];

	//modificar el formato de un campo
	protected $casts = [
		'created_at' => 'datetime:Y-m-d',
		'update_at' => 'datetime:Y-m-d',
		// 'is_enable' => 'boolean' //0-1=> false - true
	];


	// accedores (get) - al realizar una consulta
	public function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}";
	}

	// mutadores (set) - antes de subír algo
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}

	public function setRememberTokenAttribute()
	{
		$this->attributes['remember_token'] =  Str::random(30);
	}

	public function customerLends()
	{
		return $this->hasMany(Lend::class, 'customer_user_id', 'id');
	}

	public function ownerLends()
	{
		return $this->hasMany(Lend::class, 'owner_user_id', 'id');
	}
}
