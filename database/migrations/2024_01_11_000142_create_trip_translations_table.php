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
        Schema::create('trip_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->string('area');
            $table->longtext('info');
            $table->unique(['trip_id', 'locale']);
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_translations');
    }
};
