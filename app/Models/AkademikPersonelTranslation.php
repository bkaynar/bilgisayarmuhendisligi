<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class AkademikPersonelTranslation extends Model
    {
        use HasFactory;

        protected $fillable = [
            'akademik_personel_id',
            'locale',
            'personel_unvan', // Added
            'personel_gorev', // Added
            'personel_fakulte',
            'personel_bolum',
            'personel_hakkinda',
        ];

        public function akademikPersonel(): BelongsTo
        {
            return $this->belongsTo(AkademikPersonel::class);
        }
    }
