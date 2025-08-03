<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resource extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'course_name',
        'file_path',
        'upvote_count',
    ];

    /**
     * Get the user that owns the resource.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the votes for the resource.
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get the upvotes for the resource.
     */
    public function upvotes(): HasMany
    {
        return $this->hasMany(Vote::class)->where('vote_type', 'up');
    }

    /**
     * Get the downvotes for the resource.
     */
    public function downvotes(): HasMany
    {
        return $this->hasMany(Vote::class)->where('vote_type', 'down');
    }

    /**
     * Get the vote score (upvotes - downvotes).
     */
    public function getVoteScoreAttribute(): int
    {
        return $this->upvotes()->count() - $this->downvotes()->count();
    }

    /**
     * Check if a user has voted on this resource.
     */
    public function getUserVoteAttribute()
    {
        if (!auth()->check()) {
            return null;
        }

        return $this->votes()->where('user_id', auth()->id())->first()?->vote_type;
    }

    /**
     * Update the cached upvote count.
     */
    public function updateUpvoteCount(): void
    {
        $this->update([
            'upvote_count' => $this->upvotes()->count()
        ]);
    }
}