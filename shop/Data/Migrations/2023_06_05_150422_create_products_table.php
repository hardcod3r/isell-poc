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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_categories_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();  //related product category
            $table->string('name'); //Product's name
            $table->text('description')->nullable(); //Category's description
            $table->unsignedSmallInteger('in_order')->default(0); //order in product's list . Default is 0
            $table->unsignedTinyInteger('available')->default(1); //product's availability [0=>not available , 1=> available]. Default is available
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
