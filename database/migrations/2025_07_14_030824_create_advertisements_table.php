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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('home_top_ad_url')->nullable();
            $table->string('home_top_ad_image')->nullable();
            $table->boolean('home_top_ad_status')->default(0);
            $table->string('home_bottom_ad_url')->nullable();
            $table->string('home_bottom_ad_image')->nullable();
            $table->boolean('home_bottom_ad_status')->default(0);
            $table->string('archive_bottom_ad_url')->nullable();
            $table->string('archive_bottom_ad_image')->nullable();
            $table->boolean('archive_bottom_ad_status')->default(0);
            $table->string('news_bottom_ad_url')->nullable();
            $table->string('news_bottom_ad_image')->nullable();
            $table->boolean('news_bottom_ad_status');
            $table->string('sidebar_ad_url')->nullable();
            $table->string('sidebar_ad_image')->nullable();
            $table->boolean('sidebar_ad_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
