<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    /**
     * Get the user that owns the resource.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}