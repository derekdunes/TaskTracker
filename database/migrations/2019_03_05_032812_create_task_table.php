<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newTasks', function (Blueprint $table)
        {

            $table->increments('id');
            $table->string('client');
            $table->text('problem_description');
            $table->text('addition_info');
            $table->text('problem_candidate');
            $table->text('assigned_to');
            $table->string('status');
            $table->string('created_by')->nullable();
            $table->string('modified_by')->nullable();
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
        Schema::dropIfExists('createTasks');
    }
}
