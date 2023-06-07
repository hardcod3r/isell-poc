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
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('customer_id')->constrained();  //related product model
            $table->string('name', 255)->nullable(); //friendly name ex. home, office , optional
            $table->string('address')->unique(); // full address desription by google api
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
