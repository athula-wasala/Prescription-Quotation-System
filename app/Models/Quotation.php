<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    /**
     * Mass assignable fields.
     */
    protected $fillable = [

        'prescription_id',
        'total_amount',
        'status',

    ];

    /**
     * Prescription relationship.
     */
    public function prescription(): BelongsTo
    {
        return $this->belongsTo(
            Prescription::class
        );
    }

    /**
     * Quotation items relationship.
     */
    public function items(): HasMany
    {
        return $this->hasMany(
            QuotationItem::class
        );
    }
}