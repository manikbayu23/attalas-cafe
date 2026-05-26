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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->foreignId('menu_category_id')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')
                ->nullable();

            $table->decimal('price', 15, 2)
                ->default(0);

            $table->string('image')
                ->nullable();

            $table->boolean('is_best_seller')
                ->default(false);

            $table->boolean('is_featured')
                ->default(false);

            $table->boolean('status')
                ->default(true)
                ->comment('1=active,0=inactive');

            $table->integer('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index('menu_category_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
