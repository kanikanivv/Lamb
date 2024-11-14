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
            $table->biginteger('id');
            $table->integer('item_category_id');
            $table->integer('item_size_id');
            $table->integer('item_gender_id');
            $table->string('item_name');
            $table->integer('price');
            $table->text('item_comment');
            $table->integer('item_count');
            $table->timestamp('created_at');
            $table->timestamp('update_at');
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
