<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActlists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actlists', function (Blueprint $table) {
            $table->id();
            $table->char('actId',10);
            $table->char('idSales');
            $table->char('idType');
            $table->char('subject');
            $table->char('email');
            $table->dateTime('date',0);
            $table->char('account');
            $table->char('contactName');
            $table->char('phoneCall');
            $table->longText('address');
            $table->char('status');
            $table->longText('remarks');
            $table->time('estimateTime', 0);
            $table->time('clockIn', 0);
            $table->time('clockOut', 0);
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
        Schema::dropIfExists('actlists');
    }
}
