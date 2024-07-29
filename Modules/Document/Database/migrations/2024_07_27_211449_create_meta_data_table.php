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
        Schema::create('meta_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('document_id')->references('id')->on('documents')->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->integer('sort_number');
            $table->string('column_name');
            $table->string('column_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_data');
    }
};
