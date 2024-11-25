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
         $table->string('user_name', 60)->nullable;
         $table->string('name', 60)->change();
         $table->string('address', 150);
         $table->string('email', 250)->nullable()->unique()->change();
         $table->string('tel', 20)->nullable()->unique();
         //$table->integer('age');
         $table->string('password', 70)->change();
         $table->timestamp('created_at')->change();
         $table->timestamp('updated_at')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('users', function (Blueprint $table) {
             $table->id()->change();
             $table->string('name')->change();
             $table->string('email')->unique()->change();
             $table->timestamp('email_verified_at')->nullable()->change();
             $table->string('password')->change();
             $table->rememberToken()->change();
             $table->timestamps()->change();
            //$table->integer('age');
            
        });

    }
};
