<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MufredatTranslation extends Model
{
    use HasFactory;

    protected $table = 'mufredat_translations';

    protected $fillable = [
        'mufredat_id',
        'locale',
        'adi',
    ];

    public function mufredat()
    {
        return $this->belongsTo(Mufredat::class);
    }

}
