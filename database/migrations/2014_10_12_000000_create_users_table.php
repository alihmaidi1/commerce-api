<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string("photo")->nullable();
            $table->float("point")->default(0);
            $table->boolean("status")->default(false);
            $table->string("code")->nullable();
            $table->uuid("provider_id")->nullable();
            $table->foreign("provider_id")->references("id")->on("providers")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
