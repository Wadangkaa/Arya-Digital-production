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
        'name',
        'email',
        'password',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //creating relation with blog
    public function blog(){
        return $this->hasMany(Blog::class,'created_by');
    }
     //creating relation with event
     public function event(){
        return $this->hasMany(Blog::class,'created_by');
    }
     //creating relation with feature
     public function feature(){
        return $this->hasMany(Blog::class,'created_by');
    }
     //creating relation with portfolio
     public function portfolio(){
        return $this->hasMany(Blog::class,'created_by');
    }
     //creating relation with service
     public function service(){
        return $this->hasMany(Blog::class,'created_by');
    }
}
