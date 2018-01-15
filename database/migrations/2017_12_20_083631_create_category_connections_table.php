<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_connections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_category_id');
            $table->foreign('parent_category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->unsignedInteger('child_category_id');
            $table->foreign('child_category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->integer('type');
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
        Schema::dropIfExists('category_connections');
    }
}
