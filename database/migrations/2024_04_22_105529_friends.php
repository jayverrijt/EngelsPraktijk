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
        Schema::create('friendrequest', function (Blueprint $table) {
            $table->id();
            $table->text('sender');
            $table->text('receiver');
            $table->text('status');
        });

        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->text('user1');
            $table->text('user2');
        });
        DB::table('friendrequest')->insert([
            'sender' => '0',
            'receiver' => '0',
            'status' => '2',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendrequest');
        Schema::dropIfExists('friends');
    }
};
