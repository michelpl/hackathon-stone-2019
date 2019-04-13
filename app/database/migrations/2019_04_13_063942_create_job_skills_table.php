<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->integer('skill_id')->unsigned();
            $table->integer('weight')->nullable();
            $table->integer('level')->nullable();

            $table->timestamps();
        });

        Schema::table('job_skills', function(Blueprint $table){
            $table->foreign('skill_id')->references('id')
                ->on('skills');
            $table->foreign('job_id')->references('id')
                ->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_skills');
    }
}
