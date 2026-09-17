<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tache extends Model
{
    use HasFactory;
    protected $table = 'taches';
    protected $fillable = ['titre', 'description', 'frequence'];
    public function assignations(): HasMany { return $this->hasMany(AssignationTache::class, 'tache_id'); }
}
