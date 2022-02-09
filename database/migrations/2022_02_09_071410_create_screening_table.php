<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screening', function (Blueprint $table) {
            $table->id();
            $table->date('screening_date');
            $table->string('participant_id');
            $table->string('still_screening', 5);
            $table->date('next_screening_date')->nullable();
            $table->string('screening_outcome');
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
        Schema::dropIfExists('screening');
    }
}
