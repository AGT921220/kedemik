<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('video_url')->nullable();
        });
        Schema::table('properties_types', function (Blueprint $table) {
            $table->string('video_url')->nullable();
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->string('video_url')->nullable();
        });
        Schema::table('infonavits', function (Blueprint $table) {
            $table->string('video_url')->nullable();
        });
        Schema::table('fovissstes', function (Blueprint $table) {
            $table->string('video_url')->nullable();
        });
        Schema::table('constructions', function (Blueprint $table) {
            $table->string('video_url')->nullable();
        });
        Schema::table('appraises', function (Blueprint $table) {
            $table->string('video_url')->nullable();
        });
        Schema::table('advisories', function (Blueprint $table) {
            $table->string('video_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
        Schema::table('properties_types', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
        Schema::table('infonavits', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
        Schema::table('fovissstes', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
        Schema::table('constructions', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
        Schema::table('appraises', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
        Schema::table('advisories', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
    }
}
