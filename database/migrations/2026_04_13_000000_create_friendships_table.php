<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('friendships_table', function (Blueprint $table) {
            $table->id('friendship_id');
            $table->foreignId('requester_id')
                ->constrained(table: 'users_table', column: 'user_id')
                ->onDelete('cascade');
            $table->foreignId('requested_id')
                ->constrained(table: 'users_table', column: 'user_id')
                ->onDelete('cascade');
            $table->string('status', 20)->default('pending');
            $table->timestamps();

            $table->unique(['requester_id', 'requested_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('friendships_table');
    }
};
