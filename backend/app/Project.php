<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Eloquent\Uploadable;

class Project extends Model
{
	use Uploadable;
    protected $fillable = [
        'title', 'text', 'user', 'themes', 'contacts',
    ];
    protected $casts = [
        'themes' => 'array',
        'contacts'=>'array'
    ];
}
