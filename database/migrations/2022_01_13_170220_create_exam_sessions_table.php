<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("exam_id");
            $table->integer("question_number");
            $table->unsignedBigInteger("question_id")->nullable();
            $table->string("answer")->nullable();
            
            $table->foreign("question_id")->on("questions")->references("id");
            $table->foreign("exam_id")->on("exams")->references("id");
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
        Schema::dropIfExists('exam_sessions');
    }
}
