<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hakkimizda extends Model
{
    use HasFactory, HasTranslations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hakkimizda';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'silindi'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'silindi' => 0,
    ];

    /**
     * Çeviri model sınıfı
     */
    protected string $translationModel = HakkimizdaTranslation::class;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false; // Eğer tabloda timestamps kolonları yoksa

    /**
     * İçeriği getir
     */
    public function getIcerik(?string $locale = null): ?string
    {
        return $this->getTranslated('icerik', $locale);
    }

    /**
     * Başlığı getir
     */
    public function getBaslik(?string $locale = null): ?string
    {
        return $this->getTranslated('baslik', $locale);
    }

    /**
     * Meta açıklamayı getir
     */
    public function getMetaAciklama(?string $locale = null): ?string
    {
        return $this->getTranslated('meta_aciklama', $locale);
    }

    /**
     * Scope a query to only include active records.
     */
    public function scopeActive($query)
    {
        return $query->where('silindi', 0);
    }
}
