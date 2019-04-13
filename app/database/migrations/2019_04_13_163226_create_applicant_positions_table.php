<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('applicant_id')->unsigned();
            $table->string('name');
            $table->integer('level')->nullable();
            $table->integer('weight')->nullable();
            $table->timestamps();
        });

        Schema::table('applicant_positions', function(Blueprint $table){
            $table->foreign('applicant_id')->references('id')
                ->on('applicants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_positions');
    }
}
