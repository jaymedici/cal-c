<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VisitSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hastable('visit_settings')){ //check if table does not exist then create new
        Schema::create('visit_settings', function(Blueprint $table){
            $table->id();
            $table->integer('project_id')->nullable();
            $table->string('visit_name')->nullable();
            $table->integer('number_of_days')->nullable();
            $table->integer('window_period')->nullable();
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
        Schema::dropIfExists('visit_settings');

        
    }
}
