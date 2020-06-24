<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('sname')->nullable();
            $table->string('employee_no')->nullable();
            $table->string('pension_no')->nullable();
            $table->date('joined_date')->nullable();
            $table->string('national_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('dob')->nullable();
            $table->bigInteger('gender')->unsigned();
            $table->string('phone')->nullable();
            $table->mediumText('post_address')->nullable();
            $table->double('basic_salary')->default(0);
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('roles')->unsigned();
            $table->bigInteger('employee_status')->unsigned();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_no')->nullable();
            $table->integer('status')->default(1);
            $table->foreign('gender')->references('id')->on('genders');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('employee_status')->references('id')->on('employee_statuses');
            $table->foreign('roles')->references('id')->on('roles');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
