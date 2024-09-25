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
        Schema::create('notification-settings', function (Blueprint $table) {
            $table->id()->primary();
            $table->text('foreign');
            // New Friend Request
            $table->integer('nfr')->default(1);
            // New Borrow Request
            $table->integer('nbr')->default(1);
            // New Sale Request
            $table->integer('nsr')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::DropIfExists('notification-settings');
    }
};
