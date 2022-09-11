<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addsubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_groups', function (Blueprint $table) {
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_groups', function (Blueprint $table) {
            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")->references("id")->on("categories");
        });
    }
}
