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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('tracking_id')->unique();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(User::class, 'agent_id');
            $table->foreignIdFor(TicketDepartment::class);
            $table->string('subject');
            $table->text('body');
            $table->string('status')->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
