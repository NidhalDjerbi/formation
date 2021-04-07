<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourUser extends Model
{
    use HasFactory;
    protected $table = 'cours_users';
    protected $fillable = [
        'cours_id',
        'user_id'
    ];
}
