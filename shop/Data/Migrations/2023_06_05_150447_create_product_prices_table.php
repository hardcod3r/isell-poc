<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();  //related product id
            $table->unsignedInteger('price'); //Always integer price in cents in order to have slight errors in our floating point numbers
            $table->unsignedTinyInteger('is_taxable')->default(1); // whether must add tax or not
            $table->unsignedTinyInteger('is_current')->default(0); // whether is current price or not. Models may have more than one prices.
            $table->unsignedTinyInteger('is_archived')->default(0); // whether is archived or not.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
