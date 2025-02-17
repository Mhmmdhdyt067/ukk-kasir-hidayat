<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detailpenjualan', function (Blueprint $table) {
            $table->id('DetailID');
            $table->unsignedBigInteger('PenjualanID');
            $table->unsignedBigInteger('ProdukID');
            $table->integer('JumlahProduk');
            $table->decimal('Subtotal', 10, 2);

            $table->foreign('PenjualanID')->references('PenjualanID')->on('penjualan')->onDelete('cascade');
            $table->foreign('ProdukID')->references('ProdukID')->on('produk')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detailpenjualan');
    }
};
