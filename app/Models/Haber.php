<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Haber extends Model
{
    use HasFactory;

    protected $table = 'haberler';

    protected $fillable = [
        'yayin_tarihi',
        'haber_resim',
    ];

    public function translations()
    {
        return $this->hasMany(HaberTranslation::class);
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
