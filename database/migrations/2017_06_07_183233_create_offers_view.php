<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $view = "CREATE VIEW offers AS

SELECT 'proposal' as 'type', p.tutor_id as offer_tutor_id, t.* FROM tutions t 
INNER JOIN proposals p ON p.tution_id = t.id

UNION

SELECT 'invitation' as 'type', i.tutor_id as offer_tutor_id, t.* FROM tutions t 
INNER JOIN invitations i ON i.tution_id = t.id";
        DB::unprepared($view);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
