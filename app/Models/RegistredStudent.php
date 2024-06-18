<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistredStudent extends Model
{
    use HasFactory;
    protected $table = 'registred_students';
    protected $fillable = ['id','meno','priezvisko', 'mail', 'skola', 'token', 'activated'];
}
