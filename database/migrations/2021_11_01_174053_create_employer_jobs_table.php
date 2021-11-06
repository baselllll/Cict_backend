<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_jobs', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->text("title")->nullable();
            $table->text("content")->nullable();
            $table->enum("status",["Avaliable","NonAvaliable"])->default("NonAvaliable");
            $table->text("employer_email")->nullable();//description
            $table->text("employer_password")->nullable();
            $table->text("employer_name")->nullable();
            $table->text("employer_phone")->nullable();
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
        Schema::dropIfExists('employer_jobs');
    }
}
