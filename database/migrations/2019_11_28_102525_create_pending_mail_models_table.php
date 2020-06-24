<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingMailModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('to')->nullable();
            $table->string('reply_to')->nullable();
            $table->string('subject')->nullable();
            $table->mediumText('body')->nullable();
            $table->string('template')->nullable();
            $table->string('signature')->nullable();
            $table->string('attachment')->nullable();
            $table->string('user_id')->nullable();
            $table->integer('state')->default(1);
            $table->string('from')->nullable();
            $table->string('from_name')->nullable();
            $table->string('to_name')->nullable();
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
        Schema::dropIfExists('pending_mail_models');
    }
}
