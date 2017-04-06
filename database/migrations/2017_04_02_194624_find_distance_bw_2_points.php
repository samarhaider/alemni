<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FindDistanceBw2Points extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $function = "
CREATE FUNCTION `distance`(`lat_1` DOUBLE, `lon_1` DOUBLE, `lat_2` DOUBLE, `lon_2` DOUBLE, `unit` CHAR(2))
RETURNS double
COMMENT ''
BEGIN

DECLARE PI FLOAT DEFAULT 3.14/180;
DECLARE ret_dist DOUBLE;
SET ret_dist = ACOS(SIN( lat_1 * PI) * SIN(lat_2 * PI) + COS( lat_1 * PI) * COS(lat_2 * PI) * COS(( lon_1 - lon_2 ) * PI)) / PI * 60 * 1.1515;
IF unit = 'MI' THEN
SET ret_dist = ret_dist;
ELSEIF unit = 'KM' THEN
SET ret_dist = ret_dist * 1.609344 ;
ELSEIF unit = 'ME' THEN
SET ret_dist = ret_dist * 1.609344 * 1000;
END IF;

RETURN ret_dist;

END
";
        DB::unprepared($function);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP FUNCTION IF EXISTS distance");
    }
}
