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
        Schema::create('item_genders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('item_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            
            //外部キー制約
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_genders');
    }
};