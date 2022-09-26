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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->integer("createdBy");
            $table->string('formType');
            $table->string('orgName');
            $table->string('controlNumber');
            $table->string('eventTitle');
            $table->string('currApprover');
            $table->string('status');

            //Adviser
            $table->foreignId('adviserFacultyId')->nullable();
            $table->boolean('adviserIsApprove')->default(0);
            $table->dateTime('adviserDateApproved')->nullable();
            //SAO
            $table->foreignId('saoStaffId')->nullable();
            $table->boolean('saoIsApprove')->default(0);
            $table->dateTime('saoDateApproved')->nullable();
            //Academic Services
            $table->foreignId('acadServStaffId')->nullable();
            $table->boolean('acadServIsApprove')->default(0);
            $table->dateTime('acadServDateApproved')->nullable();
            //Finance
            $table->foreignId('financeStaffId')->nullable();
            $table->boolean('financeIsApprove')->default(0);
            $table->dateTime('financeDateApproved')->nullable();
            
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
        Schema::dropIfExists('forms');
    }
};
