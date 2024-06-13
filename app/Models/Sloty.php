<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sloty extends Model
{
    use HasFactory;
    protected $table = 'casove_sloty';
    protected $fillable = ['od','do'];

    public function stagePrograms(): HasOne
    {
        return $this->hasOne(StageProgram::class, 'cas');
    }
}
