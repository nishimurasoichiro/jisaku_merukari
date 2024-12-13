<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->string('explanation','300')->nullable();
            $table->string('image');
            $table->integer('user_id');
            $table->integer('situation');
            $table->integer('buyer_id')->nullable();
            $table->dateTime('buy_at')->nullable();
            $table->integer('del_fig')->default(0);
            $table->integer('purchase_fig')->default();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}

