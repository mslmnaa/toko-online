<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->default(0);
        });
    }

    

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('total');
        });
    }
}

