<?php

use App\Models\JobPost;
use Illuminate\Contracts\Queue\Job;
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
        Schema::create('job_responses', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->foreignIdFor(JobPost::class,'post_title');
            $table->date('date_response');
            $table->string('contact')->nullable();
            $table->string('email_address')->nullable();
            $table->longText('current_address')->charset('binary');
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('job_responses');
    }
};
