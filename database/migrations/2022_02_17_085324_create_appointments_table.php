<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('participant_id')->default('');
            $table->integer('project_id')->unsigned()->default(0);
            $table->integer('site_id')->unsigned()->default(0);
            $table->integer('visit_id')->unsigned()->nullable();
            $table->integer('screening_id')->unsigned()->nullable();
            $table->dateTime('appointment_date_time')->default('');
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
        Schema::dropIfExists('appointments');
    }
}
