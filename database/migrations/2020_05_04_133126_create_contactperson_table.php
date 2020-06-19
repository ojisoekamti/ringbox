<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactpersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactpersons', function (Blueprint $table) {
            $table->id();
            $table->string('contactPersonId',10);
            $table->integer('accountId');
            $table->string('name', 100);
            $table->longText('address');
            $table->string('city');
            $table->string('postalCode');
            $table->string('phone');
            $table->string('email');
            $table->string('jobStatus');
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('contactperson');
    }
}
