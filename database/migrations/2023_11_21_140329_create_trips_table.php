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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
          //  $table->string('name');
          //  $table->longtext('info');
            $table->string('image');
          //  $table->string('area');
            $table->integer('seats');
            $table->double('price',9.2);
            $table->integer('seats_taken')->default(0);
            $table->enum('type',['عادية','يومية','اسبوعية','شهرية','موسمية','سنوية'])->default('عادية');
            $table->enum('status',['حجز_مفتوح','حجز_مغلق','الأن','منتهية','ملغية'])->default('حجز_مفتوح');
            $table->timestamp('start_date');
            $table->timestamp('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
