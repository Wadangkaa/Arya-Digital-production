<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['title','image','body','created_by', 'updated_by'];

    //Relation with user
    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
