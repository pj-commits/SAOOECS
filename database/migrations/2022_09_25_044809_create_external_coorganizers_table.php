<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_coorganizers', function (Blueprint $table) {
            $table->id();
            $table->string('coorganization');
            $table->string('coorganizer');
            $table->string('email');
            $table->string('phoneNumber');  
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
        Schema::dropIfExists('external_coorganizers');
    }
};
