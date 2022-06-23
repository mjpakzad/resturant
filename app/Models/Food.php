<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

	protected $fillable = [
		'heading',
		'slug',
		'stock',
		'price',
		'preparation_time',
		'history',
	];

    protected $casts = [
        'stock'             => 'integer',
        'price'             => 'integer',
        'preparation_time'  => 'integer',
    ];

	public function getRouteKeyName() {
		return 'slug';
	}
}
