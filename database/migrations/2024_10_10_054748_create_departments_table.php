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
        Schema::create('departments', function (Blueprint $table) {
            $table->id()->comment('Primary key: A unique identifier for each department record, of datatype bigint.');
            $table->string('name', 255)->comment('The name of the department, of datatype varchar with a maximum length of 255 characters.');
            $table->foreignId('organisation_id')
                  ->constrained('organisations')
                  ->onDelete('cascade')
                  ->comment('Foreign key: References the ID of the organisation in the organisations table. On deletion of an organisation, related departments will also be deleted.');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
