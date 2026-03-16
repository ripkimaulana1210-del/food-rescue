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
        Schema::create('foods', function (Blueprint $table) {

            $table->id();

            $table->string('store_name');

            $table->string('food_name');

            $table->string('image')->nullable();

            $table->integer('original_price');

            $table->integer('rescue_price');

            $table->integer('portions');

            $table->string('location');

            $table->decimal('latitude', 10, 8)->nullable();

            $table->decimal('longitude', 11, 8)->nullable();

            $table->timestamp('expired_at')->nullable();

            $table->enum('status', ['available', 'sold_out'])->default('available');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
