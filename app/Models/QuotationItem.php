<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationItem extends Model
{
    /**
     * Mass assignable fields.
     */
    protected $fillable = [

        'quotation_id',
        'drug_name',
        'quantity',
        'unit_price',
        'total_amount',

    ];

    /**
     * Quotation relationship.
     */
    public function quotation(): BelongsTo
    {
        return $this->belongsTo(
            Quotation::class
        );
    }
}