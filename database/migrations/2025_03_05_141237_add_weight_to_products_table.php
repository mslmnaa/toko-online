<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightToProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add weight column with a default of 1000 grams
            $table->integer('weight')->default(1000)
                  ->comment('Product weight in grams')
                  ->after('stock'); // Place it after the stock column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Remove the weight column if needed
            $table->dropColumn('weight');
        });
    }
}