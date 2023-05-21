<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('exam_controller_id');
            $table->string('name');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->enum('exam_time_validation', ['QUESTION_WISE', 'EXAM_WISE']);
            $table->unsignedInteger('time_limit_in_mins');
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('school_classes');
            $table->foreign('exam_controller_id')->references('id')->on('members');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
