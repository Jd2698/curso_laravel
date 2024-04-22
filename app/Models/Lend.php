<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lend extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'customer_user_id',
		'owner_user_id',
		'book_id',
		'date_out',
		'date_in',
		'status'
	];

	public function customer()
	{
		return $this->belongsTo(User::class, 'customer_user_id', 'id');
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_user_id', 'id');
	}

	public function book()
	{
		return $this->belongsTo(Book::class, 'book_id', 'id');
	}
}
