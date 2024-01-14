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
        Schema::create('departments', function (Blueprint $table) {
            $table->id('department_id');
            $table->unsignedBigInteger('company_id');
            $table->string('department_name');
            $table->unsignedBigInteger('parent_department_id')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('company_id')->on('companies');
            $table->foreign('parent_department_id')->references('department_id')->on('departments');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
