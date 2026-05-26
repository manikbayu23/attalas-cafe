<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->string('customer_name');

            $table->string('customer_photo')
                ->nullable();

            $table->tinyInteger('rating')
                ->default(5);

            $table->text('review');

            $table->boolean('is_featured')
                ->default(false);

            $table->boolean('status')
                ->default(true)
                ->comment('1=approved,0=hidden');

            $table->timestamps();

            $table->index('status');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
