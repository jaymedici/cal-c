<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Calendars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hastable('calendars')){ //check if table does not exist then create new
        Schema::create('calendars', function(Blueprint $table){
            $table->id();
            $table->string('patient_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('site_name')->nullable();
            $table->string('visit')->nullable();
            $table->date('visit_date')->nullable();
            $table->date('actual_visit_date')->nullable();
            $table->date('windows_start_date')->nullable();
            $table->date('windows_end_date')->nullable();
            $table->integer('window_period')->nullable();
            $table->string('visit_status')->nullable();
            $table->string('visit_status1')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

    }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        //
        Schema::dropIfExists('calendars');

        
    }
}
