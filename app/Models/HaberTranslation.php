<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HaberTranslation extends Model
{
    use HasFactory;

    protected $table = 'haberler_translations';

    protected $fillable = [
        'haber_id',
        'locale',
        'haber_baslik',
        'haber_icerik',
    ];

    public function haber()
    {
        return $this->belongsTo(Haber::class);
    }
}
