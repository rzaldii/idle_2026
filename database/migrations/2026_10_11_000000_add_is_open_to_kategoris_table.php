<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOpenToKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->boolean('is_open')->default(true)->after('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->dropColumn('is_open');
        });
    }
}
