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
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('document_type_id');
            $table->string('document_name');
            $table->string('additional_name')->nullable();
            $table->string('path')->unique();
            $table->unsignedBigInteger('file_size');
            $table->unsignedInteger('document_status_id');
            $table->uuid('user_id');
            $table->boolean('downloaded_file');
            $table->dateTime('tanggal_update');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
