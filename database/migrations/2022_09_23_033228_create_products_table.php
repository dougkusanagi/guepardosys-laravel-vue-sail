<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->float('price')->default(0);
            $table->string('model')->nullable();
            $table->text('description')->nullable();
            $table->text('description_html')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('stock_local')->default(0);
            $table->integer('stock_local_min')->default(0);
            $table->boolean('active')->default(true);
            $table->string('bar_code')->nullable();
            $table->string('ncm')->nullable();
            $table->float('weight')->default(0);
            $table->float('height')->default(0);
            $table->float('width')->default(0);
            $table->float('length')->default(0);
            $table->string('brand')->nullable();
            $table->integer('availability')->default(0);
            $table->text('keywords')->nullable();
            $table->string('status');
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
};
