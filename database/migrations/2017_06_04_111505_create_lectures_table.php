<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tution_id')->index();
            $table->dateTime('start_time')->nullable()->default(null);
            $table->dateTime('end_time')->nullable()->default(null);
            $table->text('goals')->nullable()->default(null);
            $table->text('reviews')->nullable()->default(null);
            $table->integer('lecture_number')->nullable()->default(null);
            $table->integer('progress')->nullable()->default(null);
            $table->text('attachments')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
//            $table->foreign('tution_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectures');
    }
}
