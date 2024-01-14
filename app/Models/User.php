<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'Total_Space' , 'Remaining_Space'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //user has one company profile and the profile belongs to one user
    public function profile(){
        return $this->hasOne(Company_Profile::class);
    }


    //user has many folders
    public function folders(){
        return $this->hasMany(Folder::class , 'user_id');
    }

    //user has may files
    public function files(){
        return $this->hasMany(File::class , 'user_id');
    }

    //user has many case studies
    public function case_studies(){
        return $this->hasMany(Case_Study::class , 'user_id');
    }

    //user can leave more than one review about the agency
    public function reviews(){
        return $this->hasMany(Review::class , 'user_id');
    }

}
