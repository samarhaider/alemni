<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfileAdditions1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->mediumInteger('stage_complete')->after('experience')->nullable()->default(null);
            $table->string('specialist')->after('stage_complete')->nullable()->default(null);
            $table->string('teaches')->after('stage_complete')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('stage_complete');
            $table->dropColumn('specialist');
            $table->dropColumn('teaches');
        });
    }
}
