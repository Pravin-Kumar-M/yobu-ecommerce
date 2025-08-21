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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('store_price', 10, 2)->nullable();
            $table->decimal('original_price', 10, 2)->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('product_code')->nullable();
            $table->string('quantity')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('trending', ['yes', 'no'])->default('no');
            $table->enum('featured', ['yes', 'no'])->default('no');
            $table->string('slug')->unique(); // for SEO-friendly URLs
            $table->timestamps();
            $table->softDeletes(); // to allow soft deletion of products
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
