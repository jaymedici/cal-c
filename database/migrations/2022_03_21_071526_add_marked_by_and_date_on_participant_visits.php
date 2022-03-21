<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarkedByAndDateOnParticipantVisits extends Migration
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
            $table->string('marked_by')->after('visit_status')->nullable();
            $table->date('marked_date')->after('marked_by')->nullable();
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
