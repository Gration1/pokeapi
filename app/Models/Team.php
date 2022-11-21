<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property \Illuminate\Support\Collection<\App\Models\Pokemon> $pokemon
 */
class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function pokemon(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class)->withTimestamps();
    }
}
