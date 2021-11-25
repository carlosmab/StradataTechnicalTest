<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchResultPublicPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_results_public_people', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('search_result_id');
            $table->unsignedBigInteger('public_person_id');
            $table->decimal('match_rate', 6, 4);
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
        Schema::dropIfExists('search_result_public_people');
    }
}
