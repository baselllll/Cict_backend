<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("email")->nullable();
            $table->text("city")->nullable();
            $table->text("Name")->nullable();
            $table->text("Bio")->nullable();//description
            $table->text("Skills")->nullable();
            $table->enum("Exper_level",["Junior","Senior","Mid_Senior"])->default("Junior");
            $table->enum("status_apply",["Accept","Reject","Pending"])->default("Pending");
            $table->unsignedBigInteger("Job_id");
            $table->foreign('Job_id')->references('id')->on('employer_jobs')->onDelete("cascade");
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
        Schema::dropIfExists('employees');
    }
}
