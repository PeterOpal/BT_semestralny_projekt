<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stage extends Model
{
    use HasFactory;
    protected $table = 'stages';
    protected $fillable = ["name", "datum", "kapacita"];

    public function stagePrograms(): HasMany
    {
        return $this->hasMany(StageProgram::class, 'stage_id');
    }
}
