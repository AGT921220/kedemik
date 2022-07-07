<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('sliders', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('properties_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('infonavits', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('fovissstes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('constructions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('appraises', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('advisories', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('properties_types', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('infonavits', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('fovissstes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('constructions', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('appraises', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('advisories', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
