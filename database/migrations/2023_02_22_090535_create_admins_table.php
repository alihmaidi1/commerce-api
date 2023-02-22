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
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->string("name");
            $table->string("email")->unique();
            $table->string("password");
            $table->string("phone")->unique();
            $table->string("code")->nullable();
            $table->uuid("role_id");
            $table->foreign("role_id")->references("id")->on("roles")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
