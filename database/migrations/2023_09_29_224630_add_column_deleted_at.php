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
        Schema::table('ticket_departments', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(false)->nullable()->after('name');
            $table->timestamp('deleted_at')->nullable()->after('is_deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_departments', function (Blueprint $table) {
            //
        });
    }
};
