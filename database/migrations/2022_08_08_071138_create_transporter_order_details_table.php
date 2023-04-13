<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransporterOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transporter_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transporter_order_id')->unsigned();
            $table->foreign('transporter_order_id')->references('id')->on('transporters_orders');

            $table->string('gi_att')->nullable();
            $table->string('gi_desc')->nullable();
            $table->integer('gi_tons')->default(0);
            $table->boolean('gi_abnormal')->default(false);
            $table->string('gi_instruction')->nullable();
            $table->boolean('gi_reqd')->default(false);
            $table->string('gi_value')->nullable();
            $table->string('gi_rate')->nullable();
            $table->string('gi_terms')->nullable();

            $table->integer('v_type_id')->unsigned();
            $table->foreign('v_type_id')->references('id')->on('vehicle_types');
            $table->string('v_l')->nullable();
            $table->string('v_w')->nullable();
            $table->string('v_h')->nullable();
            $table->string('v_add_dimension')->nullable();

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
        Schema::dropIfExists('transporter_order_details');
    }
}
