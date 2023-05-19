<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['file_name','file_path','fileable_id','fileable_type'];

    CONST USER_PROFILE_PHOTO = 1;
    
    /**
     * Get the owning filable model.
     */
    public function filable()
    {
        //Returns the polymorphic relationship
        return $this->morphTo();
    }
}
