<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etkinlik extends Model
{
    use HasFactory;

    protected $table = 'etkinlikler';

    protected $fillable = [
        'etkinlik_baslik',
        'etkinlik_icerik',
        'etkinlik_text',
        'etkinlik_tarih',
        'etkinlik_resim',
    ];

    public function translations()
    {
        return $this->hasMany(EtkinlikTranslation::class);
    }

    public function getTranslation($locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }
}
