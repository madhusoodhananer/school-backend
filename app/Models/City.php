<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * Define a public function named 'state'.
     * This function returns an instance of the 'belongsTo' relationship with the 'State' model class.
     * The 'belongsTo' relationship defines a one-to-many relationship between this model and the 'State' model.
     * The 'class' method is used to get the fully qualified class name of the related model.
     * The 'belongsTo' relationship indicates that this model belongs to a single instance of the 'State' model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
