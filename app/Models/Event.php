<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_type_id',
        'start_time',
        'finish_time',
        'comments',
    ];
    protected $casts = [
        'start_time' => 'datetime',
        'finish_time' => 'datetime',
    ];

    public function type(): HasOne
    {
        return $this->hasOne(EventType::class, 'id', 'event_type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
