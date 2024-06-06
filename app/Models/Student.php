<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'name',
        'surname',
        'date_of_birth',
        'year',
        'group'
    ];

    public function assist(){

        return $this->hasMany(Assist::class);
    }



}
