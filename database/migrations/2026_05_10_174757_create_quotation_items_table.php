<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations.
     */
    public function up(): void
    {
        Schema::create(
            'quotation_items',
            function (Blueprint $table) {

                $table->id();

                $table->foreignId('quotation_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->string('drug_name');

                $table->integer('quantity');

                $table->decimal(
                    'unit_price',
                    10,
                    2
                );

                $table->decimal(
                    'total_amount',
                    10,
                    2
                );

                $table->timestamps();

            }
        );
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'quotation_items'
        );
    }
};