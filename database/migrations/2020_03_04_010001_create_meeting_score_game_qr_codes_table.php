<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meeting_score_game_qr_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('score_game_id')->index();
            $table->string('title', 511);
            $table->string('code');
            $table->unsignedBigInteger('point');
            $table->datetime('start_at');
            $table->datetime('finish_at');
            $table->boolean('status')->default(1)->comment('0=passive;1=active');
            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->unsignedBigInteger('updated_by')->index()->nullable();
            $table->unsignedBigInteger('deleted_by')->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
            $table->foreign('deleted_by')->on('users')->references('id');
            $table->foreign('score_game_id')->on('meeting_score_games')->references('id');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('meeting_score_game_qr_codes');
    }
};
