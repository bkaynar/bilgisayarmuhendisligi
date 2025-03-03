<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HakkimizdaTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hakkimizda_id',
        'locale',
        'icerik',
        'baslik',
        'meta_aciklama',
    ];

    /**
     * Bu çevirinin ait olduğu hakkımızda
     */
    public function hakkimizda(): BelongsTo
    {
        return $this->belongsTo(Hakkimizda::class);
    }
}
