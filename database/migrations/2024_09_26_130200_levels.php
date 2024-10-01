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
        //
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('level_name');
            $table->timestamps();
        });

        \DB::table('levels')->insert([
            ['level_name' => 'A1'],
            ['level_name' => 'A2'],
            ['level_name' => 'B1'],
            ['level_name' => 'B2'],
            ['level_name' => 'C1'],
            ['level_name' => 'C2'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('levels');
    }
};
