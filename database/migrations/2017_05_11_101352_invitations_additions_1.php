<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvitationsAdditions1 extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->date('end_date')->after('status')->nullable()->default(null);
            $table->string('grade')->after('end_date')->nullable()->default(null);
            $table->text('attachments')->after('grade')->nullable()->default(null);
            $table->text('description')->after('attachments')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn('end_date');
            $table->dropColumn('attachments');
            $table->dropColumn('description');
            $table->dropColumn('grade');
        });
    }
}
