<?php

use App\Models\Product;
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
        Schema::create('product_responses', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->foreignIdFor(Product::class,'product_title');
            $table->date('date_response');
            $table->string('contact')->nullable();
            $table->string('email_address')->nullable();
            $table->longText('message')->charset('binary');
            $table->boolean('review')->default(false);
            $table->string('status')->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_responses');
    }
};
