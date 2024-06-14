<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Speakers extends Model
{
    use HasFactory;
    protected $table = 'speakers';

    protected $fillable = ["meno", "photo", "kratky_popis", "dlhy_popis", "company_name", "company_link", "headliner", "facebook_link", "twitter_link", "web_link"];

    public function stagePrograms(): HasOne
    {
        return $this->hasOne(StageProgram::class, 'speaker_id');
    }
}
