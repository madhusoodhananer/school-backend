<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    /**
     * Define a one-to-many relationship.
     *
     * This function returns an instance of the HasMany class, which represents a one-to-many relationship in Laravel.
     *
     * @param  string  $related
     * @param  string|null  $foreignKey
     * @param  string|null  $localKey
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states()
    {
        // This function returns a HasMany instance, which represents a one-to-many relationship between this model and the State model.
        return $this->hasMany(State::class);
    }
}
