<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

trait HasTranslations
{
    /**
     * Model için mevcut olan çevirileri döndürür
     */
    public function translations(): HasMany
    {
        return $this->hasMany($this->getTranslationModel(), $this->getForeignKey());
    }

    /**
     * Belirli bir dildeki çeviriyi döndürür
     */
    public function translation(?string $locale = null): ?Model
    {
        if ($locale === null) {
            $locale = app()->getLocale();
        }

        // Önbelleğe alınmış çevirileri kullan
        if ($this->relationLoaded('translations')) {
            return $this->translations->firstWhere('locale', $locale) ??
                $this->translations->firstWhere('locale', config('app.fallback_locale'));
        }

        // İlgili dilde çeviri yoksa
        return $this->translations()
            ->where('locale', $locale)
            ->first() ??
            $this->translations()
                ->where('locale', config('app.fallback_locale'))
                ->first();
    }

    /**
     * İlgili çeviri modelini döndürür
     */
    protected function getTranslationModel(): string
    {
        return $this->translationModel;
    }

    /**
     * Foreign key adını döndürür
     *
     * Not: Bu metod, Laravel'in Model sınıfındaki getForeignKey() metodunu
     * override ettiğinden public olmalı
     */
    public function getForeignKey(): string
    {
        return $this->foreignKey ?? $this->getTable() . '_id';
    }

    /**
     * Çevirilebilir bir alanın değerini döndürür
     */
    public function getTranslated(string $attribute, ?string $locale = null): ?string
    {
        return $this->translation($locale)?->{$attribute};
    }

    /**
     * Yeni bir çeviri ekler veya günceller
     */
    public function saveTranslation(string $locale, array $attributes): Model
    {
        $translation = $this->translations()->firstOrNew(['locale' => $locale]);
        $translation->fill($attributes);
        $translation->save();

        $this->load('translations'); // İlişkiyi yenile

        return $translation;
    }
}
