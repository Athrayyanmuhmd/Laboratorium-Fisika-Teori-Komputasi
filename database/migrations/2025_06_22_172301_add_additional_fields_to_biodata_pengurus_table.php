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
        Schema::table('biodataPengurus', function (Blueprint $table) {
            // Contact Information
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            
            // Professional Information
            $table->text('bio')->nullable();
            $table->string('specialization')->nullable();
            $table->string('education')->nullable();
            $table->text('expertise')->nullable();
            $table->text('research_interests')->nullable();
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'volunteer'])->default('full_time');
            
            // Social Links
            $table->string('linkedin_url')->nullable();
            $table->string('google_scholar_url')->nullable();
            $table->string('website_url')->nullable();
            
            // Career Information
            $table->date('join_date')->nullable();
            $table->text('achievements')->nullable();
            $table->text('publications')->nullable();
            
            // Status and Display
            $table->boolean('is_active')->default(true);
            $table->boolean('show_on_website')->default(true);
            $table->integer('display_order')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodataPengurus', function (Blueprint $table) {
            $table->dropColumn([
                'email', 'phone', 'bio', 'specialization', 'education', 
                'expertise', 'research_interests', 'employment_type',
                'linkedin_url', 'google_scholar_url', 'website_url',
                'join_date', 'achievements', 'publications',
                'is_active', 'show_on_website', 'display_order'
            ]);
        });
    }
};
