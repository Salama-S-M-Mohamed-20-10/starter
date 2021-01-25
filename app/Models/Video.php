<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "videos"; // this for if the table is not adding s only and another name
    protected $fillable = ['name','viewers','update_at']; // anything outside that don't put thing to it in database if i use
    protected $hidden = ['updated_at']; // it by that will return all without the columns that here
    public $timestamps = 'false';
}
