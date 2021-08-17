<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->string('slug', 255)->index('products_slug_index');
            $table->string('short_description', 500)->nullable();
            $table->mediumText('full_description')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('discount')->default(0);
            $table->enum('type', ['download', 'deliver', 'reserved']);
            $table->boolean('in_stock')->default(true);
            $table->timestamps();
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
        Schema::dropIfExists('products');
    }
}
