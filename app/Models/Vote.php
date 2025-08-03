<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'resource_id',
        'vote_type', // 'up' or 'down'
    ];

    /**
     * Get the user that owns the vote.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the resource that was voted on.
     */
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }
}
