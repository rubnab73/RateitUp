<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('status')->default('active');
            $table->boolean('is_featured')->default(false);
            $table->integer('view_count')->default(0);
            $table->index(['category', 'status']);
            $table->fulltext(['title', 'description']);
        });
    }

    public function down(): void
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropIndex(['category', 'status']);
            $table->dropFullText(['title', 'description']);
            $table->dropColumn(['status', 'is_featured', 'view_count']);
        });
    }
};