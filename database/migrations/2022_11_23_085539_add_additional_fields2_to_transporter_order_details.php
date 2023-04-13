<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFields2ToTransporterOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transporter_order_details', function (Blueprint $table) {
            $table->timestamp('l_date')->after('offload_addr_id')->nullable();
            $table->string('l_contact')->after('l_date')->nullable();
            $table->string('l_telephone')->after('l_contact')->nullable();
            $table->timestamp('o_date')->after('l_telephone')->nullable();
            $table->string('o_contact')->after('o_date')->nullable();
            $table->string('o_telephone')->after('o_contact')->nullable();
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
