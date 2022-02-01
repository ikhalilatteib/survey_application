<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['survey_id','type','question','data','description'];

    public function survey():BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }
}
