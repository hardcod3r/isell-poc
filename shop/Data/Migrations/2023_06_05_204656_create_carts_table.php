<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->uuid('signature')->index('signature'); //unique cart signature
            $table->foreignId('product_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();  //related product model
            $table->foreignId('product_price_id')->constrained();  //related price model. Price model lose the edit/delete ability after this.
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->unsignedInteger('total')->nullable();
            $table->timestamps();
            $table->softDeletes(); //soft delete here is useful for various reports
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
