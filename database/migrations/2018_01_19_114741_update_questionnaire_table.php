<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questionnaires', function(Blueprint $table) {
            $table->dropColumn('question3');
        });
        Schema::table('questionnaires', function(Blueprint $table) {
            $table->text('question3')->nullable();
            $table->integer('question4')->nullable();
            $table->text('question4text')->nullable();
            $table->integer('question5')->nullable();
            $table->text('question5text')->nullable();
            $table->integer('question6')->nullable();
            $table->text('question6text')->nullable();
            $table->integer('question7')->nullable();
            $table->text('question7text')->nullable();
            $table->integer('question8')->nullable();
            $table->text('question8text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
