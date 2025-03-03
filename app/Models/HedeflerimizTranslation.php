<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HedeflerimizTranslation extends Model
{
    use HasFactory;

    protected $table = 'hedeflerimiz_translations';

    protected $fillable = [
        'hedeflerimiz_id',
        'locale',
        'hedef_icerik',
        'hedef_baslik',
    ];

    public function hedeflerimiz()
    {
        return $this->belongsTo(Hedeflerimiz::class);
    }
}
