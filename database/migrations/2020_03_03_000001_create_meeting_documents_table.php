<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meeting_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id')->index();
            $table->uuid('file_name')->unique();
            $table->string('file_extension', 31)->nullable();
            $table->unsignedInteger('file_size')->comment('(kb)')->nullable();
            $table->string('title', 511)->nullable();
            $table->boolean('sharing_via_email')->default(0)->comment('0=not-allowed;1=allowed');
            $table->boolean('allowed_to_review')->default(0)->comment('0=not-allowed;1=allowed');
            $table->boolean('status')->default(1)->comment('0=passive;1=active');
            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->unsignedBigInteger('updated_by')->index()->nullable();
            $table->unsignedBigInteger('deleted_by')->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
            $table->foreign('deleted_by')->on('users')->references('id');
            $table->foreign('meeting_id')->on('meetings')->references('id');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('meeting_documents');
    }
};
