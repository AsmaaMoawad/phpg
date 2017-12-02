<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
	protected $fillable = ['latitude', 'longitude'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
