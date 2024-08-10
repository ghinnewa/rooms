<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamScheduleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_schedule_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_schedule_id');
            $table->date('exam_date');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('semester');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
    
            $table->foreign('exam_schedule_id')->references('id')->on('exam_schedules')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_schedule_items');
    }
}
