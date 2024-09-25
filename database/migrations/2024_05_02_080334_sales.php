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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->text('foreign');
            $table->text('name');
            $table->text('description');
            $table->text('type'); // Can be 1 for Head Accesories, 2 for Top, 3 for Pants, 4 for Shoes
            $table->text('size');
            $table->text('picture');
            $table->text('owner');
            $table->text('price');
            $table->text('province');
            $table->text('status'); // 1 for available for Sold 2
        });

        Schema::create('sold', function (Blueprint $table) {
            $table->id();
            $table->text('foreign');
            $table->text('buyer');
            $table->text('status'); // 1 for Pending 2 for Sold NULL for Available
            $table->text('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
