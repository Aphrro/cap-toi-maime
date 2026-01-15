<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->user_type === 'admin' || $this->hasRole('admin');
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
        'phone',
        'user_type',
        'is_active',
        'suspended_at',
        'suspension_reason',
        'member_status',
        'member_approved_at',
        'member_rejection_reason',
        'association_member_id',
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
            'is_active' => 'boolean',
            'suspended_at' => 'datetime',
            'member_approved_at' => 'datetime',
        ];
    }

    public function isMember(): bool
    {
        return $this->member_status === 'approved';
    }

    public function isPendingMember(): bool
    {
        return $this->member_status === 'pending';
    }

    public function approveMembership(): void
    {
        $this->update([
            'member_status' => 'approved',
            'member_approved_at' => now(),
            'member_rejection_reason' => null,
        ]);
    }

    public function rejectMembership(string $reason): void
    {
        $this->update([
            'member_status' => 'rejected',
            'member_rejection_reason' => $reason,
        ]);
    }

    public function parentProfile(): HasOne
    {
        return $this->hasOne(ParentProfile::class);
    }

    public function professional(): HasOne
    {
        return $this->hasOne(Professional::class);
    }

    public function preferences(): HasOne
    {
        return $this->hasOne(UserPreference::class);
    }

    public function isParent(): bool
    {
        return $this->user_type === 'parent';
    }

    public function isProfessional(): bool
    {
        return $this->user_type === 'professional';
    }

    public function isAdmin(): bool
    {
        return $this->user_type === 'admin' || $this->hasRole('admin');
    }

    public function isSuspended(): bool
    {
        return $this->suspended_at !== null;
    }

    public function suspend(?string $reason = null): void
    {
        $this->update([
            'suspended_at' => now(),
            'suspension_reason' => $reason,
            'is_active' => false,
        ]);
    }

    public function unsuspend(): void
    {
        $this->update([
            'suspended_at' => null,
            'suspension_reason' => null,
            'is_active' => true,
        ]);
    }
}
