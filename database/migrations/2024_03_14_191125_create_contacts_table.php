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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->nullable()->references('id')->on('contacts_groups');
            // TODO: this should be split into two separate alpha field
            $table->string('name')->required();
            $table->string('nickname')->required();
            $table->string('phone')->unique()->required();
            $table->string('email')->unique()->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
