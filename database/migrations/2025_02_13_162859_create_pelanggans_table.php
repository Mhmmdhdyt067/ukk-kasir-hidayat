<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('PelangganID');
            $table->string('NamaPelanggan', 255);
            $table->text('Alamat');
            $table->string('NomorTelepon', 15);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggan');
    }
};
