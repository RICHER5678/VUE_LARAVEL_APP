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
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Primary key: A unique identifier for each template and is of datatype bigint.');
            $table->text('template_message')->comment('The message template content. It is of datatype text.');
            $table->foreignId('user_id')
                ->nullable()
                ->cascadeOnDelete()
                ->constrained('users')
                ->comment('Foreign key: References the ID of the user in the users table. This column is nullable.');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};