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
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_category_id');
            $table->unsignedBigInteger('item_size_id');
            $table->unsignedBigInteger('item_gender_id');
            $table->string('item_name', 60);
            $table->integer('price');
            $table->text('item_comment', 1000)->nullabel();
            $table->integer('item_count')->default(20);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            //外部キー制約
            $table->foreign('item_category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('item_size_id')->references('id')->on('sizes')->onDelete('cascade');
            $table->foreign('item_gender_id')->references('id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
