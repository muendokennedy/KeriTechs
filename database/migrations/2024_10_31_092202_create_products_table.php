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
            $table->string('productCategory');
            $table->string('productName');
            $table->string('productSpecifications');
            $table->string('brandName');
            $table->string('productWarranty');
            $table->string('productDescription');
            $table->string('productAverageRating', 5, 1);
            $table->decimal('productInitialPrice', 8, 2);
            $table->decimal('productDiscountPrice', 8, 2);
            $table->string('productFirstImage');
            $table->string('productSecondImage');
            $table->string('productThirdImage');
            $table->string('productFourthImage');
            $table->timestamps();
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
