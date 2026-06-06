<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'verification_code',
        'is_verified',
        'verification_code_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'email_verified_at'            => 'datetime',
            'password'                     => 'hashed',
            'is_verified'                  => 'boolean',
            'verification_code_expires_at' => 'datetime',
        ];
    }

    public function isAdmin(): bool {
        return in_array($this->role, ['admin', 'named_admin']);
    }

    public function isNamedAdmin(): bool {
        return $this->role === 'named_admin';
    }

    public function isSuperAdmin(): bool {
        return $this->role === 'admin';
    }

    public function isUser(): bool {
        return $this->role === 'user';
    }

    public function getRoleBadge(): string {
        return match($this->role) {
            'admin'       => 'Super Administrateur',
            'named_admin' => 'Administrateur nommé',
            default       => '',
        };
    }
}