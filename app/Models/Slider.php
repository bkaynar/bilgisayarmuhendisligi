<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'slider';

    protected $fillable = [
        'slider_url',
        'slider_link',
    ];

    protected string $translationModel = SliderTranslation::class;

    public function getUstmetin(?string $locale = null): ?string
    {
        return $this->getTranslated('slider_ustmetin', $locale);
    }

    public function getAltmetin(?string $locale = null): ?string
    {
        return $this->getTranslated('slider_altmetin', $locale);
    }
}
