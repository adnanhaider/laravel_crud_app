<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;

use Faker\Provider\PhoneNumber;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'f_name',
        'l_name',
        // 'phoneNumbers',
        'dob',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }


    // public function phoneNumbers()
    // {
    //     return $this->hasMany(PhoneNumber::class);
    // }

    // public static function updateData($email=null, $data){
    //     DB::table('student')->where('email', $email)->update($data);
    // }

    public static function deleteData($id){
        DB::table('student')->where('id', '=', $id)->delete();
    }
}
