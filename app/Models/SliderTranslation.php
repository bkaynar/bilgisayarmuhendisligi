<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliderTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'slider_id',
        'locale',
        'slider_ustmetin',
        'slider_altmetin',
    ];

    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }
}
