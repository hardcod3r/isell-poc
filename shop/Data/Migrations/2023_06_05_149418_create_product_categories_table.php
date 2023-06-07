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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique(); //Category's unique name
            $table->text('description')->nullable(); //Category's description
            $table->unsignedSmallInteger('in_order')->default(0); //order in category's list . Default is 0
            $table->unsignedTinyInteger('available')->default(1); //category's availability [0=>not available , 1=> available]. Default is available
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
