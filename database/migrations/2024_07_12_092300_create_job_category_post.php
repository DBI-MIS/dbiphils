<?php

use App\Models\JobCategory;
use App\Models\JobPost;
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
        Schema::create('job_category_post', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JobPost::class);
            $table->foreignIdFor(JobCategory::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_category_post');
    }
};
