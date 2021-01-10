<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string('message_id');
            $table->string('uuid');
            $table->string('message_no')->nullable();
            $table->unsignedBigInteger('folder_id');
            $table->longText('subject')->nullable();
            $table->longText('to')->nullable();
            $table->longText('from')->nullable();
            $table->longText('text_body')->nullable();
            $table->longText('date')->nullable();
            $table->timestamps();
            $table->foreign('folder_id')
            ->references('id')
            ->on('mail_folders')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mails');
    }
}
