<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    /**
     * Define a "belongsTo" relationship between this model and the Country model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        // Use the "belongsTo" method to create the relationship.
        // Pass in the Country model class as the argument.
        // This will tell Laravel that this model "belongs to" a Country.
        // Laravel will use this information to automatically generate SQL queries
        // to retrieve data from both tables (this model's table and the Country table).
        return $this->belongsTo(Country::class);
    }

    /**
     * Define a one-to-many relationship.
     *
     * This method returns a new instance of the
     * `Illuminate\Database\Eloquent\Relations\HasMany` class, which is used to 
     * define a one-to-many relationship between two database tables.
     *
     * @param  string  $related
     * @param  string|null  $foreignKey
     * @param  string|null  $localKey
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        // Use the `hasMany` method of the current model instance to define a
        // one-to-many relationship with the `City` model. The `hasMany` method
        // returns a new instance of the `Illuminate\Database\Eloquent\Relations\HasMany`
        // class, which can be used to further customize the relationship.
        return $this->hasMany(City::class);
    }
}
