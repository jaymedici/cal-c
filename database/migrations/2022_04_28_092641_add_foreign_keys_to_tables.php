<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            //
            $table->bigInteger('project_id')->unsigned()->change();
            $table->bigInteger('site_id')->unsigned()->change();
            $table->bigInteger('participant_visit_id')->unsigned()->change();
            $table->bigInteger('screening_id')->unsigned()->change();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('participant_visit_id')->references('id')->on('participant_visits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('screening_id')->references('id')->on('screening')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('participant_visits', function (Blueprint $table) {
            //
            $table->bigInteger('project_id')->unsigned()->change();
            $table->bigInteger('site_id')->unsigned()->change();
            $table->bigInteger('visit_id')->unsigned()->change();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('visit_id')->references('id')->on('visit_settings')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('project_sites', function (Blueprint $table) {
            //
            $table->bigInteger('project_id')->unsigned()->change();
            $table->bigInteger('site_id')->unsigned()->change();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('screening', function (Blueprint $table) {
            //
            $table->bigInteger('project_id')->unsigned()->change();
            $table->bigInteger('site_id')->unsigned()->change();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('user_projects', function (Blueprint $table) {
            //
            $table->bigInteger('project_id')->unsigned()->change();
            $table->bigInteger('user_id')->unsigned()->change();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('user_sites', function (Blueprint $table) {
            //
            $table->bigInteger('site_id')->unsigned()->change();
            $table->bigInteger('user_id')->unsigned()->change();

            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('visit_settings', function (Blueprint $table) {
            //
            $table->bigInteger('project_id')->unsigned()->change();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
