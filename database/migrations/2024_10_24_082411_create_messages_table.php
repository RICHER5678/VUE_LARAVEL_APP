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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id')
            ->comment('This is a anique ID of the messages table and is of datatype bigint.');
            $table->text('message_content')
            ->comment('The content of the message. If it exceeds 160 characters, it is treated as multiple messages.');
            // $table->foreignId('user_id')
            //     ->constrained('users')
            //     ->cascadeOnDelete()
            //     ->null();
            $table->text('sender_id')
                  ->null();
             
            $table->foreignId('department_id')
                  ->constrained('departments')
                  ->cascadeOnDelete();
            $table->foreignId('group_id')
                  ->constrained('groups')
                  ->cascadeOnDelete();
            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};