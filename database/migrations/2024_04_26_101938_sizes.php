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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->text('size');
            $table->text('type'); // 0 top, 1 pants, 2 shoes, 3 for head accesories
        });

        Schema::create('size-manager', function (Blueprint $table) {
            $table->id();
            $table->text('foreign');
            $table->text('top');
            $table->text('pants');
            $table->text('shoes');
        });

        // Generating Shoe Sizes 1 till 50
        $i = 1;
        while ($i < 61) {
            DB::table('sizes')->insert([
                'size' => $i,
                'type' => '2',
            ]);
            $i++;
        }
        $x = 1;
        while ($x < 5) {
            DB::table('sizes')->insert([
                'size' => $x,
                'type' => '3',
            ]);
            $x++;
        }

        // Generating Top Sizes S till 5XL
        $sizes = ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL'];
        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'size' => $size,
                'type' => '0',
            ]);
        }
        $pantsize = ['28', '30', '32', '34', '36', '38', '40', '42', '44', '46', '48', '50', '52', '54', '56', '58', '60'];
        foreach ($pantsize as $size) {
            DB::table('sizes')->insert([
                'size' => $size,
                'type' => '1',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
