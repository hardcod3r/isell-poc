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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->morphs('contactable'); // user model & customer model
            $table->string('name', 255)->nullable(); //friendly name ex. home, office
            $table->unsignedTinyInteger('phone_type')->default(0); // mobile or home phone. default home phone. todo static enum class
            $table->string('phone', 91)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
