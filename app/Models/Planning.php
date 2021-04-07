<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_debut',
        'date_fin'
    ];

    /**
     * Get the cour that owns the comment.
     */
    public function cour()
    {
        return $this->belongsTo(Cour::class);
    }
}
