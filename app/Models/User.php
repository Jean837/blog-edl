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

    // Vérifie si l'utilisateur est admin
    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    // Vérifie si l'utilisateur est simple user
    public function isUser(): bool {
        return $this->role === 'user';
    }
}