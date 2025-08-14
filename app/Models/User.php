<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;



class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->email, ['islam15-5725@diu.edu.bd', 'billah15-6002@diu.edu.bd']) && $this->hasVerifiedEmail();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department',
        'google_id',
        'contribution_point',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the votes for the user.
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get the resources for the user.
     */
    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * Update the user's contribution points based on upvotes received.
     */
    public function updateContributionPoints(): void
    {
        $contributionPoints = $this->resources()->sum('upvote_count');
        $this->update(['contribution_point' => $contributionPoints]);
    }
}
