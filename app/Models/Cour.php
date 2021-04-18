<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Cour extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'intitule',
        'user_id'
    ];

    public static function cours_formation(){
        $cours = DB::table('formations')
            ->join('users', 'formations.id', '=', 'users.formation_id')
            ->join('cours', 'formations.id', '=', 'cours.formation_id')
            ->select('cours.*')
            ->paginate(4);
        return $cours;
    }
    

    /**
     * Get the cour that owns the formation.
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    /**
     * Get the cour that owns the plannings.
     */
    public function plannings()
    {
        return $this->hasMany(Planning::class, 'cours_id');
    }

    /**
     * Get the user that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The user that belong to the cours.
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'cours_users', 'cours_id', 'user_id');
    }
}
