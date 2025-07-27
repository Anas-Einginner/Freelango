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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('freelancer_id');
            $table->decimal('bid_amount');
            $table->string('delivery_time');
            $table->text('cover_letter');
            $table->string('status');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('last_updated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
