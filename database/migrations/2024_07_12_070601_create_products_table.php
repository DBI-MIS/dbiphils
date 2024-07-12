<?php

use App\Models\Brand;
use App\Models\User;
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
            $table->string('title');
            $table->string('product_img')->nullable();
            $table->foreignIdFor(User::class);
            $table->date('date_posted')->nullable();
            $table->longText('description')->charset('binary')->nullable();
            $table->longText('features')->charset('binary')->nullable();
            $table->longText('technical_specs')->charset('binary')->nullable();
            $table->string('slug')->unique();
            $table->string('capacity')->nullable();
            $table->string('equipment_application')->nullable();
            $table->string('equipment_header')->nullable();
            $table->foreignIdFor(Brand::class)->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
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
