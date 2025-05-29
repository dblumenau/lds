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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_approved')->default(false)->after('email_verified_at');
            $table->boolean('is_superadmin')->default(false)->after('is_approved');
            $table->timestamp('approved_at')->nullable()->after('is_superadmin');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
            
            $table->index('is_approved');
            $table->index('is_superadmin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_approved', 'is_superadmin', 'approved_at', 'approved_by']);
        });
    }
};
