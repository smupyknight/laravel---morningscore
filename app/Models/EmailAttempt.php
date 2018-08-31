<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailAttempt extends Model
{

	protected $fillable = [
		'user_id',
		'mailable_class',
	];

    /*
     -------------------------------
     Relationships
     -------------------------------
     */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
