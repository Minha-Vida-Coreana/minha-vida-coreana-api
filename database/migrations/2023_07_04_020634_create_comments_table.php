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
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('content');
            $table->uuid('user_id');
            $table->uuid('post_id');
            $table->uuid('parent_id')->nullable();
            $table->uuid('like_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('CASCADE');
            $table->foreign('like_id')->references('id')->on('likes')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
