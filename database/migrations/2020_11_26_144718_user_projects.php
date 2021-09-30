<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hastable('user_projects')){ //check if table does not exist then create new
        Schema::create('user_projects', function(Blueprint $table){
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('project_id')->nullable();
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
        Schema::dropIfExists('user_projects');

        
    }
}
