<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tool;

class DailyToolStat extends Model
{
    protected $fillable = [
        'tool_id',
        'tool_slug',
        'date',
        'visits',
        'unique_visitors',
        'actions',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }
}