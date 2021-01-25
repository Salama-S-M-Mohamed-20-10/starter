<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers"; // this for if the table is not adding s only and another name
    protected $fillable = ['name_ar','name_en','photo','price','details_ar','details_en','created_at','updated_at']; // anything outside that don't put thing to it in database if i use
    protected $hidden = ['created_at','updated_at']; // it by that will return all without the columns that here
    // public $timestamp = false; don't work with me that make laravel don't able to add time in created_at and updated_at by default he make it after that true and make it with comment as it is default true
}
