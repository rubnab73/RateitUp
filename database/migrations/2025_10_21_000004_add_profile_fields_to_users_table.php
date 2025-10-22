<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('expertise_level')->default('beginner');
            $table->json('expertise_categories')->nullable();
            $table->string('website')->nullable();
            $table->string('social_links')->nullable();
            $table->integer('reputation_points')->default(0);
            $table->string('location')->nullable();
            $table->timestamp('last_active_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar',
                'bio',
                'expertise_level',
                'expertise_categories',
                'website',
                'social_links',
                'reputation_points',
                'location',
                'last_active_at'
            ]);
        });
    }
};