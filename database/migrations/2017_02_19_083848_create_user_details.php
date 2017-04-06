<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetails extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->enum('gender', ['M', 'F'])->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('avatar')->nullable()->default(null);
            /**
             * Latitude and Longitude
             *  http://stackoverflow.com/questions/12504208/what-mysql-data-type-should-be-used-for-latitude-longitude-with-8-decimal-places
             */
            $table->decimal('latitude', 10, 8)->nullable()->default(null);
            $table->decimal('longitude', 11, 8)->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->string('phone_number')->nullable()->default(null);
//            $table->string('education')->nullable()->default(null);
            $table->text('bio')->nullable()->default(null);
            $table->float('hourly_rate')->nullable()->default(null);
            $table->unsignedMediumInteger('radius')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('profiles');
    }
}
