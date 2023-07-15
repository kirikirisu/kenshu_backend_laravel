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
        Schema::table('post_tags', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);

            $table->dropColumn('tag_id');
            $table->string('tag_name');

            $table
                ->foreign('tag_name')
                ->references('name')
                ->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_tags', function (Blueprint $table) {
            $table->dropForeign(['tag_name']);

            $table->dropColumn('tag_name');
            $table->uuid('tag_id');

            $table
                ->foreign('tag_id')
                ->references('id')
                ->on('tags');
        });
    }
};
