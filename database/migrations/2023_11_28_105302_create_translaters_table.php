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
        Schema::create('translaters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('info');
            $table->enum('gender',['ذكر','أنثى']);
            $table->string('languages_spoken');
            $table->string('image');
            $table->double('price_sy',10.2);
            $table->double('price_usd',10.2);
            $table->enum('status',['متوفر','محجوز','غير_متوفر'])->default('متوفر');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translaters');
    }
};
