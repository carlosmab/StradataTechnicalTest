<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_people', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('region');
            $table->string('location');
            $table->string('city');
            $table->string('name');
            $table->integer('active_years');
            $table->enum('person_type', ['NO APLICA', 'PREFERENTE', 'NO PREFERENTE']);
            $table->enum('job_title', ['ACTOR', 'CANTANTE', 'POLITICO', 'OTRO']);
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
        Schema::dropIfExists('public_people');
    }
}
