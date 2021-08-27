<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->char('order_id', 40)
                ->nullable()
                ->index('order_id_order_index');
            $table->char('pay_id', 40)
                ->nullable()
                ->index('pay_id_order_index');
            $table->char('status', 20);
            $table->unsignedInteger('amount')->default(0);
            $table->json('details');
            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->onDelete('SET NULL')
                ->onUpdate('SET NULL');
            $table->unsignedInteger('quantity')->default(1);
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('SET NULL')
                ->onUpdate('SET NULL');
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
        Schema::dropIfExists('orders');
    }
}
