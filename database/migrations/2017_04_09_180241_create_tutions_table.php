<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->index();
            $table->integer('tutor_id')->nullable()->default(null);
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('title');
            $table->string('budget');
            /**
             * Latitude and Longitude
             *  http://stackoverflow.com/questions/12504208/what-mysql-data-type-should-be-used-for-latitude-longitude-with-8-decimal-places
             */
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->date('start_date');
            $table->time('daily_timing');
            for ($i = 0; $i < 7; $i++) {
                $table->boolean('day_of_week_' . $i)->default(false);
            }
            $table->text('description')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutions');
    }
}
