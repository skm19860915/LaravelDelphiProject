<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEquipmentIdsToTransporterOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transporter_order_details', function (Blueprint $table) {
            $table->string('v_equipments')->after('v_add_dimension')->nullable();
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
            $table->dropColumn('v_equipments');
        });
    }
}
