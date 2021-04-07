<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'intitule'
    ];


    /**
     * Get the user that owns the formation.
     */
    public function user()
    {
        return $this->belongsTo(Formation::class);
    }
}
