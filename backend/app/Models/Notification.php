<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    public const UPDATED_AT = null;
    protected $fillable = ['user_id', 'titre', 'message', 'lu'];
    protected function casts(): array { return ['lu' => 'boolean']; }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
