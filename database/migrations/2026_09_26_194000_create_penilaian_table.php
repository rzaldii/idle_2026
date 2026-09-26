<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('penilaian')) {
            Schema::create('penilaian', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_tim')->unsigned();
                $table->integer('babak');
                $table->integer('nilai');
                $table->timestamps();
                $table->dateTime('deleted_at')->nullable();

                $table->index('id_tim');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
}
