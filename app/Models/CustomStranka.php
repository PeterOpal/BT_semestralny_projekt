<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomStranka extends Model
{
    use HasFactory;
    protected $table="custom_stranky";
    protected $fillable = ['nazov_stranky','html_kod'];
}
