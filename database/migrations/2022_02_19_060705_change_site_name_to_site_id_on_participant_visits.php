<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSiteNameToSiteIdOnParticipantVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participant_visits', function (Blueprint $table) {
            //
            $table->integer('site_id')->unsigned()->after('project_id')->default(0);
            $table->dropColumn('site_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participant_visits', function (Blueprint $table) {
            //
        });
    }
}
