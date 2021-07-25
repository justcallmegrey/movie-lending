<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lending', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('member_id');
            $table->string('lending_date');
            $table->string('returned_date');
            $table->string('lateness_charge');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lending');
    }
}
