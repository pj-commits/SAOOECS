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
            // $table->integer('prep_by')->default(auth()->id());
            
            $table->string('formable_type');
            $table->integer('formable_id');

            $table->integer('org_id')->default(0);
            $table->string('control_number')->default(0);
            $table->string('event_title');
            $table->string('curr_approver')->default('Adviser');
            $table->string('status')->default('Pending');

            //Adviser
            $table->foreignId('adviser_faculty_id')->nullable();
            $table->boolean('adviser_is_approve')->default(0);
            $table->dateTime('adviser_date_approved')->nullable();
            //SAO
            $table->foreignId('sao_staff_id')->nullable();
            $table->boolean('sao_is_approve')->default(0);
            $table->dateTime('sao_date_approved')->nullable();
            //Academic Services
            $table->foreignId('acad_serv_faculty_id')->nullable();
            $table->boolean('acad_serv_is_approve')->default(0);
            $table->dateTime('acad_serv_date_approved')->nullable();
            //Finance
            $table->foreignId('finance_staff_id')->nullable();
            $table->boolean('finance_is_approve')->default(0);
            $table->dateTime('finance_date_approved')->nullable();
            
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
