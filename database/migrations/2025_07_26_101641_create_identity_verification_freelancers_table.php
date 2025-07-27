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
        Schema::create('identity_verification_freelancers', function (Blueprint $table) {
            $table->id();
            $table->string('freelancer_id');
            $table->string('id_card_number');
            $table->string('front_image');
            $table->string('selfie_image');
            $table->string('status');
            $table->timestamp('reviewed_at')->nullable();
            $table->string('reviewed_by');
            $table->string('rejection_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identity_verification_freelancers');
    }
};
