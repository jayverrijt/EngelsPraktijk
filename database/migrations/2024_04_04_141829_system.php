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
        Schema::create('system', function (Blueprint $table) {
            $table->id()->primary();
            $table->text('foreign');
            $table->text('username')->nullable();
            $table->text('phone')->nullable();
            $table->text('gender')->nullable();
            $table->text('country')->nullable();
            $table->text('city')->nullable();
            $table->text('continent')->nullable();
            $table->date('birthday')->nullable();
            $table->text('picture')->nullable();
            $table->text('about')->nullable();
        });

        DB::table('system')->insert([
            'foreign' => '1',
            'username' => 'system',
            'phone' => '1111111111',
            'gender' => 'O',
            'country' => '126',
            'city' => 'Amsterdam',
            'continent' => '4',
            'birthday' => date('Y-m-d'),
            'picture' => 'default.jpg',
            'about' => 'Build in system account',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Scheme::dropIfExists('system');
    }
};
