<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

     /**
     * * The Relationship from Role to User
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
