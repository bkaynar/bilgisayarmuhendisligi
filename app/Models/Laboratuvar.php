<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laboratuvar extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'laboratuvar';
    protected $primaryKey = 'lab_id'; // Use lab_id as the primary key

    protected $fillable = [
        'lab_resim',
        'silindi'
    ];

    protected $attributes = [
        'silindi' => 0,
    ];

    // Translation model class
    protected string $translationModel = LaboratuvarTranslation::class;

    public function translations()
    {
        return $this->hasMany(LaboratuvarTranslation::class, 'lab_id', 'lab_id');
    }


    // Foreign key reference for translations
    protected string $translationForeignKey = 'lab_id';

    public function getLabAd(?string $locale = null): ?string
    {
        return $this->getTranslated('lab_ad', $locale);
    }

    public function getLabAciklama(?string $locale = null): ?string
    {
        return $this->getTranslated('lab_aciklama', $locale);
    }

    public function scopeActive($query)
    {
        return $query->where('silindi', 0);
    }
}
