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
        Schema::create('inyourcolour', function (Blueprint $table) {
            $table->id()->primary();
            $table->text('name');
            $table->text('hex');
        });
        DB::table('inyourcolour')->insert([
            ['name' => 'Lovingly', 'hex' => "#395154"],
            ['name' => 'Hopeful', 'hex' => "#9e7294"],
            ['name' => 'Positive', 'hex' => "#285087"],
            ['name' => 'Creative', 'hex' => "#633C8A"],
            ['name' => 'Powerful', 'hex' => "#e96a28"],
            ['name' => 'Proud', 'hex' => "#578cab"],
            ['name' => 'Love', 'hex' => "#395154"],
            ['name' => 'Accepted', 'hex' => "#e96a28"],
            ['name' => 'Admiration', 'hex' => "#395154"],
            ['name' => 'Valuable', 'hex' => "#633c8a"],
            ['name' => 'I may be there', 'hex' => "#e96a28"],
            ['name' => 'Feel connection', 'hex' => "#9e7294"],
            ['name' => 'Balance', 'hex' => "#395154"],
            ['name' => 'Radiant', 'hex' => "#285087"],
            ['name' => 'Appreciated', 'hex' => "#9e7294"],
            ['name' => 'Power', 'hex' => "#e96a28"],
            ['name' => 'Communicative', 'hex' => "#285087"],
            ['name' => 'Warmly', 'hex' => "#395154"],
            ['name' => 'Binding factor', 'hex' => "#578cab"],
            ['name' => 'Energetic', 'hex' => "#e96a28"],
            ['name' => 'Gladness', 'hex' => "#395154"],
            ['name' => 'Vital', 'hex' => "#285087"],
            ['name' => 'Effective', 'hex' => "#e96a28"],
            ['name' => 'Open', 'hex' => "#395154"],
            ['name' => 'Careless', 'hex' => "#285087"],
            ['name' => 'In love', 'hex' => "#395154"],
            ['name' => 'Decisive', 'hex' => "#e96a28"],
            ['name' => 'Innocent', 'hex' => "#395154"],
            ['name' => 'Self-assured', 'hex' => "#e96a28"],
            ['name' => 'Social', 'hex' => "#285087"],
            ['name' => 'Cheerful', 'hex' => "#395154"],
            ['name' => 'Originally', 'hex' => "#633c8a"],
            ['name' => 'Passionate', 'hex' => "#e96a28"],
            ['name' => 'Lust for life', 'hex' => "#285087"],
            ['name' => 'Pure', 'hex' => "#395154"],
            ['name' => 'Grounding', 'hex' => "#cda524"],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::DropIfExists('inyourcolour');
    }
};
