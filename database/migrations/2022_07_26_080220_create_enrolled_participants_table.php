<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolledParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled_participants', function (Blueprint $table) {
            $table->id();
            $table->string('participant_id');
            $table->bigInteger('project_id')->unsigned();
            $table->bigInteger('study_arm_id')->unsigned()->nullable();
            $table->bigInteger('site_id')->unsigned();
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('study_arm_id')->references('id')->on('study_arms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolled_participants');
    }
}
