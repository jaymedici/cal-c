<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnrolledParticipantIdOnParticipantVisits extends Migration
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
            $table->bigInteger('enrolled_participant_id')->unsigned()->after('participant_id');
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
