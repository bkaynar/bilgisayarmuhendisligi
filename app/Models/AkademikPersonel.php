<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AkademikPersonel extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'akademik_personel';

    protected $fillable = [
        'personel_isim_soyisim', // Added here
        'personel_img',
        'personel_telefon',
        'personel_email',
        'silindi',
    ];

    protected $attributes = [
        'silindi' => 0,
    ];

    protected string $translationModel = AkademikPersonelTranslation::class;

    public function getUnvan(?string $locale = null): ?string
    {
        return $this->getTranslated('personel_unvan', $locale);
    }

    public function getGorev(?string $locale = null): ?string
    {
        return $this->getTranslated('personel_gorev', $locale);
    }

    public function getFakulte(?string $locale = null): ?string
    {
        return $this->getTranslated('personel_fakulte', $locale);
    }

    public function getBolum(?string $locale = null): ?string
    {
        return $this->getTranslated('personel_bolum', $locale);
    }

    public function getHakkinda(?string $locale = null): ?string
    {
        return $this->getTranslated('personel_hakkinda', $locale);
    }


    public function scopeActive($query)
    {
        return $query->where('silindi', 0);
    }
}
