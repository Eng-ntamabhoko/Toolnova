<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ToolUsageLog extends Model
{
    protected $fillable = [
        'user_id',
        'tool_id',
        'tool_slug',
        'session_id',
        'ip_address',
        'country',
        'city',
        'browser',
        'device',
        'os',
        'referrer',
        'landing_page',
        'page_url',
        'action_type',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tool()
    {
        return $this->belongsTo(\App\Models\Tool::class, 'tool_id');
    }
}