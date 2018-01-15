<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quiz_a_id');
            $table->foreign('quiz_a_id')
                ->references('id')
                ->on('quizzes')
                ->onDelete('cascade');
            $table->unsignedInteger('quiz_b_id');
            $table->foreign('quiz_b_id')
                ->references('id')
                ->on('quizzes')
                ->onDelete('cascade');
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
        Schema::dropIfExists('quiz_sets');
    }
}
