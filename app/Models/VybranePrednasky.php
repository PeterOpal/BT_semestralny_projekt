<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VybranePrednasky extends Model
{
    use HasFactory;
    protected $table = 'vybrane_prednasky';
    protected $fillable = ['student_id','prednaska_id'];
}
