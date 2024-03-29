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
        Schema::create('cities', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->string("name");
            $table->uuid("country_id");
            $table->foreign("country_id")->references("id")->on("countries")->onDelete("cascade")->onUpdate("cascade");
            $table->unique(["country_id","name"]);
            $table->float("price");
            $table->uuid("currency_id");
            $table->foreign("currency_id")->references("id")->on("currencies")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};