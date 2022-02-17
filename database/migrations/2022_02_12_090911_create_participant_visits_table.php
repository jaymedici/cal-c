<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_visits', function (Blueprint $table) {
            $table->id();
            $table->string('participant_id');
            $table->integer('project_id')->unsigned();
            $table->string('site_name');
            $table->integer('visit_id')->unsigned();
            $table->date('visit_date');
            $table->date('actual_visit_date')->nullable();
            $table->date('window_start_date');
            $table->date('window_end_date');
            $table->string('visit_status');
            $table->string('updated_by');
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
        Schema::dropIfExists('patient_visits');
    }
}
