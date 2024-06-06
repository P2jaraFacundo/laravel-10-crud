<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->integer('class_days');
            $table->integer('promotion_percentage');
            $table->integer('regular_percentage');
            $table->timestamps();
        });

        // Insertar datos por defecto
        DB::table('parameters')->insert([
            'class_days' => 180,
            'promotion_percentage' => 75,
            'regular_percentage' => 50,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters');
    }
}
