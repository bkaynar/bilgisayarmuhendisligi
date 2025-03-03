<?php

    namespace App\Models;

    use App\Traits\HasTranslations;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Hedeflerimiz extends Model
    {
        use HasFactory,HasTranslations;

        protected $table = 'hedeflerimiz';

        protected $fillable = [
            // Add any fillable attributes if needed
        ];

        public function translations()
        {
            return $this->hasMany(HedeflerimizTranslation::class);
        }

        public function getTranslation($locale)
        {
            return $this->translations()->where('locale', $locale)->first();
        }

        public function scopeActive($query)
        {
        }
    }
