<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_hall_id')->index();
            $table->unsignedInteger('sort_id')->nullable();
            $table->string('code', 255)->nullable();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->binary('logo')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('finish_at')->nullable();
            $table->enum('type', ['break', 'event', 'other', 'session'])->default('session');
            $table->boolean('status')->default(1)->comment('0=passive;1=active');
            $table->timestamps();
            $table->unsignedBigInteger('deleted_by')->index()->nullable();
            $table->softDeletes();
            $table->foreign('deleted_by')->on('users')->references('id');
            $table->foreign('meeting_hall_id')->on('meeting_halls')->references('id');
        });
        DB::statement('ALTER TABLE programs MODIFY logo MEDIUMBLOB NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};