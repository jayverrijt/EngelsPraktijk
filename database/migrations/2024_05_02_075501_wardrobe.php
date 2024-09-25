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
        Schema::create('clothes', function (Blueprint $table) {
            $table->id();
            $table->text('foreign');
            $table->text('secid'); // Unique ID for each clothing item per type for each user
            $table->text('name');
            $table->text('type'); // Can be 1 for Head Accesories, 2 for Top, 3 for Pants, 4 for Shoes
            $table->text('size');
            $table->text('color');
            $table->text('picture');
        });

        Schema::create('borrowlist', function (Blueprint $table) {
            $table->id();
            $table->text('owner');
            $table->text('lender');
            $table->text('status'); // 1 for Pending 2 for Accepted NULL for Available/Rejected
            $table->text('product');
            $table->date('borrow_start');
            $table->date('borrow_end');
        });
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->text('foreign');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('accessories')->nullable();
            $table->text('top')->nullable();
            $table->text('pants')->nullable();
            $table->text('shoes')->nullable();
        });
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->text('dispname');
            $table->text('color');
            $table->text('hex');
        });

        Schema::create('borrowext', function (Blueprint $table) {
            $table->id();
            $table->text('foreign');
            $table->text('text')->nullable();
            $table->date('date');
            $table->text('owner');
        });


        DB::table('colors')->insert([
            ['dispname' => 'Black', 'color' => 'black', 'hex' => '#000000'],
            ['dispname' => 'White', 'color' => 'white', 'hex' => '#F0ECE1'],
            ['dispname' => 'Red', 'color' => 'red', 'hex' => '#FF0000'],
            ['dispname' => 'Green', 'color' => 'green', 'hex' => '#00FF00'],
            ['dispname' => 'Blue', 'color' => 'blue', 'hex' => '#0000FF'],
            ['dispname' => 'Yellow', 'color' => 'yellow', 'hex' => '#FFFF00'],
            ['dispname' => 'Purple', 'color' => 'purple', 'hex' => '#800080'],
            ['dispname' => 'Orange', 'color' => 'orange', 'hex' => '#FFA500'],
            ['dispname' => 'Pink', 'color' => 'pink', 'hex' => '#FFC0CB'],
            ['dispname' => 'Brown', 'color' => 'brown', 'hex' => '#A52A2A'],
            ['dispname' => 'Grey', 'color' => 'grey', 'hex' => '#808080'],
            ['dispname' => 'Beige', 'color' => 'beige', 'hex' => '#E8DCCA'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
