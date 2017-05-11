<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TutionAdditions1 extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutions', function (Blueprint $table) {
            $table->string('city')->after('daily_timing')->nullable()->default(null);
            $table->string('state')->after('city')->nullable()->default(null);
            $table->string('date')->after('state')->nullable()->default(null);
            $table->string('time')->after('date')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutions', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('time');
            $table->dropColumn('city');
            $table->dropColumn('state');
        });
    }
}
