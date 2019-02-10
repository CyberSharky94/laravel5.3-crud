<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id'); // incrementing ID of Primary Key
            $table->string('proj_title');
            $table->date('proj_start_date');
            $table->date('proj_end_date');
            $table->integer('user_id');
            $table->string('filename');
            $table->timestamps(); // akan create created at & updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
