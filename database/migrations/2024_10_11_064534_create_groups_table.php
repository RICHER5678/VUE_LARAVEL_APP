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
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Primary key: Unique ID of the groups table and is of datatype bigint.');
            $table->string('name', 255)->comment('The name of the group. It is of datatype varchar with a maximum length of 255 characters.');
            $table->foreignId('organisation_id')
                  ->constrained('organisations')
                  ->nullable()
                  ->cascadeOnDelete()
                  ->comment('Foreign key: References the ID of the organisation in the organisations table.');
            $table->foreignId('department_id')
                  ->nullable()
                  ->constrained('departments')
                  ->cascadeOnDelete()
                  ->comment('Foreign key: References the ID of the department in the departments table. This column is nullable.');
        
            $table->timestamps();});
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
