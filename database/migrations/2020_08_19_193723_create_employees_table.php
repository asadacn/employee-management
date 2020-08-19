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
            $table->bigIncrements('id');
            $table->integer('department_id')->nullable()->comment('department');
            $table->integer('rank_id')->nullable()->comment('Rank');
            $table->string('name')->nullable()->comment('Name');
            $table->string('contact_no')->nullable()->comment('contact_no');
            $table->string('blood_group')->nullable()->comment('blood_group');
            $table->string('emergency_contact_person')->nullable()->comment('emergency_contact_person');
            $table->string('emergency_contact_relation')->nullable()->comment('emergency_contact_relation');
            $table->string('emergency_contact_no')->nullable()->comment('emergency_contact_no');
            $table->text('address')->nullable()->comment('address');
            $table->integer('salary')->nullable()->comment('Salary');
            $table->date('hired_at')->nullable()->comment('Hired At');
            $table->string('photo')->nullable()->comment('Photo');
            $table->string('nid')->nullable()->comment('National Identity Card photo');
            $table->integer('status')->nullable()->comment('1 means active | 2 means inactive | 3 means closed');

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
