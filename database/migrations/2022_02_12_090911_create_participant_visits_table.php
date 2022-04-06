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
            $table->string('participant_id')->default('');
            $table->integer('project_id')->unsigned();
            $table->string('site_name')->default('');
            $table->integer('visit_id')->unsigned();
            $table->date('visit_date')->default('1000-01-01');
            $table->date('actual_visit_date')->nullable();
            $table->date('window_start_date')->default('1000-01-01');
            $table->date('window_end_date')->default('1000-01-01');
            $table->string('visit_status')->default('');
            $table->string('updated_by')->default('');
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
