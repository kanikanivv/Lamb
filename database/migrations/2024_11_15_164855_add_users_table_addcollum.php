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
        Schema::table('users', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
            $table->string('email', 250)->change();
            //$table->timestamp('email_verified_at')->nullable()->change();
            $table->string('password', 20)->change();
            $table->string('name', 60)->change();
            //$table->string('user_name', 60)->nullable();
            //$table->string('tel', 13);
            //$table->string('address', 150);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('name');
            $table->string('password');
            //$table->string('user_name', 60)->nullable();
            //$table->string('tel', 13);
            //$table->string('address', 150);
        });

    }
};
