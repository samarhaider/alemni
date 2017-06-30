<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProposalsAdditions1 extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Title, availability,schedule,estimated cost,description attachments
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('title')->after('tution_id')->nullable()->default(null);
            $table->string('availability_from')->after('cost')->nullable()->default(null);
            $table->string('availability_to')->after('availability_from')->nullable()->default(null);
            $table->string('schedule')->after('availability_to')->nullable()->default(null);
            $table->text('attachments')->after('description')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('availability_from');
            $table->dropColumn('availability_to');
            $table->dropColumn('schedule');
            $table->dropColumn('attachments');
        });
    }
}
