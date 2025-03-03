<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaboratuvarTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lab_id',
        'locale',
        'lab_ad',
        'lab_aciklama',
    ];

    /**
     * Get the laboratory that owns this translation
     */
    public function laboratuvar(): BelongsTo
    {
        return $this->belongsTo(Laboratuvar::class, 'lab_id', 'lab_id');
    }

}
