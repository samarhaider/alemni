<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhoneVerification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->boolean('is_phone_number_verified')->after('phone_number')->nullable()->default(false);
        });
        Schema::create('verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('type'); # 1 = phone, 2 = email
            $table->string('value');
            $table->unsignedInteger('user_id');
            $table->char('code', 4);
            $table->timestamps();
            $table->softDeletes();
            $table->index('user_id');
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
            $table->dropColumn('is_phone_number_verified');
        });
        Schema::dropIfExists('verifications');
    }
}
