<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_checklists', function (Blueprint $table) {
            $table->id();
            $table->integer('visit_id')->unsigned()->default(0);
            $table->integer('project_id')->unsigned()->default(0);
            $table->string('checklist_item', 1500)->default('');
            $table->string('is_done')->nullable();
            $table->string('attending_doctor')->nullable();
            $table->date('item_done_date')->nullable();
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
        Schema::dropIfExists('visit_checklists');
    }
}
