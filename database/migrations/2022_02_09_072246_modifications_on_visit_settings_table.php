<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificationsOnVisitSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visit_settings', function (Blueprint $table) {
            //
            $table->renameColumn('number_of_days', 'days_from_first_visit');
            $table->integer('plus_window_period')->unsigned()->after('window_period')->default(0);
            $table->integer('minus_window_period')->unsigned()->after('plus_window_period')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visit_settings', function (Blueprint $table) {
            //
        });
    }
}
