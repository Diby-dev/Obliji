<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_MENAGER = 'menager';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'role'];
    protected $hidden = ['password'];
    protected function casts(): array { return ['password' => 'hashed']; }
    public function isAdmin(): bool { return $this->role === self::ROLE_ADMIN; }
    public function isMenager(): bool { return $this->role === self::ROLE_MENAGER; }
    public function nomComplet(): string { return trim("{$this->prenom} {$this->nom}"); }
    public function assignationsMenager(): HasMany { return $this->hasMany(AssignationTache::class, 'menager_id'); }
    public function assignationsAdmin(): HasMany { return $this->hasMany(AssignationTache::class, 'admin_id'); }
    public function notifications(): HasMany { return $this->hasMany(Notification::class); }
}
