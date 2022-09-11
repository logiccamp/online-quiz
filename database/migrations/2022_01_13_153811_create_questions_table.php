<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text("question");
            $table->string("option_a");
            $table->string("option_b")->nullable();
            $table->string("option_c")->nullable();
            $table->string("option_d")->nullable();
            $table->string("option_e")->nullable();
            $table->string("answer")->nullable();
            $table->text("reason")->nullable();
            $table->string("category")->nullable();
            $table->string("image_name")->nullable();
            
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
        Schema::dropIfExists('questions');
    }
}
