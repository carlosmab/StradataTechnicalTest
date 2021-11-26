<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicPersonQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_person_query', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('public_person_id');
            $table->unsignedBigInteger('query_id');
            $table->decimal('match_rate',10, 4);
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
        Schema::dropIfExists('public_person_query');
    }
}
