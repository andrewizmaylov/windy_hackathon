<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prompt extends Model
{
    protected $fillable = [
		'text', 'type', 'user_id', 'default'
    ];

	protected $casts = [
		'default' => 'boolean'
	];

	public static function default()
	{
		return self::where('default', 1)->first()->text;
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
