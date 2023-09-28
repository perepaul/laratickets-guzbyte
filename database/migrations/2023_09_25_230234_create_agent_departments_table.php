<?php

use App\Models\TicketDepartment;
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
        Schema::create('agent_departments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->onDelete("cascade");
            $table->foreignIdFor(TicketDepartment::class)->onDelete("set null");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_departments');
    }
};
