<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class EtkinlikTranslation extends Model
    {
        use HasFactory;

        protected $table = 'etkinlikler_translations';

        protected $fillable = [
            'etkinlik_id',
            'locale',
            'etkinlik_baslik',
            'etkinlik_icerik',
            'etkinlik_text',
        ];

        public function etkinlik()
        {
            return $this->belongsTo(Etkinlik::class);
        }
    }
