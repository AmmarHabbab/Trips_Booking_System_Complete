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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_type',['كاش','سيرياتيل_كاش','ام_تي_ان_كاش']);
            $table->float('amount');
            $table->enum('status',['غير_مؤكدة','مؤكدة','اعادة','تم_الاعادة']);
            $table->timestamps();
            $table->string('phone')->nullable();
            $table->integer('trip_id');
            $table->integer('user_id');
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
