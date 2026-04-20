<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCv extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'cv_data',
    ];

    protected $casts = [
        'cv_data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
