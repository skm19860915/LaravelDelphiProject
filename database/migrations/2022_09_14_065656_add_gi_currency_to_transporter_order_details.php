<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGiCurrencyToTransporterOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transporter_order_details', function (Blueprint $table) {
            $table->string('gi_currency')->after('gi_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transporter_order_details', function (Blueprint $table) {
            $table->dropColumn('gi_currency');
        });
    }
}
