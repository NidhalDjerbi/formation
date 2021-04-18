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
    public function users()
    {
        return $this->hasMany(Formation::class);
    }

    /**
     * Get the cours for the blog post.
     */
    public function cours()
    {
        return $this->hasMany(Cour::class);
    }
}
