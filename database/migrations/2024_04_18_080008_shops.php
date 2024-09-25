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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->text('type');
            $table->text('name');
            $table->text('picture')->nullable();
            $table->text('url');
            $table->text('continent');
        });
        Schema::create('pref-shops', function (Blueprint $table) {
            $table->id();
            $table->text('foreign');
            // S = Care F = Fashion A = Accessories
            $table->text('s1')->nullable();
            $table->text('s2')->nullable();
            $table->text('s3')->nullable();
            $table->text('s4')->nullable();
            $table->text('s5')->nullable();
            $table->text('f1')->nullable();
            $table->text('f2')->nullable();
            $table->text('f3')->nullable();
            $table->text('f4')->nullable();
            $table->text('f5')->nullable();
            $table->text('a1')->nullable();
            $table->text('a2')->nullable();
            $table->text('a3')->nullable();
            $table->text('a4')->nullable();
            $table->text('a5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
        Schema::dropIfExists('pref-shops');
    }
};
