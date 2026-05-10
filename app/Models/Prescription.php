<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    /**
     * Mass assignable fields.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'user_id',
        'note',
        'delivery_address',
        'delivery_time',
        'status',

    ];

    /**
     * User relationship.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class
        );
    }

    /**
     * Prescription images relationship.
     */
    public function images(): HasMany
    {
        return $this->hasMany(
            PrescriptionImage::class
        );
    }

    /**
     * Quotation relationship.
     */
    public function quotation(): HasOne
    {
        return $this->hasOne(
            Quotation::class
        );
    }
}