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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('mobile_number');
            $table->text('address');
            $table->date('dob');
            $table->string('gender');
            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->string('pincode');
            $table->string('location');
            $table->integer('member_type');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            // Add the foreign key constraint for the user_id column
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
