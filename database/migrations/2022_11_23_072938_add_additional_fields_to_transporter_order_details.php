<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToTransporterOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transporter_order_details', function (Blueprint $table) {
            $table->string('v_container_number')->after('v_equipments')->nullable();
            $table->string('v_driver_name')->after('v_container_number')->nullable();
            $table->string('v_vessel_name')->after('v_driver_name')->nullable();
            $table->string('v_truck')->after('v_vessel_name')->nullable();
            $table->string('v_trailer')->after('v_truck')->nullable();
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
            //
        });
    }
}
