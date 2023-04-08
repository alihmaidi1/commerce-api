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
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->uuid("parent_id")->nullable();
            $table->string("name")->unique();
            $table->boolean("status");
            $table->integer("rank")->unique();
            $table->text("description");
            $table->string("meta_description");
            $table->string("meta_title");
            $table->string("url");
            $table->string("meta_logo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
