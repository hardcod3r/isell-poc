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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('stripe_id')->after('last_name')->nullable()->index();
            $table->string('pm_type')->after('stripe_id')->nullable();
            $table->string('pm_last_four', 4)->after('pm_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'stripe_id',
                'pm_type',
                'pm_last_four'
            ]);
        });
    }
};
