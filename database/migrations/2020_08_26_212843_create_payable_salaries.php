<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayableSalaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payable_salary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('employee_id');
            $table->integer('leave')->nullable()->comment('number of days out of work');
            $table->enum('leave_ignore',['yes','no'])->default('no')->comment('Salary is paid or not');
            $table->double('payable_salary')->comment('salay after deducting leave');
            $table->smallInteger('month')->comment('Month: 1=>Janu, 2=>Feb, 3 =>March ..');
            $table->year('year');
            $table->enum('is_paid',['yes','no'])->default('no')->comment('Salary is paid or not');
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
        Schema::dropIfExists('payable_salary');
    }
}
