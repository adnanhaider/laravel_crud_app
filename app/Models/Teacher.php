<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use Illuminate\Foundation\Auth\User;
use Faker\Provider\PhoneNumber;

class Teacher extends Model{

    use HasFactory;
    protected $fillable = [
        'user_id',
        'f_name',
        'l_name',
        // 'phoneNumbers_id',
        'dob',
    ];

    // public function courses(){
    //     return $this->belongsToMany(Course::class);
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function phoneNumbers(){
    //     return $this->hasMany(PhoneNumber::class);
    // }
    
}
