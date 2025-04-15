<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUangBayarKembalianToPenjualansTable extends Migration
{
    public function up()
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->decimal('uang_bayar', 15, 2)->default(0)->after('total_bayar');
            $table->decimal('kembalian', 15, 2)->default(0)->after('uang_bayar');
        });
    }

    public function down()
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->dropColumn('uang_bayar');
            $table->dropColumn('kembalian');
        });
    }
}
