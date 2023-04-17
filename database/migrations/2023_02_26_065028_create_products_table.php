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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->string("name");
            $table->string("title");
            $table->text("description");
            $table->string("meta_title");
            $table->text("meta_description");
            $table->string("meta_logo");
            $table->uuid("category_id");
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade")->onUpdate("cascade");
            $table->float("price",10,3);
            $table->integer("quantity");
            $table->integer("min_quantity");
            $table->integer("selling_number")->default(0);
            $table->uuid("currency_id");
            $table->foreign("currency_id")->references("id")->on("currencies")->onDelete("cascade")->onUpdate("cascade");
            $table->uuid("brand_id");
            $table->foreign("brand_id")->references("id")->on("brands")->onDelete("cascade")->onUpdate("cascade");
            $table->string("thumbnail");
            $table->uuid("copon_id")->nullable();
            $table->foreign("copon_id")->references("id")->on("copons")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};