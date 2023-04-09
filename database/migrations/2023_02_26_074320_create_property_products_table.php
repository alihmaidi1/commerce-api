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
        Schema::create('property_products', function (Blueprint $table) {
            $table->id();
            $table->uuid("product_id");
            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade")->onUpdate("cascade");
            $table->uuid("property_id");
            $table->foreign("property_id")->references("id")->on("properties")->onDelete("cascade")->onUpdate("cascade");
            $table->unique(["product_id","property_id"]);
            $table->json("values");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_products');
    }
};
