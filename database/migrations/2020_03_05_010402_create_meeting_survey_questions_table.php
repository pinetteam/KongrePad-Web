<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meeting_survey_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->nullable();
            $table->unsignedBigInteger('survey_id')->index();
            $table->string('question', 511);
            $table->boolean('status')->default(0)->comment('0=passive;1=active');
            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->unsignedBigInteger('updated_by')->index()->nullable();
            $table->unsignedBigInteger('deleted_by')->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
            $table->foreign('deleted_by')->on('users')->references('id');
            $table->foreign('survey_id')->on('meeting_surveys')->references('id');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('meeting_survey_questions');
    }
};
