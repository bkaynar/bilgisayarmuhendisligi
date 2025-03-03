<?php

namespace App\Models;
use App\Traits\HasTranslations;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mufredat extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'mufredat';

    protected $fillable = [
        'dosya_yolu',
        'silindi',
    ];


    public function getAd(?string $locale = null): ?string
    {
        return $this->getTranslated('adi', $locale);
    }

    public function translations()
    {
        return $this->hasMany(MufredatTranslation::class);
    }

    public function getTranslation($locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }

    public function scopeActive($query)
    {
        return $query->where('silindi', 0);
    }
}
