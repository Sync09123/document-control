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
            $table->id();
            $table->string('ref_id');
            $table->unsignedBigInteger('document_type_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_info_id');
            $table->string('path');
 
      
            $table->timestamps();

            // $table->foreign('document_type_id')->references('id')->on('document_types');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('user_info_id')->references('id')->on('user_info');
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
