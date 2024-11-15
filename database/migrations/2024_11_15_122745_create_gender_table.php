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
        Schema::table('gender', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gender_name', 60)->unique();
            $table->timestamp('created_at');
            $table->timestamp('update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gender', function (Blueprint $table) {
            Schema::dropIfExists('gender');
        });
    }
};
