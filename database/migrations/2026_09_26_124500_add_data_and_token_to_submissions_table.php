<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataAndTokenToSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (!Schema::hasColumn('submissions', 'data')) {
                $table->text('data')->nullable()->after('file_path');
            }
            if (!Schema::hasColumn('submissions', 'token')) {
                $table->string('token', 32)->nullable()->after('data');
            }
        });

        Schema::table('tims', function (Blueprint $table) {
            if (!Schema::hasColumn('tims', 'starred')) {
                $table->boolean('starred')->default(0)->after('babak');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (Schema::hasColumn('submissions', 'token')) {
                $table->dropColumn('token');
            }
            if (Schema::hasColumn('submissions', 'data')) {
                $table->dropColumn('data');
            }
        });

        Schema::table('tims', function (Blueprint $table) {
            if (Schema::hasColumn('tims', 'starred')) {
                $table->dropColumn('starred');
            }
        });
    }
}
