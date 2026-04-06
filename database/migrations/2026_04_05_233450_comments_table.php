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
        Schema::create('comments_table', function (Blueprint $table) {
            $table->id('comment_id');
            $table->text('content');
            $table->timestamps();
            $table->foreignId('post_id')
                ->constrained(table: 'posts_table', column: 'post_id')
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained(table: 'users_table', column: 'user_id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments_table');
    }
};
