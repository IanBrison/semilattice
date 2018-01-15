<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRakutenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rakuten', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recipe_id');
            $table->unsignedInteger('user_id');
            $table->string('big_category');
            $table->string('medium_category');
            $table->string('small_category');
            $table->string('recipe_title');
            $table->string('recipe_story');
            $table->string('recipe_description');
            $table->string('recipe_img');
            $table->string('recipe_real_name');
            $table->string('tag_1')->nullable();
            $table->string('tag_2')->nullable();
            $table->string('tag_3')->nullable();
            $table->string('tag_4')->nullable();
            $table->string('one_point_info')->nullable();
            $table->string('cook_time')->nullable();
            $table->string('cook_purpose')->nullable();
            $table->string('cook_cost')->nullable();
            $table->string('cook_amount')->nullable();
            $table->date('registered_at')->nullable();
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
        Schema::dropIfExists('rakuten');
    }
}
