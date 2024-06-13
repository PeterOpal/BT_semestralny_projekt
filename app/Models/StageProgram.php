<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class StageProgram extends Model
{
    use HasFactory;
    protected $table = 'stage_programs';
    protected $fillable = ["cas", "nazov_prednasky", "popis", "stage_id", "speaker_id"];

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speakers::class, 'speaker_id');
    }

    public function sloty(): BelongsTo
    {
        return $this->belongsTo(Sloty::class, 'cas');
    }
}
